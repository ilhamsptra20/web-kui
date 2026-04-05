<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Gallery;
use App\Models\Setting;

class GalleryController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'title' => 'Album Galeri Kegiatan',
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'ALBUM GALERI', 'url' => null],
            ],
        ];

        $albums = Album::query()
            ->withCount('galleries')
            ->with(['galleries' => fn ($query) => $query->select('id', 'album_id', 'image')->latest()])
            ->latest()
            ->paginate(9)
            ->through(function (Album $album) {
                $cover = $album->image ?: $album->galleries->first()?->image;

                return [
                    'name' => $album->trans('name') ?: 'Album Kegiatan',
                    'slug' => $album->slug,
                    'image_url' => Setting::resolveImageUrl($cover),
                    'gallery_count' => $album->galleries_count,
                    'date' => $album->updated_at?->format('d M Y'),
                    'url' => $album->slug ? route('gallery.show-marketing', $album->slug) : null,
                ];
            });

        return view('pages.marketing.gallery', compact(
            'breadcrumb',
            'albums'
        ));
    }

    public function show(Album $album)
    {
        $breadcrumb = [
            'title' => $album->trans('name') ?: 'Detail Album',
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'GALERI', 'url' => route('gallery-marketing')],
                ['label' => strtoupper($album->trans('name') ?: 'DETAIL ALBUM'), 'url' => null],
            ],
        ];

        $galleries = Gallery::query()
            ->where('album_id', $album->getKey())
            ->latest()
            ->paginate(12)
            ->through(function (Gallery $gallery) {
                return [
                    'image_url' => Setting::resolveImageUrl($gallery->image),
                    'title' => $gallery->trans('title') ?: 'Dokumentasi Kegiatan',
                    'date' => $gallery->created_at?->format('d M Y'),
                ];
            });

        $albumData = [
            'name' => $album->trans('name') ?: 'Album Kegiatan',
            'image_url' => Setting::resolveImageUrl($album->image),
            'gallery_count' => Gallery::query()->where('album_id', $album->getKey())->count(),
        ];

        return view('pages.marketing.gallery-show', compact('breadcrumb', 'albumData', 'galleries'));
    }
}

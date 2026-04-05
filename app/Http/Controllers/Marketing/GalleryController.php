<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Setting;

class GalleryController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'title' => 'Galeri Kegiatan',
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'GALERI', 'url' => null],
            ],
        ];

        $galleries = Gallery::with('album')
            ->latest()
            ->paginate(9)
            ->through(function ($g) {
                return [
                    'image_url' => Setting::resolveImageUrl($g->image),
                    'title' => method_exists($g, 'trans')
                        ? $g->trans('title')
                        : $g->title,
                    'date'  => $g->created_at?->format('d M Y'),
                    'url'   => $g->album?->slug
                        ? '/gallery/' . $g->album->slug
                        : null,
                ];
            });

        return view('pages.marketing.gallery', compact(
            'breadcrumb',
            'galleries'
        ));
    }
}

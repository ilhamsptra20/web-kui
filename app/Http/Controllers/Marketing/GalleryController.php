<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        // ============================================================
        // BREADCRUMB (konsisten dengan article)
        // ============================================================
        $breadcrumb = [
            'title' => 'Gallery',
            'menus' => [
                ['label' => 'HOME', 'url' => '/'],
                ['label' => 'GALLERY', 'url' => null],
            ],
        ];

        // ============================================================
        // GALLERIES (paginate + transform)
        // ============================================================
        $galleries = Gallery::with('album')
            ->latest()
            ->paginate(9)
            ->through(function ($g) {
                return [
                    'image' => $g->image,

                    // pakai trans kalau ada multi bahasa
                    'title' => method_exists($g, 'trans')
                        ? $g->trans('title')
                        : $g->title,

                    'date'  => $g->created_at?->format('d M Y'),

                    // opsional (kalau nanti mau klik ke detail album)
                    'url'   => $g->album?->slug
                        ? '/gallery/' . $g->album->slug
                        : null,
                ];
            });

        // ============================================================
        // RETURN VIEW
        // ============================================================
        return view('pages.marketing.gallery', compact(
            'breadcrumb',
            'galleries'
        ));
    }
}
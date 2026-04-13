<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\RichText\RichTextSanitizer;

class PageController extends Controller
{
    public function show(Page $page, RichTextSanitizer $sanitizer)
    {
        abort_unless($page->status, 404);

        $title = $page->trans('title') ?: 'Halaman KUI';
        $content = $sanitizer->sanitize($page->trans('content') ?: '');

        return view('pages.marketing.pages.show', [
            'page' => $page,
            'title' => $title,
            'content' => $content,
        ]);
    }
}

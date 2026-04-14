<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\RichText\RichTextSanitizer;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function show(Page $page, RichTextSanitizer $sanitizer)
    {
        abort_unless($page->status, 404);

        if ($page->isPdfFile()) {
            return $this->showPdf($page);
        }

        $title = $page->trans('title') ?: 'Halaman KUI';
        $content = $page->isText()
            ? $sanitizer->sanitize($page->trans('content') ?: '')
            : null;

        return view('pages.marketing.pages.show', [
            'page' => $page,
            'title' => $title,
            'content' => $content,
        ]);
    }

    private function showPdf(Page $page)
    {
        abort_unless($page->hasFile(), 404);
        abort_unless($page->isPdfFile(), 404);

        $disk = Storage::disk('public');
        $path = ltrim((string) $page->file_path, '/');

        abort_unless($disk->exists($path), 404);

        $response = response()->file($disk->path($path), [
            'Content-Type' => $page->file_mime ?: $disk->mimeType($path) ?: 'application/octet-stream',
            'X-Content-Type-Options' => 'nosniff',
        ]);

        $response->setContentDisposition('inline', $page->fileDisplayName());

        return $response;
    }
}

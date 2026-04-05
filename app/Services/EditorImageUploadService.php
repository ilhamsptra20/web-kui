<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EditorImageUploadService
{
    public function store(UploadedFile $file): array
    {
        $disk = (string) config('editor.upload_disk', 'public');
        $directory = trim((string) config('editor.upload_directory', 'editor-images'), '/');
        $path = $file->store($directory . '/' . now()->format('Y/m'), $disk);
        $url = Storage::disk($disk)->url($path);

        return [
            'path' => $path,
            'url' => $this->normalizeUrl($disk, $url),
        ];
    }

    private function normalizeUrl(string $disk, string $url): string
    {
        if (config("filesystems.disks.{$disk}.driver") !== 'local') {
            return $url;
        }

        $path = parse_url($url, PHP_URL_PATH);

        return $path ?: $url;
    }
}

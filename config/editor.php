<?php

return [
    'cdn_url' => env('CKEDITOR_CDN_JS', 'https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@41.4.2/build/ckeditor.js'),
    'cdn_urls' => array_values(array_filter([
        env('CKEDITOR_CDN_JS', 'https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@41.4.2/build/ckeditor.js'),
        'https://unpkg.com/@ckeditor/ckeditor5-build-classic@41.4.2/build/ckeditor.js',
    ])),
    'upload_disk' => env('EDITOR_UPLOAD_DISK', 'public'),
    'upload_directory' => env('EDITOR_UPLOAD_DIRECTORY', 'editor-images'),
];

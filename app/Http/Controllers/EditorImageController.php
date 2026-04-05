<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadEditorImageRequest;
use App\Services\EditorImageUploadService;
use Illuminate\Http\JsonResponse;

class EditorImageController extends Controller
{
    public function __construct(
        private readonly EditorImageUploadService $uploadService
    ) {}

    public function store(UploadEditorImageRequest $request): JsonResponse
    {
        $image = $this->uploadService->store($request->file('upload'));

        return response()->json([
            'url' => $image['url'],
        ]);
    }
}

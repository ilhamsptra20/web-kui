@php
    $showMode = $showMode ?? false;
    $pageModel = $page ?? null;
    $typeText = \App\Models\Page::TYPE_TEXT;
    $typeFile = \App\Models\Page::TYPE_FILE;
    $selectedType = $showMode
        ? ($pageModel->type ?? $typeText)
        : old('type', $pageModel->type ?? $typeText);
    $fileUrl = $pageModel?->fileUrl();
@endphp

        <x-form.input name='title_id' type='text' label='Title Id' :value="$page->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='title_en' type='text' label='Title En' :value="$page->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_ar' type='text' label='Title Ar' :value="$page->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />

        <div class="form-group">
            <label class="d-block mb-1">Type</label>
            <input type="hidden" name="type" id="page_type" value="{{ $selectedType }}" @disabled($showMode)>

            <div class="page-type-switch border rounded p-2">
                <div class="d-flex align-items-center flex-wrap">
                    <span class="page-type-option mr-1 {{ $selectedType === $typeFile ? 'is-active' : '' }}" data-page-type-option="{{ $typeFile }}">PDF/Image</span>

                    <div class="custom-control custom-switch custom-switch-primary mx-1">
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            id="page_type_switch"
                            @checked($selectedType === $typeText)
                            @disabled($showMode)
                        >
                        <label class="custom-control-label cursor-pointer" for="page_type_switch"></label>
                    </div>

                    <span class="page-type-option ml-1 {{ $selectedType === $typeText ? 'is-active' : '' }}" data-page-type-option="{{ $typeText }}">Text</span>
                    <span class="badge badge-light-primary ml-2" data-page-type-label>
                        {{ $selectedType === $typeFile ? 'PDF/Image' : 'Text' }}
                    </span>
                </div>

                <small class="text-muted d-block mt-1">Pilih PDF/Image untuk upload file, pilih Text untuk CKEditor.</small>
            </div>

            @error('type')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div data-page-type-panel="{{ $typeText }}" class="{{ $selectedType === $typeText ? '' : 'd-none' }}">
            <x-form.ckeditor name='content_id' label='Content Id' :value="$page->content_id ?? ''" :readonly="$showMode" :enable-images="! $showMode" required />
            <x-form.ckeditor name='content_en' label='Content En' :value="$page->content_en ?? ''" :readonly="$showMode" :enable-images="! $showMode" />
            <x-form.ckeditor name='content_ar' label='Content Ar' :value="$page->content_ar ?? ''" :readonly="$showMode" :enable-images="! $showMode" />
        </div>

        <div data-page-type-panel="{{ $typeFile }}" class="mb-3 {{ $selectedType === $typeFile ? '' : 'd-none' }}">
            <label class="d-block mb-2 fw-semibold">File Halaman</label>

            @if($pageModel?->hasFile())
                <div class="border rounded p-2 mb-2 bg-light">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="d-flex align-items-center mb-1 mb-md-0">
                            <i class="{{ $pageModel->fileIcon() }} mr-1"></i>
                            <div>
                                <div class="font-weight-semibold">{{ $pageModel->fileDisplayName() }}</div>
                                @if($pageModel->readableFileSize())
                                    <small class="text-muted">{{ $pageModel->readableFileSize() }}</small>
                                @endif
                            </div>
                        </div>

                        @if($fileUrl)
                            <a href="{{ $fileUrl }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">
                                Buka File
                            </a>
                        @endif
                    </div>

                    @if($fileUrl && $pageModel->isImageFile())
                        <img src="{{ $fileUrl }}" alt="{{ $pageModel->fileDisplayName() }}" class="img-fluid rounded mt-2 border" style="max-height: 360px; object-fit: contain;">
                    @elseif($fileUrl && $pageModel->isPdfFile())
                        <iframe src="{{ $fileUrl }}" class="w-100 mt-2 border rounded bg-white" style="height: 520px;" title="{{ $pageModel->fileDisplayName() }}"></iframe>
                    @endif
                </div>
            @elseif($showMode)
                <div class="alert alert-light border mb-0">
                    File halaman belum diunggah.
                </div>
            @endif

            @unless($showMode)
                <label for="page_file_upload" class="page-file-picker @error('file_upload') is-invalid @enderror">
                    <input
                        type="file"
                        name="file_upload"
                        id="page_file_upload"
                        accept="image/jpeg,image/png,image/webp,application/pdf"
                        data-has-existing-file="{{ $pageModel?->hasFile() ? '1' : '0' }}"
                        class="page-file-picker-input"
                    >

                    <span class="page-file-picker-icon">
                        <i class="feather icon-upload-cloud"></i>
                    </span>

                    <span class="page-file-picker-copy">
                        <span class="font-weight-semibold d-block" data-page-file-name>
                            {{ $pageModel?->hasFile() ? 'Ganti file halaman' : 'Pilih file halaman' }}
                        </span>
                        <small class="text-muted" data-page-file-meta>
                            Klik area ini untuk upload JPG, PNG, WEBP, atau PDF. Maksimal 10 MB.
                        </small>
                    </span>

                    <span class="btn btn-sm btn-outline-primary mb-0">Browse</span>
                </label>

                @if($pageModel?->hasFile())
                    <small class="text-muted d-block">Kosongkan upload jika file lama masih ingin dipakai.</small>
                @endif

                <div class="d-none mt-2" data-page-upload-preview>
                    <div class="border rounded p-2 bg-light">
                        <div class="font-weight-semibold mb-1" data-page-upload-preview-title></div>
                        <div data-page-upload-preview-body></div>
                    </div>
                </div>
            @endunless

            @error('file_upload')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <x-form.switch name='status' label='Status' :checked="old('status', $page->status ?? false)" :disabled="$showMode" />

@pushonce('styles')
    <style>
        .page-type-switch {
            background: #f8f8fb;
        }

        .page-type-switch .custom-switch {
            min-height: 1.6rem;
        }

        .page-type-option {
            color: #6e6b7b;
            font-size: 0.9rem;
            font-weight: 600;
            line-height: 1;
        }

        .page-type-option.is-active {
            color: #7367f0;
        }

        .page-file-picker {
            align-items: center;
            background: #fff;
            border: 1px dashed #c8c4f4;
            border-radius: 0.65rem;
            color: #5e5873;
            cursor: pointer;
            display: flex;
            gap: 0.9rem;
            margin-bottom: 0.35rem;
            min-height: 88px;
            overflow: hidden;
            padding: 1rem;
            position: relative;
            transition: border-color 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .page-file-picker:hover {
            background: #f8f8ff;
            border-color: #7367f0;
            box-shadow: 0 0.5rem 1.25rem rgba(115, 103, 240, 0.1);
        }

        .page-file-picker.is-invalid {
            border-color: #ea5455;
        }

        .page-file-picker-input {
            cursor: pointer;
            inset: 0;
            opacity: 0;
            position: absolute;
            width: 100%;
        }

        .page-file-picker-icon {
            align-items: center;
            background: rgba(115, 103, 240, 0.12);
            border-radius: 0.75rem;
            color: #7367f0;
            display: inline-flex;
            flex: 0 0 48px;
            font-size: 1.4rem;
            height: 48px;
            justify-content: center;
            width: 48px;
        }

        .page-file-picker-copy {
            flex: 1;
            min-width: 180px;
        }

        .page-file-picker .btn {
            position: relative;
            z-index: 1;
        }
    </style>
@endpushonce

@unless($showMode)
    @pushonce('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const typeInput = document.getElementById('page_type');
                const typeSwitch = document.getElementById('page_type_switch');
                const typeLabel = document.querySelector('[data-page-type-label]');
                const typeOptions = document.querySelectorAll('[data-page-type-option]');
                const panels = document.querySelectorAll('[data-page-type-panel]');
                const contentId = document.querySelector('[name="content_id"]');
                const fileInput = document.getElementById('page_file_upload');
                const uploadPreview = document.querySelector('[data-page-upload-preview]');
                const uploadPreviewTitle = document.querySelector('[data-page-upload-preview-title]');
                const uploadPreviewBody = document.querySelector('[data-page-upload-preview-body]');
                const fileName = document.querySelector('[data-page-file-name]');
                const fileMeta = document.querySelector('[data-page-file-meta]');
                let uploadPreviewUrl = null;

                if (!typeInput || !typeSwitch || !panels.length) {
                    return;
                }

                const defaultFileName = fileName?.textContent?.trim() || 'Pilih file halaman';
                const defaultFileMeta = fileMeta?.textContent?.trim() || 'Klik area ini untuk upload JPG, PNG, WEBP, atau PDF. Maksimal 10 MB.';

                const formatFileSize = (bytes) => {
                    if (!bytes) {
                        return '0 B';
                    }

                    const units = ['B', 'KB', 'MB', 'GB'];
                    let size = bytes;
                    let unitIndex = 0;

                    while (size >= 1024 && unitIndex < units.length - 1) {
                        size /= 1024;
                        unitIndex++;
                    }

                    return `${size.toFixed(unitIndex === 0 ? 0 : 1)} ${units[unitIndex]}`;
                };

                const clearUploadPreview = () => {
                    if (uploadPreviewUrl) {
                        URL.revokeObjectURL(uploadPreviewUrl);
                        uploadPreviewUrl = null;
                    }

                    if (uploadPreview && uploadPreviewTitle && uploadPreviewBody) {
                        uploadPreview.classList.add('d-none');
                        uploadPreviewTitle.textContent = '';
                        uploadPreviewBody.innerHTML = '';
                    }

                    if (fileName) {
                        fileName.textContent = defaultFileName;
                    }

                    if (fileMeta) {
                        fileMeta.textContent = defaultFileMeta;
                    }
                };

                const renderUploadPreview = () => {
                    if (!fileInput || !uploadPreview || !uploadPreviewTitle || !uploadPreviewBody) {
                        return;
                    }

                    const file = fileInput.files?.[0];
                    clearUploadPreview();

                    if (!file) {
                        return;
                    }

                    uploadPreviewUrl = URL.createObjectURL(file);
                    uploadPreview.classList.remove('d-none');
                    uploadPreviewTitle.textContent = `Preview: ${file.name}`;

                    if (fileName) {
                        fileName.textContent = file.name;
                    }

                    if (fileMeta) {
                        fileMeta.textContent = `${file.type || 'File'} | ${formatFileSize(file.size)}`;
                    }

                    if (file.type.startsWith('image/')) {
                        const image = document.createElement('img');
                        image.src = uploadPreviewUrl;
                        image.alt = file.name;
                        image.className = 'img-fluid rounded border';
                        image.style.maxHeight = '360px';
                        image.style.objectFit = 'contain';
                        uploadPreviewBody.appendChild(image);
                        return;
                    }

                    if (file.type === 'application/pdf') {
                        const iframe = document.createElement('iframe');
                        iframe.src = uploadPreviewUrl;
                        iframe.title = file.name;
                        iframe.className = 'w-100 border rounded bg-white';
                        iframe.style.height = '520px';
                        uploadPreviewBody.appendChild(iframe);
                        return;
                    }

                    uploadPreviewBody.innerHTML = '<div class="alert alert-warning mb-0">Preview hanya mendukung image dan PDF.</div>';
                };

                const syncPanels = () => {
                    const selectedType = typeSwitch.checked ? @json($typeText) : @json($typeFile);
                    typeInput.value = selectedType;

                    if (typeLabel) {
                        typeLabel.textContent = selectedType === @json($typeFile)
                            ? 'PDF/Image'
                            : 'Text';
                    }

                    typeOptions.forEach((option) => {
                        option.classList.toggle('is-active', option.dataset.pageTypeOption === selectedType);
                    });

                    panels.forEach((panel) => {
                        const isActive = panel.dataset.pageTypePanel === selectedType;

                        panel.classList.toggle('d-none', !isActive);
                        panel.querySelectorAll('input, textarea, select').forEach((field) => {
                            field.disabled = !isActive;
                        });
                    });

                    if (contentId) {
                        contentId.required = selectedType === @json($typeText);
                    }

                    if (fileInput) {
                        fileInput.required = selectedType === @json($typeFile)
                            && fileInput.dataset.hasExistingFile !== '1';
                    }

                    if (selectedType === @json($typeFile) && fileInput?.files?.length) {
                        renderUploadPreview();
                    }

                    if (selectedType === @json($typeText)) {
                        clearUploadPreview();
                    }
                };

                typeSwitch.addEventListener('change', syncPanels);
                fileInput?.addEventListener('change', renderUploadPreview);
                window.addEventListener('beforeunload', clearUploadPreview);
                syncPanels();
            });
        </script>
    @endpushonce
@endunless

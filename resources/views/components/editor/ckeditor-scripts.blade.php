<script>
(() => {
    if (window.__ckeditorBootstrapLoaded) {
        return;
    }

    window.__ckeditorBootstrapLoaded = true;
    const CKEDITOR_CDN_URLS = @json(config('editor.cdn_urls', [config('editor.cdn_url')]));
    let ckeditorLoaderPromise = null;

    class LaravelUploadAdapter {
        constructor(loader, options) {
            this.loader = loader;
            this.options = options;
        }

        async upload() {
            const file = await this.loader.file;
            const formData = new FormData();
            formData.append('upload', file);

            const response = await fetch(this.options.uploadUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.options.csrfToken,
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error('Upload gambar gagal.');
            }

            const payload = await response.json();

            if (!payload.url) {
                throw new Error('Response upload tidak valid.');
            }

            return {
                default: payload.url
            };
        }

        abort() {}
    }

    function showEditorError(textarea, message) {
        const wrapper = textarea.closest('.ck-editor-wrapper');

        if (!wrapper || wrapper.querySelector('[data-ckeditor-error]')) {
            return;
        }

        const alert = document.createElement('div');
        alert.className = 'alert alert-warning mt-1';
        alert.dataset.ckeditorError = '1';
        alert.textContent = message;
        wrapper.appendChild(alert);
    }

    function loadScript(url) {
        return new Promise((resolve, reject) => {
            const existing = document.querySelector(`script[src="${url}"]`);

            if (existing) {
                if (existing.dataset.loaded === '1') {
                    resolve();
                    return;
                }

                existing.addEventListener('load', () => resolve(), { once: true });
                existing.addEventListener('error', () => reject(new Error(`Gagal memuat ${url}`)), { once: true });
                return;
            }

            const script = document.createElement('script');
            script.src = url;
            script.async = true;
            script.onload = () => {
                script.dataset.loaded = '1';
                resolve();
            };
            script.onerror = () => reject(new Error(`Gagal memuat ${url}`));
            document.head.appendChild(script);
        });
    }

    async function ensureCkeditorLoaded() {
        if (window.CKEDITOR?.ClassicEditor || window.ClassicEditor) {
            return;
        }

        if (!ckeditorLoaderPromise) {
            ckeditorLoaderPromise = (async () => {
                let lastError = null;

                for (const url of CKEDITOR_CDN_URLS) {
                    try {
                        await loadScript(url);

                        if (window.CKEDITOR?.ClassicEditor || window.ClassicEditor) {
                            return;
                        }
                    } catch (error) {
                        lastError = error;
                    }
                }

                throw lastError ?? new Error('CKEditor CDN gagal dimuat.');
            })();
        }

        return ckeditorLoaderPromise;
    }

    function buildToolbar(config) {
        const toolbar = [
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            '|',
            'bulletedList',
            'numberedList',
            'blockQuote',
            '|',
            'undo',
            'redo'
        ];

        if (config.enableImages) {
            toolbar.splice(toolbar.length - 3, 0, 'imageUpload');
        }

        return toolbar;
    }

    function attachUploadAdapter(editor, config) {
        if (!config.enableImages || !config.uploadUrl) {
            return;
        }

        const fileRepository = editor.plugins.get('FileRepository');

        if (!fileRepository) {
            return;
        }

        fileRepository.createUploadAdapter = (loader) => {
            return new LaravelUploadAdapter(loader, {
                uploadUrl: config.uploadUrl,
                csrfToken: config.csrfToken
            });
        };
    }

    async function initEditor(textarea) {
        if (textarea.dataset.ckeditorReady === '1') {
            return;
        }

        const config = JSON.parse(textarea.dataset.ckeditorConfig || '{}');
        await ensureCkeditorLoaded();

        const editorFactory = window.CKEDITOR?.ClassicEditor || window.ClassicEditor;

        if (!editorFactory) {
            throw new Error('CKEditor Classic build tidak tersedia.');
        }

        const editor = await editorFactory.create(textarea, {
            placeholder: config.placeholder || '',
            toolbar: {
                items: buildToolbar(config),
                shouldNotGroupWhenFull: true
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            },
            image: {
                toolbar: ['imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side']
            },
            link: {
                decorators: {
                    openInNewTab: {
                        mode: 'manual',
                        label: 'Open in new tab',
                        attributes: {
                            target: '_blank',
                            rel: 'noopener noreferrer'
                        }
                    }
                }
            }
        });

        attachUploadAdapter(editor, config);
        textarea.dataset.ckeditorReady = '1';
    }

    async function bootEditors(scope = document) {
        const editors = scope.querySelectorAll('textarea[data-ckeditor-config]');

        for (const editor of editors) {
            try {
                await initEditor(editor);
            } catch (error) {
                console.error(error);
                showEditorError(editor, 'CKEditor gagal dimuat. Cek koneksi internet atau blokir CDN di browser.');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        bootEditors().catch((error) => {
            console.error(error);
        });
    });
})();
</script>

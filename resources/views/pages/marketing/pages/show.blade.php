@extends('layouts.marketing')

@section('content')
<div class="breadcrumb-area bg-f round-20 position-relative z-1 marketing-page-breadcrumb">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ url('/') }}">HOME</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ route('about-marketing') }}">TENTANG KUI</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                {{ $title }}
            </li>
        </ul>
        <h1 class="section-title style-one fw-medium font-secondary text-black text-center mb-3">
            {{ $title }}
        </h1>
        <p class="mx-auto marketing-page-lead text-para mb-0">
            Informasi resmi dari Kantor Urusan Internasional Universitas Juanda.
        </p>
    </div>
</div>

<section class="marketing-page-section">
    <div class="container style-one">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <article class="marketing-page-card">
                    <div class="marketing-page-meta">
                        <span>
                            <i class="ri-file-text-line"></i>
                            Halaman Informasi
                        </span>
                        @if($page->updated_at)
                            <span>
                                <i class="ri-time-line"></i>
                                Diperbarui {{ $page->updated_at->translatedFormat('d F Y') }}
                            </span>
                        @endif
                    </div>

                    @if($page->isFile())
                        @php $fileUrl = $page->fileUrl(); @endphp

                        @if($fileUrl)
                            <div class="marketing-page-file">
                                <div class="marketing-page-file-header">
                                    <span class="marketing-page-file-icon">
                                        <i class="{{ $page->fileIcon() }}"></i>
                                    </span>
                                    <div>
                                        <h2 class="font-secondary fw-medium mb-1">{{ $page->fileDisplayName() }}</h2>
                                        @if($page->readableFileSize())
                                            <p class="mb-0 text-para">{{ $page->readableFileSize() }}</p>
                                        @endif
                                    </div>
                                    <a href="{{ $fileUrl }}" target="_blank" rel="noopener" class="btn style-one fw-semibold position-relative round-oval">
                                        Buka File
                                    </a>
                                </div>

                                @if($page->isImageFile())
                                    <img src="{{ $fileUrl }}" alt="{{ $title }}" class="marketing-page-file-image">
                                @elseif($page->isPdfFile())
                                    <iframe src="{{ $fileUrl }}" class="marketing-page-file-pdf" title="{{ $title }}"></iframe>
                                @else
                                    <div class="marketing-page-empty">
                                        <span class="marketing-page-empty-icon">
                                            <i class="ri-attachment-2"></i>
                                        </span>
                                        <h2 class="font-secondary fw-medium mb-3">File tersedia untuk dibuka</h2>
                                        <p class="mb-0">Gunakan tombol buka file untuk melihat dokumen halaman ini.</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="marketing-page-empty">
                                <span class="marketing-page-empty-icon">
                                    <i class="ri-file-warning-line"></i>
                                </span>
                                <h2 class="font-secondary fw-medium mb-3">File halaman belum tersedia</h2>
                                <p class="mb-0">
                                    Tim KUI sedang menyiapkan file untuk halaman ini. Silakan kembali ke halaman tentang KUI atau hubungi KUI untuk informasi lebih lanjut.
                                </p>
                            </div>
                        @endif
                    @elseif(filled($content))
                        <div class="marketing-page-content" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                            {!! $content !!}
                        </div>
                    @else
                        <div class="marketing-page-empty">
                            <span class="marketing-page-empty-icon">
                                <i class="ri-file-warning-line"></i>
                            </span>
                            <h2 class="font-secondary fw-medium mb-3">Konten halaman belum tersedia</h2>
                            <p class="mb-0">
                                Tim KUI sedang menyiapkan konten untuk halaman ini. Silakan kembali ke halaman tentang KUI atau hubungi KUI untuk informasi lebih lanjut.
                            </p>
                        </div>
                    @endif

                    <div class="marketing-page-actions">
                        <a href="{{ route('about-marketing') }}" class="btn style-one fw-semibold position-relative round-oval">
                            Kembali Ke Tentang KUI
                        </a>
                        <a href="{{ route('contact-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">
                            Hubungi KUI
                            <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                            </span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .marketing-page-breadcrumb {
        padding: 110px 0 80px;
    }

    .marketing-page-lead {
        max-width: 760px;
        font-size: 18px;
        line-height: 1.8;
    }

    .marketing-page-section {
        padding: 120px 0 110px;
    }

    .marketing-page-card {
        border-radius: 28px;
        border: 1px solid #edf0f6;
        background: #fff;
        padding: 44px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
    }

    .marketing-page-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 30px;
    }

    .marketing-page-meta span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        background: #f4f6fb;
        color: #475467;
        font-size: 13px;
        font-weight: 600;
    }

    .marketing-page-meta i {
        color: var(--primaryColor);
    }

    .marketing-page-content {
        color: #475467;
        font-size: 17px;
        line-height: 1.9;
    }

    .marketing-page-content > *:last-child {
        margin-bottom: 0;
    }

    .marketing-page-content h1,
    .marketing-page-content h2,
    .marketing-page-content h3,
    .marketing-page-content h4 {
        color: #111827;
        font-family: var(--fontSecondary, inherit);
        font-weight: 500;
        margin-top: 34px;
        margin-bottom: 16px;
        line-height: 1.25;
    }

    .marketing-page-content h1:first-child,
    .marketing-page-content h2:first-child,
    .marketing-page-content h3:first-child,
    .marketing-page-content h4:first-child {
        margin-top: 0;
    }

    .marketing-page-content p {
        margin-bottom: 18px;
    }

    .marketing-page-content ul,
    .marketing-page-content ol {
        padding-left: 24px;
        margin-bottom: 22px;
    }

    .marketing-page-content li {
        margin-bottom: 10px;
    }

    .marketing-page-content blockquote {
        margin: 28px 0;
        padding: 24px 28px;
        border-left: 4px solid var(--primaryColor);
        border-radius: 18px;
        background: #f8f9fd;
        color: #111827;
    }

    .marketing-page-content img {
        max-width: 100%;
        height: auto;
        border-radius: 22px;
        margin: 18px 0;
    }

    .marketing-page-file {
        display: grid;
        gap: 26px;
    }

    .marketing-page-file-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 22px;
        border-radius: 24px;
        background: #f8f9fd;
    }

    .marketing-page-file-header > div {
        flex: 1;
        min-width: 0;
    }

    .marketing-page-file-icon {
        width: 64px;
        height: 64px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(93, 95, 239, 0.1);
        color: var(--primaryColor);
        font-size: 30px;
        flex: 0 0 auto;
    }

    .marketing-page-file-image,
    .marketing-page-file-pdf {
        width: 100%;
        border: 1px solid #edf0f6;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
    }

    .marketing-page-file-image {
        display: block;
        max-height: 720px;
        object-fit: contain;
    }

    .marketing-page-file-pdf {
        min-height: 760px;
    }

    .marketing-page-empty {
        padding: 42px;
        border-radius: 24px;
        background: #f8f9fd;
        text-align: center;
    }

    .marketing-page-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 22px;
        border-radius: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(93, 95, 239, 0.1);
        color: var(--primaryColor);
        font-size: 32px;
    }

    .marketing-page-actions {
        margin-top: 40px;
        padding-top: 28px;
        border-top: 1px solid #edf0f6;
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    @media (max-width: 991px) {
        .marketing-page-breadcrumb {
            padding: 90px 0 70px;
        }

        .marketing-page-section {
            padding: 90px 0;
        }

        .marketing-page-card {
            padding: 32px;
            border-radius: 24px;
        }

        .marketing-page-file-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 767px) {
        .marketing-page-lead,
        .marketing-page-content {
            font-size: 16px;
        }

        .marketing-page-card {
            padding: 26px;
        }

        .marketing-page-empty {
            padding: 30px 22px;
        }

        .marketing-page-file-pdf {
            min-height: 560px;
        }
    }
</style>
@endpush

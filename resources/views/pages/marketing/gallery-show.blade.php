@extends('layouts.marketing')

@section('content')
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            @foreach ($breadcrumb['menus'] as $menu)
                <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                    @if ($menu['url'])
                        <a href="{{ $menu['url'] }}">{{ $menu['label'] }}</a>
                    @else
                        {{ $menu['label'] }}
                    @endif
                </li>
            @endforeach
        </ul>

        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-3">
            {{ $breadcrumb['title'] ?? 'Detail Album' }}
        </h2>

        <p class="text-para mx-auto mb-0" style="max-width: 760px;">
            Jelajahi dokumentasi kegiatan yang tersimpan dalam album ini. Setiap item menampilkan momen penting program internasional KUI Universitas Juanda.
        </p>
    </div>
</div>

<section class="p-5">
    <div class="container style-one">
        <div class="album-detail-hero">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="album-detail-hero__eyebrow">ALBUM KUI UNIDA</span>
                    <h1 class="section-title style-one font-secondary fw-medium mb-15">
                        {{ $albumData['name'] ?? 'Album Kegiatan' }}
                    </h1>
                    <p class="text-para mb-0">
                        Album ini memuat {{ $albumData['gallery_count'] ?? 0 }} dokumentasi kegiatan yang telah diarsipkan melalui panel admin.
                    </p>
                </div>
                <div class="col-lg-5 text-lg-end">
                    <a href="{{ route('gallery-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">
                        Kembali Ke Album
                        <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-130">
    <div class="container style-one">
        @if($galleries && $galleries->count() > 0)
            <div class="row">
                @foreach($galleries as $index => $item)
                    <div class="col-xl-4 col-md-6 mb-30" data-cue="slideInUp" data-delay="{{ ($index % 3) * 100 }}">
                        <div class="gallery-item-card">
                            <div class="gallery-item-card__media">
                                @if(!empty($item['image_url']))
                                    <img src="{{ $item['image_url'] }}"
                                         alt="{{ $item['title'] ?? 'Gallery Image' }}"
                                         class="gallery-item-card__image">
                                @else
                                    <div class="gallery-item-card__placeholder">
                                        <div class="text-center text-muted">
                                            <i class="ri-image-line"></i>
                                            <p class="small fst-italic mb-0">Gambar belum ada</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="gallery-item-card__body">
                                <h5 class="gallery-item-card__title">{{ $item['title'] ?? 'Dokumentasi Kegiatan' }}</h5>
                                <span class="gallery-item-card__meta">{{ $item['date'] ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($galleries->hasPages())
                <div class="pagination-area d-flex align-items-center justify-content-center mt-xl-5">
                    @if($galleries->onFirstPage())
                        <span class="page-numbers rounded-circle" style="opacity:.35; cursor:not-allowed;">
                            <img src="{{ asset('assets/marketing/img/icons/left-arrow-blue.svg') }}">
                        </span>
                    @else
                        <a href="{{ $galleries->previousPageUrl() }}" class="page-numbers rounded-circle">
                            <img src="{{ asset('assets/marketing/img/icons/left-arrow-blue.svg') }}">
                        </a>
                    @endif

                    @foreach($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                        @if($page == $galleries->currentPage())
                            <span class="page-numbers current rounded-circle">
                                {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="page-numbers rounded-circle">
                                {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                            </a>
                        @endif
                    @endforeach

                    @if($galleries->hasMorePages())
                        <a href="{{ $galleries->nextPageUrl() }}" class="page-numbers rounded-circle">
                            <img src="{{ asset('assets/marketing/img/icons/right-arrow-blue-2.svg') }}">
                        </a>
                    @else
                        <span class="page-numbers rounded-circle" style="opacity:.35; cursor:not-allowed;">
                            <img src="{{ asset('assets/marketing/img/icons/right-arrow-blue-2.svg') }}">
                        </span>
                    @endif
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="ri-image-line" style="font-size:4rem; color:#ccc;"></i>
                <h4 class="mt-3 text-muted fw-medium">Album ini belum memiliki item galeri</h4>
                <p class="text-muted fst-italic">
                    Tambahkan dokumentasi melalui dashboard admin agar isi album tampil di halaman publik.
                </p>
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
    .album-detail-hero {
        padding: 34px 36px;
        border-radius: 28px;
        background: linear-gradient(180deg, #ffffff 0%, #f8faff 100%);
        border: 1px solid #e9edf7;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    }

    .album-detail-hero__eyebrow {
        display: inline-flex;
        align-items: center;
        margin-bottom: 14px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(217, 255, 49, 0.22);
        color: #111827;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .gallery-item-card {
        overflow: hidden;
        border-radius: 22px;
        background: linear-gradient(180deg, #ffffff 0%, #f8faff 100%);
        border: 1px solid #e9edf7;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    }

    .gallery-item-card__media {
        height: 280px;
        background: linear-gradient(145deg, #161a39 0%, #2b3271 100%);
    }

    .gallery-item-card__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .gallery-item-card__placeholder {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5f7fb;
        border: 2px dashed #d9dff0;
    }

    .gallery-item-card__placeholder i {
        display: block;
        margin-bottom: 10px;
        font-size: 34px;
    }

    .gallery-item-card__body {
        padding: 20px 22px 22px;
    }

    .gallery-item-card__title {
        margin-bottom: 8px;
        color: #101828;
        font-size: 22px;
        font-weight: 600;
        line-height: 1.3;
    }

    .gallery-item-card__meta {
        color: #667085;
        font-size: 13px;
        font-weight: 500;
    }
</style>
@endpush

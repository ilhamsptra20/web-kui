@extends('layouts.marketing')

@section('content')

{{-- =============================================
   BREADCRUMB
============================================= --}}
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">

        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ url('/') }}">HOME</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                GALERI
            </li>
        </ul>

        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-6">
            {{ $breadcrumb['title'] ?? 'Galeri Kegiatan' }}
        </h2>

    </div>
</div>

{{-- =============================================
   ALBUM SECTION
============================================= --}}
<div class="container style-one ptb-130">
    <div class="row">

        {{-- ================= ALBUM GRID ================= --}}
        <div class="col-12">

            @if($albums && $albums->count() > 0)
            <div class="row justify-content-center">

                @foreach($albums as $index => $item)
                <div class="col-md-4 col-sm-6 mb-30"
                     data-cue="slideInUp"
                     data-delay="{{ ($index % 3) * 100 }}">

                    <a href="{{ $item['url'] ?? '#' }}" class="marketing-album-card d-block text-decoration-none">
                        <div class="marketing-album-card__media">
                            @if(!empty($item['image_url']))
                                <img src="{{ $item['image_url'] }}"
                                     alt="{{ $item['name'] ?? 'Album Image' }}"
                                     class="w-100 marketing-album-card__image">
                            @else
                                <div class="marketing-album-card__placeholder">
                                    <div class="text-center text-muted">
                                        <i class="ri-image-line"></i>
                                        <p class="small fst-italic mb-0">Cover album belum ada</p>
                                    </div>
                                </div>
                            @endif
                            <span class="marketing-album-card__count">
                                <i class="ri-image-2-line"></i>
                                {{ $item['gallery_count'] ?? 0 }} Item
                            </span>
                        </div>

                        <div class="marketing-album-card__body">
                            <h5 class="marketing-album-card__title mb-2">
                                {{ $item['name'] ?? 'Album Kegiatan' }}
                            </h5>

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <span class="marketing-album-card__meta">
                                    Update {{ $item['date'] ?? '-' }}
                                </span>
                                <span class="marketing-album-card__link">
                                    Buka Album
                                    <i class="ri-arrow-right-up-line"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>

            @else
            {{-- EMPTY STATE --}}
            <div class="text-center py-5">
                <i class="ri-image-line" style="font-size:4rem; color:#ccc;"></i>
                <h4 class="mt-3 text-muted fw-medium">Belum Ada Album Galeri</h4>
                <p class="text-muted fst-italic">
                    Album dokumentasi kegiatan internasional KUI akan tampil di sini setelah ditambahkan melalui panel admin.
                </p>
            </div>
            @endif

            {{-- ================= PAGINATION ================= --}}
            @if($albums && $albums->hasPages())
            <div class="pagination-area d-flex align-items-center justify-content-center mt-xl-5">

                {{-- Prev --}}
                @if($albums->onFirstPage())
                    <span class="page-numbers rounded-circle"
                          style="opacity:.35; cursor:not-allowed;">
                        <img src="assets/marketing/img/icons/left-arrow-blue.svg">
                    </span>
                @else
                    <a href="{{ $albums->previousPageUrl() }}"
                       class="page-numbers rounded-circle">
                        <img src="assets/marketing/img/icons/left-arrow-blue.svg">
                    </a>
                @endif

                {{-- Pages --}}
                @foreach($albums->getUrlRange(1, $albums->lastPage()) as $page => $url)
                    @if($page == $albums->currentPage())
                        <span class="page-numbers current rounded-circle">
                            {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="page-numbers rounded-circle">
                            {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                        </a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($albums->hasMorePages())
                    <a href="{{ $albums->nextPageUrl() }}"
                       class="page-numbers rounded-circle">
                        <img src="assets/marketing/img/icons/right-arrow-blue-2.svg">
                    </a>
                @else
                    <span class="page-numbers rounded-circle"
                          style="opacity:.35; cursor:not-allowed;">
                        <img src="assets/marketing/img/icons/right-arrow-blue-2.svg">
                    </span>
                @endif

            </div>
            @endif

        </div>

    </div>
</div>

@endsection

@push('styles')
<style>
    .marketing-album-card {
        overflow: hidden;
        border-radius: 22px;
        background: linear-gradient(180deg, #ffffff 0%, #f8faff 100%);
        border: 1px solid #e9edf7;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .marketing-album-card:hover {
        transform: translateY(-6px);
        border-color: rgba(93, 95, 239, 0.2);
        box-shadow: 0 24px 58px rgba(93, 95, 239, 0.12);
    }

    .marketing-album-card__media {
        position: relative;
        height: 280px;
        overflow: hidden;
        background: linear-gradient(145deg, #161a39 0%, #2b3271 100%);
    }

    .marketing-album-card__image {
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .marketing-album-card__placeholder {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5f7fb;
        border: 2px dashed #d9dff0;
    }

    .marketing-album-card__placeholder i {
        display: block;
        margin-bottom: 10px;
        font-size: 34px;
    }

    .marketing-album-card__count {
        position: absolute;
        top: 18px;
        right: 18px;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(12, 18, 46, 0.78);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        backdrop-filter: blur(10px);
    }

    .marketing-album-card__body {
        padding: 22px 22px 24px;
    }

    .marketing-album-card__title {
        color: #101828;
        font-size: 24px;
        font-weight: 600;
        line-height: 1.3;
    }

    .marketing-album-card__meta {
        color: #667085;
        font-size: 13px;
        font-weight: 500;
    }

    .marketing-album-card__link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primaryColor);
        font-size: 14px;
        font-weight: 700;
    }

    .marketing-album-card__link i {
        transition: transform 0.2s ease;
    }

    .marketing-album-card:hover .marketing-album-card__link i {
        transform: translate(3px, -3px);
    }
</style>
@endpush

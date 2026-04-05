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
   GALLERY SECTION
============================================= --}}
<div class="container style-one ptb-130">
    <div class="row">

        {{-- ================= MAIN GALLERY ================= --}}
        <div class="col-12">

            @if($galleries && $galleries->count() > 0)
            <div class="row justify-content-center">

                @foreach($galleries as $index => $item)
                <div class="col-md-4 col-sm-6 mb-30"
                     data-cue="slideInUp"
                     data-delay="{{ ($index % 3) * 100 }}">

                    <div class="gallery-card img-hover-wrap round-10 overflow-hidden position-relative">

                        {{-- IMAGE --}}
                        @if(!empty($item['image_url']))
                            <img src="{{ $item['image_url'] }}"
                                 alt="{{ $item['title'] ?? 'Gallery Image' }}"
                                 class="w-100 transition"
                                 style="height:260px; object-fit:cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height:260px; border:2px dashed #ccc;">
                                <div class="text-center text-muted">
                                    <i class="ri-image-line" style="font-size:2rem;"></i>
                                    <p class="small fst-italic">Gambar belum ada</p>
                                </div>
                            </div>
                        @endif

                        {{-- OVERLAY --}}
                        <div class="gallery-overlay d-flex flex-column justify-content-end p-3"
                             style="position:absolute; inset:0; background:linear-gradient(transparent, rgba(0,0,0,0.7));">

                            {{-- TITLE --}}
                            @if(!empty($item['title']))
                            <h5 class="text-white mb-1">
                                {{ $item['title'] }}
                            </h5>
                            @endif

                            {{-- DATE / META --}}
                            @if(!empty($item['date']))
                            <span class="text-light fs-13">
                                {{ $item['date'] }}
                            </span>
                            @endif

                        </div>

                    </div>
                </div>
                @endforeach

            </div>

            @else
            {{-- EMPTY STATE --}}
            <div class="text-center py-5">
                <i class="ri-image-line" style="font-size:4rem; color:#ccc;"></i>
                <h4 class="mt-3 text-muted fw-medium">Belum Ada Galeri</h4>
                <p class="text-muted fst-italic">
                    Dokumentasi kegiatan internasional KUI akan tampil di sini setelah ditambahkan melalui panel admin.
                </p>
            </div>
            @endif

            {{-- ================= PAGINATION ================= --}}
            @if( $galleries && $galleries->hasPages())
            <div class="pagination-area d-flex align-items-center justify-content-center mt-xl-5">

                {{-- Prev --}}
                @if($galleries->onFirstPage())
                    <span class="page-numbers rounded-circle"
                          style="opacity:.35; cursor:not-allowed;">
                        <img src="assets/marketing/img/icons/left-arrow-blue.svg">
                    </span>
                @else
                    <a href="{{ $galleries->previousPageUrl() }}"
                       class="page-numbers rounded-circle">
                        <img src="assets/marketing/img/icons/left-arrow-blue.svg">
                    </a>
                @endif

                {{-- Pages --}}
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

                {{-- Next --}}
                @if($galleries->hasMorePages())
                    <a href="{{ $galleries->nextPageUrl() }}"
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

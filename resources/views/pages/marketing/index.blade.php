@extends('layouts.marketing')

@section('content')

<!-- =============================================
     HERO SLIDER SECTION START
     ============================================= -->
<div class="hero-area style-two position-relative overflow-hidden round-10 z-1">

    @if(!empty($heroSlides) && count($heroSlides) > 0)

        <div class="swiper hero-slider-main">
            <div class="swiper-wrapper">
                @foreach($heroSlides as $index => $slide)
                <div class="swiper-slide">

                    {{-- Full BG Image --}}
                    <div class="hero-slide-inner position-relative overflow-hidden"
                         style="background: url('{{ asset("/storage/" . ($slide['image'] ?? '')) }}') center center / cover no-repeat;">

                        {{-- Dark gradient overlay biar teks terbaca --}}
                        <div class="hero-bg-overlay position-absolute top-0 start-0 w-100 h-100 z-0"></div>

                        {{-- Decorative blur text (dari template asli) --}}
                        <span class="blur-text style-one position-absolute z-1">UNIVERSITAS</span>
                        <span class="blur-text style-two position-absolute z-1">JUANDA</span>

                        {{-- Section shape bawah --}}
                        <img src="assets/marketing/img/hero/section-shape-1.png" alt="Shape"
                             class="position-absolute bottom-0 start-0 w-100 z-1" style="opacity:.15;">

                        <div class="container-fluid position-relative z-2">
                            <div class="row align-items-center" style="min-height: 680px;">
                                <div class="col-xl-6 col-lg-7 col-md-9">
                                    <div class="hero-content p-5">

                                        @if(!empty($slide['subtitle']))
                                        <h6 class="section-subtitle style-two bg_secondary fs-13 fw-semibold ls-1 d-inline-flex align-items-center gap-2 round-oval mb-20"
                                            data-cue="slideInUp">
                                            <img src="assets/marketing/img/icons/lock.svg" alt="Icon">
                                            {{ $slide['subtitle'] }}
                                        </h6>
                                        @endif

                                        <h1 class="font-secondary fw-medium text-white mb-20"
                                            data-cue="slideInUp" data-delay="200">
                                            {!! $slide['title'] ?? '<span class="fst-italic opacity-50">Judul slide belum diisi</span>' !!}
                                        </h1>

                                        <p class="fs-16 mb-35 text-white" style="opacity:.85; max-width: 520px;"
                                           data-cue="slideInUp" data-delay="300">
                                            {{ $slide['description'] ?? 'Deskripsi slide masih kosong.' }}
                                        </p>

                                        @if(!empty($slide['btn_text']) && !empty($slide['btn_url']))
                                        <div class="d-flex align-items-center gap-3 flex-wrap"
                                             data-cue="slideInUp" data-delay="400">
                                            <a href="{{ $slide['btn_url'] }}"
                                               class="btn style-two fw-semibold position-relative round-oval">
                                                {{ $slide['btn_text'] }}
                                                <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                                    <img src="assets/marketing/img/icons/right-arrow-white.svg" alt="Icon">
                                                </span>
                                            </a>
                                        </div>
                                        @endif

                                    </div>
                                </div>

                                {{-- Circle CTA pojok kanan bawah --}}
                                <div class="col-xl-6 col-lg-5 d-none d-lg-flex justify-content-end align-items-end pb-5">
                                    <div class="circle-text-wrap rounded-circle position-relative">
                                        <span class="bg_secondary position-absolute d-flex flex-column align-items-center justify-content-center rounded-circle transition">
                                            <img src="assets/marketing/img/icons/up-right-arrow.svg" alt="Icon" class="transition">
                                        </span>
                                        <img src="assets/marketing/img/hero/circle-text.svg" alt="Text Image" class="circle-text d-block mx-auto rotate">
                                        <a href="{{ $slide['btn_url'] ?? '#' }}" class="position-absolute top-0 start-0 w-100 h-100 z-1"></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Slide counter badge --}}
                        <div class="hero-slide-counter position-absolute z-3">
                            <span class="font-secondary fw-bold text-white fs-13 opacity-75">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                <span class="opacity-50"> / {{ str_pad(count($heroSlides), 2, '0', STR_PAD_LEFT) }}</span>
                            </span>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            {{-- Navigation: prev | pagination dots | next --}}
            <div class="hero-slider-nav position-absolute d-flex align-items-center z-3">
                <button class="hero-prev border-0 d-flex align-items-center justify-content-center rounded-circle transition">
                    <img src="assets/marketing/img/icons/left-arrow-black.svg" alt="Prev">
                </button>
                <div class="hero-slider-pagination"></div>
                <button class="hero-next border-0 d-flex align-items-center justify-content-center rounded-circle transition">
                    <img src="assets/marketing/img/icons/right-arrow-black.svg" alt="Next">
                </button>
            </div>

            {{-- Progress bar bawah --}}
            <div class="hero-progress-bar position-absolute bottom-0 start-0 z-3">
                <div class="hero-progress-fill"></div>
            </div>

            {{-- ══ ACCREDITATION STRIP — DESKTOP ONLY (absolute overlay) ══ --}}
            @if(!empty($accreditation['items']) && count($accreditation['items']) > 0)
            <div class="accreditation-strip position-absolute d-none d-md-block">
                <div class="accreditation-strip-inner d-flex align-items-center">

                    {{-- Label kiri --}}
                    <div class="accreditation-strip-label flex-shrink-0 d-none d-lg-flex flex-column justify-content-center px-4">
                        <span class="text-white fw-semibold fs-13 ls-1 text-uppercase" style="opacity:.7;">
                            {{ $accreditation['strip_label'] ?? 'Tersertifikasi' }}
                        </span>
                        <span class="text-white fs-11" style="opacity:.45;">& Diakui Oleh</span>
                    </div>

                    {{-- Divider --}}
                    <div class="accreditation-strip-divider d-none d-lg-block flex-shrink-0"></div>

                    {{-- Swiper logo strip --}}
                    <div class="swiper accreditation-strip-slider flex-grow-1 overflow-hidden">
                        <div class="swiper-wrapper align-items-center">
                            @foreach($accreditation['items'] as $item)
                            <div class="swiper-slide accreditation-strip-slide">
                                <div class="accreditation-strip-item d-flex flex-column align-items-center justify-content-center gap-1 position-relative"
                                     title="{{ $item['name'] ?? '' }}">

                                    @if(!empty($item['logo_url']))
                                        <img src="{{ $item['logo_url'] }}"
                                             alt="{{ $item['name'] ?? 'Logo' }}"
                                             class="accreditation-strip-logo">
                                    @else
                                        <div class="accreditation-strip-logo-placeholder d-flex align-items-center justify-content-center">
                                            <i class="ri-award-line text-white" style="font-size:1.4rem; opacity:.5;"></i>
                                        </div>
                                    @endif

                                    @if(!empty($item['name']))
                                    <span class="accreditation-strip-name text-white text-center fw-medium"
                                          style="font-size:10px; opacity:.7; line-height:1.2; max-width:80px;">
                                        {{ $item['name'] }}
                                    </span>
                                    @endif

                                    @if(!empty($item['url']))
                                        <a href="{{ $item['url'] }}" target="_blank" rel="noopener"
                                           class="position-absolute top-0 start-0 w-100 h-100 z-1"></a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            @endif
            {{-- ══ END ACCREDITATION STRIP ══ --}}
        </div>

    @else
        {{-- PLACEHOLDER KOSONG --}}
        <div class="hero-slide-inner position-relative overflow-hidden"
             style="min-height: 680px; background: #1a1a2e;">
            <div class="hero-bg-overlay position-absolute top-0 start-0 w-100 h-100 z-0"></div>
            <div class="container-fluid position-relative z-2">
                <div class="row align-items-center" style="min-height: 680px;">
                    <div class="col-lg-7">
                        <div class="hero-content py-5">
                            <h6 class="section-subtitle style-two bg_secondary fs-13 fw-semibold ls-1 d-inline-flex align-items-center gap-2 round-oval mb-20">
                                <img src="assets/marketing/img/icons/lock.svg" alt="Icon">
                                {{ $heroEmptyState['badge'] ?? 'KONTEN SLIDER MASIH KOSONG' }}
                            </h6>
                            <h1 class="font-secondary fw-medium text-white">
                                {{ $heroEmptyState['title'] ?? 'Tambahkan Slide Hero Via Dashboard Admin' }}
                            </h1>
                            <p class="text-white fst-italic" style="opacity:.6;">
                                {{ $heroEmptyState['description'] ?? 'Belum ada data hero slider. Silakan tambahkan melalui panel manajemen konten.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
<!-- HERO SLIDER SECTION END -->

{{-- ══ ACCREDITATION — MOBILE ONLY (section biasa) ══ --}}
@if(!empty($accreditation['items']) && count($accreditation['items']) > 0)
<div class="accreditation-mobile-section d-block d-md-none bg_primary py-40 round-10">
    <div class="container">
        <p class="text-white fw-semibold fs-13 text-center mb-20 ls-1 text-uppercase" style="opacity:.65;">
            {{ $accreditation['strip_label'] ?? 'Tersertifikasi & Diakui Oleh' }}
        </p>
        <div class="swiper accreditation-mobile-slider">
            <div class="swiper-wrapper align-items-center">
                @foreach($accreditation['items'] as $item)
                <div class="swiper-slide">
                    <div class="d-flex flex-column align-items-center justify-content-center gap-2 text-center px-2 position-relative">
                        @if(!empty($item['logo_url']))
                            <div class="accreditation-mobile-logo-wrap d-flex align-items-center justify-content-center mx-auto">
                                <img src="{{ $item['logo_url'] }}"
                                     alt="{{ $item['name'] ?? 'Logo' }}"
                                     class="accreditation-mobile-logo">
                            </div>
                        @endif
                        @if(!empty($item['name']))
                        <span class="text-white fw-medium" style="font-size:11px; opacity:.75; line-height:1.3;">
                            {{ $item['name'] }}
                        </span>
                        @endif
                        @if(!empty($item['label']))
                        <span class="bg_secondary fs-11 fw-semibold text-black round-oval px-2 py-1">
                            {{ $item['label'] }}
                        </span>
                        @endif
                        @if(!empty($item['url']))
                            <a href="{{ $item['url'] }}" target="_blank" rel="noopener"
                               class="position-absolute top-0 start-0 w-100 h-100 z-1"></a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="accreditation-mobile-pagination d-flex justify-content-center mt-20 gap-1"></div>
        </div>
    </div>
</div>
@endif
{{-- ══ END ACCREDITATION MOBILE ══ --}}


<!-- =============================================
     ABOUT SECTION START
     ============================================= -->
<div class="about-area style-two position-relative z-1 overflow-hidden pt-130 pb-100">
    <div class="container">
        <div class="row">
            {{-- Deskripsi & Tombol --}}
            <div class="col-lg-3 col-md-5 pe-xxl-5 mb-30" data-cue="slideInUp">
                <p class="mb-40">
                    {{ $about['description'] ?? 'Deskripsi tentang perusahaan masih kosong. Silakan tambahkan melalui panel admin.' }}
                </p>
                <a href="{{ $about['btn_url'] ?? '#' }}" class="btn style-two fw-semibold position-relative round-oval">
                    {{ $about['btn_text'] ?? 'Pelajari Lebih Lanjut' }}
                    <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                        <img src="assets/marketing/img/icons/right-arrow-white.svg" alt="Icon">
                    </span>
                </a>
            </div>

            {{-- Gambar About --}}
            <div class="col-lg-4 col-md-7 mb-30">
                <div class="about-img round-10" data-cue="slideInUp">
                    @if(!empty($about['image']))
                        <img src="{{ $about['image'] }}" alt="About Image" class="round-10">
                    @else
                        <div class="round-10 bg-light d-flex align-items-center justify-content-center" style="min-height:300px; border: 2px dashed #ccc;">
                            <div class="text-center text-muted p-3">
                                <i class="ri-image-line" style="font-size: 2.5rem;"></i>
                                <p class="mt-2 fst-italic small">Gambar about belum diupload</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Subtitle & Judul --}}
            <div class="col-lg-5 ps-xxl-5 pe-xxl-4 mb-30">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15" data-cue="slideInUp">
                    <img src="assets/marketing/img/icons/lock.svg" alt="Icon">
                    {{ $about['subtitle'] ?? 'TENTANG KAMI' }}
                </span>
                <h2 class="section-title style-one font-secondary fw-medium mb-40" data-cue="slideInUp" data-delay="400">
                    {{ $about['title'] ?? 'Judul bagian about masih kosong.' }}
                </h2>
            </div>
        </div>
    </div>

    {{-- Moving Text --}}
    <div class="move-text style-six overflow-hidden">
        <ul class="list-unstyled mb-0">
            @php $moveText = $about['move_text'] ?? 'SMARTER PROTECTION FOR YOUR DATA, NETWORK, AND CLOUD SYSTEMS'; @endphp
            <li class="position-relative font-secondary">{{ $moveText }}</li>
            <li class="position-relative font-secondary">{{ $moveText }}</li>
            <li class="position-relative font-secondary">{{ $moveText }}</li>
        </ul>
    </div>
</div>
<!-- ABOUT SECTION END -->

<!-- =============================================
     PROFILE VIDEO SECTION START
     ============================================= -->
<div class="profile-video-area position-relative overflow-hidden round-20 ptb-130">
    <div class="profile-video-shape profile-video-shape-one"></div>
    <div class="profile-video-shape profile-video-shape-two"></div>

    <div class="container style-one position-relative z-1">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-cue="slideInUp">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15">
                    <img src="assets/marketing/img/icons/lock.svg" alt="Icon">
                    {{ $profile['subtitle'] ?? 'PROFIL UNIVERSITAS DJUANDA' }}
                </span>
                <h2 class="section-title style-one font-secondary fw-medium text-white mb-25">
                    {{ $profile['title'] ?? 'Mengenal Universitas Djuanda' }}
                </h2>
                <p class="profile-video-description mb-30">
                    {{ $profile['description'] ?? 'Profil Universitas Djuanda akan tampil di section ini.' }}
                </p>

                @if(!empty($profile['highlights']))
                    <ul class="profile-video-list list-unstyled mb-35">
                        @foreach($profile['highlights'] as $highlight)
                            <li>
                                <i class="ri-check-line"></i>
                                <span>{{ $highlight }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if(!empty($profile['button_url']))
                    <a href="{{ $profile['button_url'] }}" class="btn style-two fw-semibold position-relative round-oval">
                        {{ $profile['button_text'] ?? 'Lihat Profil Lengkap' }}
                        <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                            <img src="assets/marketing/img/icons/right-arrow-white.svg" alt="Icon">
                        </span>
                    </a>
                @endif
            </div>

            <div class="col-lg-7" data-cue="slideInUp" data-delay="150">
                <div class="profile-video-card">
                    @if(!empty($profile['video']))
                        @if(!empty($profile['video']['embed_url']))
                            <div class="profile-video-frame">
                                <iframe
                                    src="{{ $profile['video']['embed_url'] }}"
                                    title="{{ $profile['video']['title'] }}"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        @else
                            <a href="{{ $profile['video']['url'] }}" target="_blank" rel="noopener" class="profile-video-link">
                                @if(!empty($profile['video']['thumbnail_url']))
                                    <img src="{{ $profile['video']['thumbnail_url'] }}" alt="{{ $profile['video']['title'] }}">
                                @else
                                    <div class="profile-video-placeholder">
                                        <i class="ri-video-line"></i>
                                        <span>{{ $profile['video']['title'] }}</span>
                                    </div>
                                @endif
                                <span class="profile-video-play">
                                    <i class="ri-play-fill"></i>
                                </span>
                            </a>
                        @endif

                        <div class="profile-video-caption">
                            <span>Video Profile</span>
                            <strong>{{ $profile['video']['title'] }}</strong>
                        </div>
                    @else
                        <div class="profile-video-empty">
                            <i class="ri-video-add-line"></i>
                            <p class="mb-0">{{ $profile['empty_video_text'] ?? 'Video profile aktif belum dipilih dari module Video.' }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PROFILE VIDEO SECTION END -->


<!-- =============================================
     BLOG SECTION START
     ============================================= -->
<div class="pt-130 pb-100 blog-slider-section overflow-hidden">
    <div class="container style-one">

        {{-- Header row: judul kiri, nav kanan --}}
        <div class="row align-items-end mb-40">
            <div class="col-lg-6 col-md-8">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15" data-cue="slideInUp">
                    <img src="assets/marketing/img/icons/lock.svg" alt="Icon">
                    {{ $blogSection['subtitle'] ?? 'BLOG & NEWS' }}
                </span>
                <h2 class="section-title style-one fw-medium text-title mb-0" data-cue="slideInUp" data-delay="200">
                    {{ $blogSection['title'] ?? 'Expert Tips And Trends In Cloud Security' }}
                </h2>
            </div>
            <div class="col-lg-6 col-md-4 d-flex align-items-center justify-content-md-end gap-3 mt-md-0 mt-20" data-cue="slideInUp" data-delay="300">
                {{-- Prev / Next --}}
                <button class="blog-slider-prev border-0 d-flex align-items-center justify-content-center rounded-circle transition flex-shrink-0">
                    <img src="assets/marketing/img/icons/left-arrow-black.svg" alt="Prev">
                </button>
                <div class="blog-slider-pagination"></div>
                <button class="blog-slider-next border-0 d-flex align-items-center justify-content-center rounded-circle transition flex-shrink-0">
                    <img src="assets/marketing/img/icons/right-arrow-black.svg" alt="Next">
                </button>
                @if(!empty($blogSection['see_all_url']))
                <a href="{{ $blogSection['see_all_url'] }}"
                   class="btn style-two fw-semibold position-relative round-oval ms-2 d-none d-lg-inline-flex">
                    {{ $blogSection['see_all_text'] ?? 'View All' }}
                    <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                        <img src="assets/marketing/img/icons/right-arrow-white.svg" alt="Icon">
                    </span>
                </a>
                @endif
            </div>
        </div>

    </div>

    {{-- Slider full-bleed biar kartu bisa peek ke kanan --}}
    <div class="blog-slider-outer">
        @if(!empty($blogPosts) && count($blogPosts) > 0)
        <div class="swiper blog-slider-main">
            <div class="swiper-wrapper">
                @foreach($blogPosts as $index => $post)
                <div class="swiper-slide">
                    <div class="blog-card style-one img-hover-wrap round-10 h-100">

                        {{-- Thumbnail --}}
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            @if(!empty($post['image']))
                                <img src="{{ asset("storage/" . $post['image']) }}"
                                     alt="{{ $post['title'] ?? 'Blog' }}"
                                     class="transition round-10 blog-card-thumb">
                            @else
                                <div class="round-10 bg-light d-flex align-items-center justify-content-center blog-card-thumb"
                                     style="border: 2px dashed #ccc;">
                                    <div class="text-center text-muted p-3">
                                        <i class="ri-article-line" style="font-size: 2.5rem;"></i>
                                        <p class="mt-1 fst-italic small">Gambar belum ada</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-1">
                                @if(!empty($post['category']))
                                    <a class="blog-category fs-15 fw-medium d-inline-block round-oval"
                                       href="{{ $post['category_url'] ?? '#' }}">
                                        {{ $post['category'] }}
                                    </a>
                                @else
                                    <span class="blog-category fs-15 fw-medium d-inline-block round-oval text-muted fst-italic">
                                        Uncategorized
                                    </span>
                                @endif
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By <a href="{{ $post['author_url'] ?? '#' }}">{{ $post['author'] ?? 'Admin' }}</a></li>
                                    <li><a href="{{ $post['date_url'] ?? '#' }}">{{ $post['date'] ?? '-' }}</a></li>
                                </ul>
                            </div>
                            <h3 class="fs-20 fw-semibold">
                                <a href="{{ $post['url'] ?? '#' }}"
                                   class="text-black link-hover-primary transition">
                                    {{ $post['title'] ?? 'Judul artikel masih kosong.' }}
                                </a>
                            </h3>
                            <a href="{{ $post['url'] ?? '#' }}" class="link style-two fw-semibold">
                                {{ $post['read_more_text'] ?? 'Read More' }}<i class="ri-arrow-right-line"></i>
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @else
        {{-- Placeholder kosong --}}
        <div class="swiper blog-slider-main">
            <div class="swiper-wrapper">
                @for($i = 0; $i < 4; $i++)
                <div class="swiper-slide">
                    <div class="blog-card style-one img-hover-wrap round-10 h-100">
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            <div class="round-10 bg-light d-flex align-items-center justify-content-center blog-card-thumb"
                                 style="border: 2px dashed #ccc;">
                                <div class="text-center text-muted p-3">
                                    <i class="ri-article-line" style="font-size: 2.5rem;"></i>
                                    <p class="mt-1 fst-italic small">{{ $blogSection['empty_description'] ?? 'Konten artikel masih kosong' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-1">
                                <span class="blog-category fs-15 fw-medium d-inline-block round-oval text-muted fst-italic">Uncategorized</span>
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By <span class="text-muted">-</span></li>
                                    <li><span class="text-muted">-</span></li>
                                </ul>
                            </div>
                            <h3 class="fs-20 fw-semibold text-muted fst-italic">{{ $blogSection['empty_title'] ?? 'Artikel belum ditambahkan' }}</h3>
                            <span class="link style-two fw-semibold text-muted">Read More <i class="ri-arrow-right-line"></i></span>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
        @endif
    </div>

    {{-- Tombol lihat semua - mobile only --}}
    @if(!empty($blogSection['see_all_url']))
    <div class="container style-one">
        <div class="text-center mt-30 d-lg-none">
            <a href="{{ $blogSection['see_all_url'] }}"
               class="btn style-two fw-semibold position-relative round-oval">
                {{ $blogSection['see_all_text'] ?? 'Lihat Semua Artikel' }}
                <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                    <img src="assets/marketing/img/icons/right-arrow-white.svg" alt="Icon">
                </span>
            </a>
        </div>
    </div>
    @endif
</div>
<!-- BLOG SECTION END -->


<!-- =============================================
     GALLERY SECTION START
     ============================================= -->
<div class="gallery-area position-relative z-1 ptb-130 bg-f round-20">
    <div class="container style-one">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-1 text-center">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15" data-cue="slideInUp">
                    <img src="assets/marketing/img/icons/lock.svg" alt="Icon">
                    {{ $gallery['subtitle'] ?? 'GALERI KAMI' }}
                </span>
                <h2 class="section-title style-one font-secondary fw-medium mb-40" data-cue="slideInUp" data-delay="400">
                    {{ $gallery['title'] ?? 'Sekilas Tentang Operasional Kami' }}
                </h2>
            </div>
        </div>

        @if(!empty($gallery['items']) && count($gallery['items']) > 0)
            {{-- GALLERY GRID --}}
            <div class="row gallery-grid g-3">
                @foreach($gallery['items'] as $index => $item)
                    @php
                        // Layout masonry: item pertama dan kelima lebih besar
                        $isLarge = ($index % 5 === 0 || $index % 5 === 4);
                        $colClass = $isLarge ? 'col-md-6' : 'col-md-3';
                    @endphp
                    <div class="{{ $colClass }} col-6" data-cue="slideInUp" data-delay="{{ ($index % 3) * 100 }}">
                        <div class="gallery-item img-hover-wrap round-10 overflow-hidden position-relative">
                            @if(!empty($item['image']))
                                <img src="{{ asset("storage/" . $item['image']) }}"
                                     alt="{{ $item['caption'] ?? 'Gallery Image ' . ($index + 1) }}"
                                     class="w-100 transition round-10"
                                     style="height: {{ $isLarge ? '320px' : '220px' }}; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center round-10"
                                     style="height: {{ $isLarge ? '320px' : '220px' }}; border: 2px dashed #ccc;">
                                    <div class="text-center text-muted p-3">
                                        <i class="ri-image-add-line" style="font-size: 2rem;"></i>
                                        <p class="mt-1 fst-italic small">Gambar belum ada</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Overlay Caption --}}
                            @if(!empty($item['caption']) || !empty($item['url']))
                            <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-end p-3 round-10 transition"
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%); opacity:0; transition: opacity 0.3s ease;">
                                @if(!empty($item['caption']))
                                    <span class="text-white fw-semibold fs-15">{{ $item['caption'] }}</span>
                                @endif
                                @if(!empty($item['url']))
                                    <a href="{{ $item['url'] }}" class="position-absolute top-0 start-0 w-100 h-100 z-1"></a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tombol Lihat Semua Gallery --}}
            @if(!empty($gallery['see_all_url']))
            <div class="text-center mt-40" data-cue="slideInUp">
                <a href="{{ $gallery['see_all_url'] }}" class="btn style-two fw-semibold position-relative round-oval">
                    {{ $gallery['see_all_text'] ?? 'Lihat Semua Galeri' }}
                    <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                        <img src="assets/marketing/img/icons/right-arrow-white.svg" alt="Icon">
                    </span>
                </a>
            </div>
            @endif

        @else
            {{-- Placeholder jika gallery kosong --}}
            <div class="row g-3">
                @for($i = 0; $i < 6; $i++)
                    @php $isLarge = ($i === 0 || $i === 5); @endphp
                    <div class="{{ $isLarge ? 'col-md-6' : 'col-md-3' }} col-6" data-cue="slideInUp">
                        <div class="bg-light d-flex align-items-center justify-content-center round-10"
                             style="height: {{ $isLarge ? '320px' : '220px' }}; border: 2px dashed #ccc;">
                            <div class="text-center text-muted p-3">
                                <i class="ri-image-add-line" style="font-size: 2rem;"></i>
                                    <p class="mt-1 fst-italic small">Galeri KUI masih kosong</p>
                                </div>
                            </div>
                        </div>
                @endfor
            </div>
            <div class="text-center mt-30">
                <p class="text-muted fst-italic">{{ $gallery['empty_description'] ?? 'Belum ada item galeri yang ditambahkan. Tambahkan melalui panel admin.' }}</p>
            </div>
        @endif
    </div>
</div>
<!-- GALLERY SECTION END -->


<!-- =============================================
     CUSTOM CSS & JS UNTUK HERO SLIDER
     ============================================= -->
@push('styles')
<style>
    .profile-video-area {
        background: radial-gradient(circle at 12% 10%, rgba(184, 255, 18, .18), transparent 28%),
            linear-gradient(135deg, #080817 0%, #11152d 52%, #050510 100%);
        color: #fff;
    }

    .profile-video-shape {
        position: absolute;
        border-radius: 999px;
        filter: blur(10px);
        opacity: .45;
        pointer-events: none;
    }

    .profile-video-shape-one {
        width: 260px;
        height: 260px;
        left: -80px;
        bottom: -90px;
        background: rgba(184, 255, 18, .18);
    }

    .profile-video-shape-two {
        width: 360px;
        height: 360px;
        right: -120px;
        top: -140px;
        background: rgba(88, 101, 242, .22);
    }

    .profile-video-description {
        color: rgba(255, 255, 255, .74);
        line-height: 1.8;
    }

    .profile-video-list {
        display: grid;
        gap: .85rem;
    }

    .profile-video-list li {
        display: flex;
        align-items: flex-start;
        gap: .75rem;
        color: rgba(255, 255, 255, .82);
    }

    .profile-video-list i {
        width: 26px;
        height: 26px;
        flex: 0 0 26px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        background: var(--color-secondary, #b8ff12);
        color: #0b0b16;
        font-size: 1rem;
    }

    .profile-video-card {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 28px;
        background: rgba(255, 255, 255, .08);
        box-shadow: 0 30px 80px rgba(0, 0, 0, .32);
        backdrop-filter: blur(16px);
        padding: 14px;
    }

    .profile-video-frame,
    .profile-video-link,
    .profile-video-placeholder,
    .profile-video-empty {
        min-height: 410px;
        border-radius: 20px;
    }

    .profile-video-frame {
        position: relative;
        overflow: hidden;
        background: #000;
    }

    .profile-video-frame iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .profile-video-link {
        position: relative;
        display: block;
        overflow: hidden;
        color: inherit;
        background: #000;
    }

    .profile-video-link img {
        width: 100%;
        height: 410px;
        object-fit: cover;
        display: block;
        opacity: .8;
        transition: transform .45s ease, opacity .45s ease;
    }

    .profile-video-link:hover img {
        transform: scale(1.04);
        opacity: .95;
    }

    .profile-video-play {
        position: absolute;
        inset: 50% auto auto 50%;
        width: 72px;
        height: 72px;
        display: grid;
        place-items: center;
        transform: translate(-50%, -50%);
        border-radius: 999px;
        background: var(--color-secondary, #b8ff12);
        color: #050510;
        font-size: 2rem;
        box-shadow: 0 20px 50px rgba(184, 255, 18, .35);
    }

    .profile-video-caption {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding: 16px 4px 2px;
        color: rgba(255, 255, 255, .82);
    }

    .profile-video-caption span {
        color: var(--color-secondary, #b8ff12);
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .profile-video-caption strong {
        max-width: 70%;
        text-align: right;
        color: #fff;
    }

    .profile-video-placeholder,
    .profile-video-empty {
        display: grid;
        place-items: center;
        text-align: center;
        padding: 2rem;
        border: 2px dashed rgba(255, 255, 255, .16);
        color: rgba(255, 255, 255, .64);
    }

    .profile-video-placeholder i,
    .profile-video-empty i {
        display: block;
        margin-bottom: .8rem;
        font-size: 2.6rem;
        color: var(--color-secondary, #b8ff12);
    }

    /* =============================================
       HERO SLIDER — FULL BACKGROUND
       ============================================= */

    .hero-slider-main {
        width: 100%;
        overflow: hidden;
        position: relative;
    }

    /* Setiap slide tinggi full viewport-ish */
    .hero-slide-inner {
        min-height: 680px;
        background-size: cover !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
    }

    /* Ken Burns effect — gambar perlahan zoom in */
    .swiper-slide .hero-slide-inner {
        transform: scale(1.06);
        transition: transform 6s ease;
    }
    .swiper-slide-active .hero-slide-inner {
        transform: scale(1);
    }

    /* Overlay gradient: gelap di kiri (teks), transparan ke kanan */
    .hero-bg-overlay {
        background: linear-gradient(
            105deg,
            rgba(10, 10, 30, 0.80) 0%,
            rgba(10, 10, 30, 0.55) 45%,
            rgba(10, 10, 30, 0.20) 100%
        );
        z-index: 1;
    }

    /* Teks hero — pastikan terbaca di atas bg gelap */
    .hero-content h1.text-white .text_primary {
        color: var(--color-primary, #5865f2) !important;
    }

    /* Slide counter — pojok kanan bawah */
    .hero-slide-counter {
        right: 40px;
        bottom: 50px;
        letter-spacing: 2px;
    }

    /* Navigation bar kiri bawah */
    .hero-slider-nav {
        bottom: 40px;
        left: 50px;
        gap: 14px;
    }

    .hero-prev,
    .hero-next {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.25) !important;
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.25s, border-color 0.25s;
    }

    .hero-prev:hover,
    .hero-next:hover {
        background: var(--color-primary, #5865f2);
        border-color: var(--color-primary, #5865f2) !important;
    }

    /* Arrow icon — putih di atas bg gelap */
    .hero-prev img,
    .hero-next img {
        filter: brightness(0) invert(1);
    }

    /* Pagination bullets */
    .hero-slider-pagination {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .hero-slider-pagination .swiper-pagination-bullet {
        width: 8px;
        height: 8px;
        background: rgba(255,255,255,0.45);
        opacity: 1;
        border-radius: 50%;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .hero-slider-pagination .swiper-pagination-bullet-active {
        background: #fff;
        width: 28px;
        border-radius: 4px;
    }

    /* Progress bar tipis di paling bawah */
    .hero-progress-bar {
        width: 100%;
        height: 3px;
        background: rgba(255,255,255,0.15);
    }

    .hero-progress-fill {
        height: 100%;
        width: 0%;
        background: var(--color-primary, #5865f2);
        transition: width linear;
    }

    /* =============================================
       BLOG SLIDER
       ============================================= */
    
    .swiper-horizontal>
    .swiper-pagination-bullets, 
    .swiper-pagination-bullets.swiper-pagination-horizontal, 
    .swiper-pagination-custom, 
    .swiper-pagination-fraction {
        bottom: var(--swiper-pagination-bottom, 8px);
        top: var(--swiper-pagination-top, auto);
        left: 0;
        width: auto;
    }
    /* Outer wrapper: overflow visible ke kanan buat efek peek */
    .blog-slider-outer {
        padding-left: calc((100vw - 1320px) / 2);  /* align kiri sama container */
        padding-right: 0;
        overflow: hidden;
    }

    /* Fallback untuk layar < 1320px */
    @media (max-width: 1399px) {
        .blog-slider-outer { padding-left: calc((100vw - 1140px) / 2); }
    }
    @media (max-width: 1199px) {
        .blog-slider-outer { padding-left: calc((100vw - 960px) / 2); }
    }
    @media (max-width: 991px) {
        .blog-slider-outer { padding-left: calc((100vw - 720px) / 2); }
    }
    @media (max-width: 767px) {
        .blog-slider-outer { padding-left: 16px; }
        .profile-video-area { border-radius: 16px; }
        .profile-video-frame,
        .profile-video-link,
        .profile-video-placeholder,
        .profile-video-empty { min-height: 260px; }
        .profile-video-link img { height: 260px; }
        .profile-video-caption {
            flex-direction: column;
        }
        .profile-video-caption strong {
            max-width: none;
            text-align: left;
        }
    }

    /* Swiper wrapper gap */
    .blog-slider-main {
        overflow: visible !important; /* biar slide berikutnya keliatan */
    }

    /* Thumbnail tinggi fixed biar semua card seragam */
    .blog-card-thumb {
        width: 100%;
        height: 240px;
        object-fit: cover;
        display: block;
    }

    /* Card hover shadow */
    .blog-slider-main .blog-card.style-one {
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .blog-slider-main .blog-card.style-one:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.10);
    }

    /* Slide non-aktif sedikit fade & scale */
    .blog-slider-main .swiper-slide {
        opacity: 0.55;
        transform: scale(0.97);
        transition: opacity 0.4s ease, transform 0.4s ease;
    }

    .blog-slider-main .swiper-slide-active,
    .blog-slider-main .swiper-slide-next {
        opacity: 1;
        transform: scale(1);
    }

    /* Nav buttons blog slider */
    .blog-slider-prev,
    .blog-slider-next {
        width: 48px;
        height: 48px;
        background: #fff;
        border: 1px solid #e5e5e5 !important;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        cursor: pointer;
        transition: background 0.25s, border-color 0.25s, box-shadow 0.25s;
    }

    .blog-slider-prev:hover,
    .blog-slider-next:hover {
        background: var(--color-primary, #5865f2);
        border-color: var(--color-primary, #5865f2) !important;
        box-shadow: 0 6px 20px rgba(88,101,242,0.30);
    }

    .blog-slider-prev:hover img,
    .blog-slider-next:hover img {
        filter: brightness(0) invert(1);
    }

    /* Pagination dots blog */
    .blog-slider-pagination {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .blog-slider-pagination .swiper-pagination-bullet {
        width: 8px;
        height: 8px;
        background: #ccc;
        opacity: 1;
        border-radius: 50%;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .blog-slider-pagination .swiper-pagination-bullet-active {
        background: var(--color-primary, #5865f2);
        width: 24px;
        border-radius: 4px;
    }

    /* =============================================
       ACCREDITATION STRIP — DESKTOP (absolute overlay di hero)
       ============================================= */

    /* Strip wrapper — nempel di bottom hero, di atas progress bar */
    .accreditation-strip {
        height: 76px;
        bottom: 50px; /* tepat di atas progress bar 3px */
        width: 70%;
        right: 0;
        background: rgba(8, 8, 25, 0.55);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-top: 1px solid rgba(255, 255, 255, 0.10);
        z-index: 10;
    }

    .accreditation-strip-inner {
        height: 76px;
        overflow: hidden;
    }

    /* Label kiri */
    .accreditation-strip-label {
        min-width: 130px;
        height: 100%;
        border-right: 1px solid rgba(255,255,255,0.10);
    }

    /* Divider vertikal */
    .accreditation-strip-divider {
        width: 1px;
        height: 40px;
        background: rgba(255,255,255,0.10);
        flex-shrink: 0;
    }

    /* Swiper strip — tiap item */
    .accreditation-strip-slider {
        height: 76px;
        padding: 0 20px;
    }

    .accreditation-strip-slide {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    .accreditation-strip-item {
        padding: 8px 10px;
        border-radius: 10px;
        transition: background 0.25s ease;
        cursor: default;
    }

    .accreditation-strip-item:hover {
        background: rgba(255,255,255,0.08);
    }

    /* Logo di dalam strip */
    .accreditation-strip-logo {
        height: 30px;
        max-width: 70px;
        object-fit: contain;
        filter: none;
        opacity: 1;
        transition: transform 0.25s ease;
    }

    .accreditation-strip-item:hover .accreditation-strip-logo {
        transform: translateY(-1px);
    }

    .accreditation-strip-logo-placeholder {
        width: 34px;
        height: 34px;
    }

    /* Nama lembaga kecil di bawah logo */
    .accreditation-strip-name {
        display: block;
        opacity: 0;
        transform: translateY(4px);
        transition: opacity 0.25s ease, transform 0.25s ease;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .accreditation-strip-item:hover .accreditation-strip-name {
        opacity: 0.65;
        transform: translateY(0);
    }

    /* =============================================
       ACCREDITATION — MOBILE SECTION
       ============================================= */
    .accreditation-mobile-section {
        margin-top: 0;
    }

    .accreditation-mobile-logo-wrap {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.18);
        overflow: hidden;
    }

    .accreditation-mobile-logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 10px;
        filter: none;
        opacity: 1;
    }

    .accreditation-mobile-pagination .swiper-pagination-bullet {
        width: 6px;
        height: 6px;
        background: rgba(255,255,255,0.35);
        opacity: 1;
        border-radius: 50%;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-block;
    }

    .accreditation-mobile-pagination .swiper-pagination-bullet-active {
        background: #fff;
        width: 18px;
        border-radius: 3px;
    }

    /* =============================================
       GALLERY HOVER
       ============================================= */
        opacity: 1 !important;
    }

    .gallery-item img {
        transition: transform 0.4s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Hero Slider ──────────────────────────────
    const heroEl = document.querySelector('.hero-slider-main');
    if (!heroEl) return;

    const AUTOPLAY_DELAY = 5500;
    const progressFill   = heroEl.querySelector('.hero-progress-fill');

    // Reset & jalankan progress bar
    function startProgress() {
        if (!progressFill) return;
        progressFill.style.transition = 'none';
        progressFill.style.width = '0%';
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                progressFill.style.transition = 'width ' + AUTOPLAY_DELAY + 'ms linear';
                progressFill.style.width = '100%';
            });
        });
    }

    const swiper = new Swiper('.hero-slider-main', {
        loop           : true,
        speed          : 900,
        autoplay       : {
            delay               : AUTOPLAY_DELAY,
            disableOnInteraction: false,
        },
        effect         : 'fade',
        fadeEffect     : { crossFade: true },
        pagination     : {
            el       : '.hero-slider-pagination',
            clickable: true,
        },
        navigation     : {
            prevEl: '.hero-prev',
            nextEl: '.hero-next',
        },
        on: {
            init             : startProgress,
            slideChangeTransitionStart: startProgress,
        }
    });

    // ── Accreditation Strip (desktop) ────────────
    if (document.querySelector('.accreditation-strip-slider')) {
        new Swiper('.accreditation-strip-slider', {
            loop          : true,
            speed         : 500,
            autoplay      : {
                delay               : 2500,
                disableOnInteraction: false,
                pauseOnMouseEnter   : true,
            },
            slidesPerView : 4,
            spaceBetween  : 8,
            allowTouchMove: true,
            breakpoints: {
                768:  { slidesPerView: 5,  spaceBetween: 10 },
                992:  { slidesPerView: 6,  spaceBetween: 12 },
                1200: { slidesPerView: 7,  spaceBetween: 14 },
                1400: { slidesPerView: 8,  spaceBetween: 16 },
            },
        });
    }

    // ── Accreditation Mobile ──────────────────────
    if (document.querySelector('.accreditation-mobile-slider')) {
        new Swiper('.accreditation-mobile-slider', {
            loop          : true,
            speed         : 500,
            autoplay      : {
                delay               : 2800,
                disableOnInteraction: false,
            },
            slidesPerView : 3,
            spaceBetween  : 16,
            pagination    : {
                el       : '.accreditation-mobile-pagination',
                clickable: true,
            },
            breakpoints: {
                480: { slidesPerView: 4, spaceBetween: 16 },
            },
        });
    }


    if (document.querySelector('.blog-slider-main')) {
        new Swiper('.blog-slider-main', {
            loop          : true,
            speed         : 700,
            autoplay      : {
                delay               : 4000,
                disableOnInteraction: false,
            },
            slidesPerView : 1.15,
            spaceBetween  : 20,
            centeredSlides: false,
            pagination    : {
                el       : '.blog-slider-pagination',
                clickable: true,
            },
            navigation    : {
                prevEl: '.blog-slider-prev',
                nextEl: '.blog-slider-next',
            },
            breakpoints: {
                576: {
                    slidesPerView: 1.5,
                    spaceBetween : 24,
                },
                768: {
                    slidesPerView: 2.2,
                    spaceBetween : 28,
                },
                992: {
                    slidesPerView: 2.5,
                    spaceBetween : 30,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween : 32,
                },
                1400: {
                    slidesPerView: 3.2,
                    spaceBetween : 34,
                },
            },
        });
    }

});
</script>
@endpush

@endsection

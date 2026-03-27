@extends('layouts.marketing')

@section('content')

{{--
    ============================================================
    VARIABEL YANG DIBUTUHKAN DARI CONTROLLER:
    ============================================================

    // HERO SLIDER
    $heroSlides = [
        [
            'subtitle'    => 'SMARTER SECURITY, POWERED BY AI!',
            'title'       => 'AI-Powered <span>Cybersecurity</span> For A Safer Digital World',
            'description' => 'Protect your business with real-time threat detection...',
            'btn_text'    => 'Get Started',
            'btn_url'     => '/contact',
            'image'       => 'assets/marketing/img/hero/hero-img-2.png',
            'bg_class'    => 'bg-f', // optional: class tambahan per slide
        ],
        ...
    ];

    // ABOUT
    $about = [
        'description' => 'We Are a cybersecurity-first company...',
        'btn_text'    => 'Learn More',
        'btn_url'     => '/about-us',
        'image'       => 'assets/marketing/img/about/about-img-2.jpg',
        'subtitle'    => 'ABOUT US',
        'title'       => 'Protecting What Matters Most Through Cutting Edge Intelligence',
    ];

    // BLOG POSTS
    $blogPosts = [
        [
            'image'      => 'assets/marketing/img/blog/blog-4.jpg',
            'author'     => 'Admin',
            'author_url' => '/posts-by-author',
            'date'       => '12 Aug, 2025',
            'date_url'   => '/posts-by-date',
            'title'      => 'How AI Is Revolutionizing Build Cybersecurity Defense Systems',
            'url'        => '/blog/detail',
        ],
        ...
    ];

    // GALLERY
    $gallery = [
        'subtitle' => 'OUR GALLERY',
        'title'    => 'A Glimpse Into Our Security Operations Center',
        'items'    => [
            ['image' => 'assets/marketing/img/gallery/gallery-1.jpg', 'caption' => 'SOC Operations'],
            ['image' => 'assets/marketing/img/gallery/gallery-2.jpg', 'caption' => 'Threat Analysis'],
            ...
        ],
    ];
    ============================================================
--}}

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
                         style="background: url('{{ $slide['image'] ?? '' }}') center center / cover no-repeat;">

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

        </div>

    @else
        {{-- PLACEHOLDER KOSONG --}}
        <div class="hero-slide-inner position-relative overflow-hidden"
             style="min-height: 680px; background: #1a1a2e;">
            <div class="hero-bg-overlay position-absolute top-0 start-0 w-100 h-100 z-0"></div>
            <div class="container-fluid position-relative z-2">
                <div class="row align-items-center" style="min-height: 680px;">
                    <div class="col-lg-7">
                        <div class="hero-content p-5">
                            <h6 class="section-subtitle style-two bg_secondary fs-13 fw-semibold ls-1 d-inline-flex align-items-center gap-2 round-oval mb-20">
                                <img src="assets/marketing/img/icons/lock.svg" alt="Icon">
                                KONTEN SLIDER MASIH KOSONG
                            </h6>
                            <h1 class="font-secondary fw-medium text-white">
                                Tambahkan <span class="text_primary fw-bold">Slide Hero</span> Via Dashboard Admin
                            </h1>
                            <p class="text-white fst-italic" style="opacity:.6;">
                                Belum ada data hero slider. Silakan tambahkan melalui panel manajemen konten.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
<!-- HERO SLIDER SECTION END -->


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
     BLOG SECTION START
     ============================================= -->
<div class="pt-130 pb-100 blog-slider-section overflow-hidden">
    <div class="container style-one">

        {{-- Header row: judul kiri, nav kanan --}}
        <div class="row align-items-end mb-40">
            <div class="col-lg-7 col-md-8">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15" data-cue="slideInUp">
                    <img src="assets/marketing/img/icons/lock.svg" alt="Icon">
                    {{ $blogSection['subtitle'] ?? 'BLOG & NEWS' }}
                </span>
                <h2 class="section-title style-one fw-medium text-title mb-0" data-cue="slideInUp" data-delay="200">
                    {{ $blogSection['title'] ?? 'Expert Tips And Trends In Cloud Security' }}
                </h2>
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
                                <img src="{{ $post['image'] }}"
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
                                    <p class="mt-1 fst-italic small">Konten artikel masih kosong</p>
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
                            <h3 class="fs-20 fw-semibold text-muted fst-italic">Artikel belum ditambahkan</h3>
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
    <div class="d-flex flex-column justify-between align-items-center mt-5 gap-4">
        <div class="d-flex align-items-center justify-content-md-end gap-3 mt-md-0 mt-20 w-25" data-cue="slideInUp" data-delay="300">
            {{-- Prev / Next --}}
            <button class="blog-slider-prev border-0 d-flex align-items-center justify-content-center rounded-circle transition flex-shrink-0">
                <img src="assets/marketing/img/icons/left-arrow-black.svg" alt="Prev">
            </button>
            <div class="blog-slider-pagination"></div>
            <button class="blog-slider-next border-0 d-flex align-items-center justify-content-center rounded-circle transition flex-shrink-0">
                <img src="assets/marketing/img/icons/right-arrow-black.svg" alt="Next">
            </button>
        </div>
        @if(!empty($blogSection['see_all_url']))
        <div class="container style-one">
            <div class="text-center mt-30">
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
                                <img src="{{ $item['image'] }}"
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
                                <p class="mt-1 fst-italic small">Galeri masih kosong</p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="text-center mt-30">
                <p class="text-muted fst-italic">Belum ada item galeri yang ditambahkan. Tambahkan melalui panel admin.</p>
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
    .gallery-item:hover .gallery-overlay {
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

    // ── Blog Slider ──────────────────────────────
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
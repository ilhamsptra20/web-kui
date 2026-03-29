@extends('layouts.marketing')

@section('content')

{{--
    ============================================================
    VARIABEL DARI ArticleController@index :
    ============================================================

    $breadcrumb = [
        'title' => 'Blog',
        'menus' => [
            ['label' => 'HOME', 'url' => '/'],
            ['label' => 'BLOG', 'url' => null],  // null = active (tanpa link)
        ],
    ];

    $categories  = [ ['label', 'url', 'count'], ... ]
    $recentPosts = [ ['thumb', 'date', 'date_url', 'title', 'url'], ... ]
    $tags        = [ ['label', 'url'], ... ]

    $posts = [
        [
            'image', 'category', 'category_url',
            'author', 'author_url',
            'date', 'date_url',
            'title', 'url',
        ],
        ...
    ];

    $pagination = [
        'current'  => 1,
        'total'    => 3,
        'prev_url' => null | '/blog?page=0',
        'next_url' => '/blog?page=2',
        'pages'    => [ ['number', 'url', 'active'], ... ],
    ];
    ============================================================
--}}

<!-- =============================================
     BREADCRUMB START
     ============================================= -->
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">

        {{-- Menu breadcrumb --}}
        @if(!empty($breadcrumb['menus']))
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            @foreach($breadcrumb['menus'] as $menu)
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                @if(!empty($menu['url']))
                    <a href="{{ $menu['url'] }}">{{ $menu['label'] }}</a>
                @else
                    {{ $menu['label'] }}
                @endif
            </li>
            @endforeach
        </ul>
        @endif

        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-6">
            {{ $breadcrumb['title'] ?? 'Blog' }}
        </h2>

    </div>
</div>
<!-- BREADCRUMB END -->

<!-- =============================================
     BLOG LIST SECTION START
     ============================================= -->
<div class="container style-one ptb-130">
    <div class="row">

        <!-- ── SIDEBAR (kanan di XL, bawah di mobile) ── -->
        <div class="col-xl-4 ps-xxl-5 order-xl-2 order-2">
            <aside class="sidebar mt-lg-50">

                {{-- Search --}}
                <form action="/blog/search" method="GET"
                      class="search-widget position-relative mb-30">
                    <input type="search" name="q"
                           value="{{ request('q') }}"
                           placeholder="Search articles..."
                           class="fw-medium w-100 ht-56 bg_primary border-0 round-5 text-white outline-0">
                    <button type="submit"
                            class="position-absolute bg-transparent top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center border-0">
                        <img src="assets/marketing/img/icons/search-white.svg" alt="Search">
                    </button>
                </form>

                {{-- Categories --}}
                <div class="sidebar-widget category-widget round-5">
                    <h3 class="sidebar-widget-title fs-18 fw-semibold text-black mb-20">Categories</h3>
                    @if(!empty($categories))
                    <ul class="list-unstyled mb-0">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ $cat['url'] ?? '#' }}" class="position-relative">
                                {{ $cat['label'] ?? 'Uncategorized' }}
                                @if(!empty($cat['count']))
                                    <span class="text-muted fs-13">({{ $cat['count'] }})</span>
                                @endif
                                <img src="assets/marketing/img/icons/right-arrow-blue.svg" alt="Icon">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-muted fst-italic small">Belum ada kategori.</p>
                    @endif
                </div>

                {{-- Recent Posts --}}
                <div class="sidebar-widget round-5">
                    <h3 class="sidebar-widget-title fs-18 fw-semibold text-black mb-20">Recent Posts</h3>
                    @if(!empty($recentPosts))
                    <div class="rp-post-wrap">
                        @foreach($recentPosts as $rp)
                        <div class="rp-post-card d-flex flex-wrap align-items-center">
                            <div class="rp-post-img">
                                @if(!empty($rp['thumb']))
                                    <img src="{{ $rp['thumb'] }}" alt="Post Thumb"
                                         style="width:80px; height:70px; object-fit:cover; border-radius:6px;">
                                @else
                                    <div style="width:80px;height:70px;background:#eee;border-radius:6px;
                                                display:flex;align-items:center;justify-content:center;">
                                        <i class="ri-image-line text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="rp-post-info">
                                <a href="{{ $rp['date_url'] ?? '#' }}"
                                   class="fs-15 fw-medium text_primary hover-text-title d-block mb-1">
                                    {{ $rp['date'] ?? '-' }}
                                </a>
                                <h5 class="fs-15 fw-semibold mb-0 pe-xxl-4">
                                    <a href="{{ $rp['url'] ?? '#' }}"
                                       class="text-black link-hover-primary transition">
                                        {{ $rp['title'] ?? 'Judul belum ada' }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted fst-italic small">Belum ada artikel terbaru.</p>
                    @endif
                </div>

                {{-- Tags --}}
                <div class="sidebar-widget tags-widget round-5">
                    <h3 class="sidebar-widget-title fs-18 fw-semibold text-title mb-22">Tags</h3>
                    @if(!empty($tags))
                    <ul class="list-unstyled mb-0">
                        @foreach($tags as $tag)
                        <li>
                            <a href="{{ $tag['url'] ?? '#' }}">{{ $tag['label'] ?? '-' }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-muted fst-italic small">Belum ada tag.</p>
                    @endif
                </div>

            </aside>
        </div>
        <!-- ── END SIDEBAR ── -->

        <!-- ── MAIN POSTS ── -->
        <div class="col-xl-8 order-xl-1 order-1">

            @if($posts->isNotEmpty())
            <div class="row justify-content-center">
                @foreach($posts as $index => $post)
                <div class="col-md-6" data-cue="slideInUp" data-delay="{{ ($index % 2) * 100 }}">
                    <div class="blog-card style-one img-hover-wrap round-10 mb-30">

                        {{-- Thumbnail --}}
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            @if(!empty($post['image']))
                                <img src="{{ $post['image'] }}"
                                     alt="{{ $post['title'] ?? 'Blog Image' }}"
                                     class="transition round-10"
                                     style="width:100%; height:230px; object-fit:cover;">
                            @else
                                <div class="round-10 bg-light d-flex align-items-center justify-content-center"
                                     style="height:230px; border: 2px dashed #ccc;">
                                    <div class="text-center text-muted p-3">
                                        <i class="ri-image-line" style="font-size:2rem;"></i>
                                        <p class="mt-1 fst-italic small">Gambar belum ada</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">

                                {{-- Category badge --}}
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

                                {{-- Meta --}}
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By
                                        <a href="{{ $post['author_url'] ?? '#' }}">
                                            {{ $post['author'] ?? 'Admin' }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $post['date_url'] ?? '#' }}">
                                            {{ $post['date'] ?? '-' }}
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            {{-- Judul --}}
                            <h3 class="fs-20 fw-semibold">
                                <a href="{{ $post['url'] ?? '#' }}"
                                   class="text-black link-hover-primary transition">
                                    {{ $post['title'] ?? 'Judul artikel masih kosong.' }}
                                </a>
                            </h3>

                            <a href="{{ $post['url'] ?? '#' }}" class="link style-two fw-semibold">
                                Read More<i class="ri-arrow-right-line"></i>
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            @else
            {{-- Empty state --}}
            <div class="text-center py-5">
                <i class="ri-article-line" style="font-size:4rem; color:#ccc;"></i>
                <h4 class="mt-3 text-muted fw-medium">Belum Ada Artikel</h4>
                <p class="text-muted fst-italic">Artikel akan muncul di sini setelah ditambahkan melalui panel admin.</p>
            </div>
            @endif

            <!-- ── PAGINATION ── -->
            @if($posts->hasPages())
            <div class="pagination-area d-flex align-items-center justify-content-center mt-xl-5"
                 data-cue="slideInUp">

                {{-- Prev --}}
                @if($posts->onFirstPage())
                    <span class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle"
                          style="opacity:.35; cursor:not-allowed;">
                        <img src="assets/marketing/img/icons/left-arrow-blue.svg" alt="Prev">
                    </span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}"
                       class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle">
                        <img src="assets/marketing/img/icons/left-arrow-blue.svg" alt="Prev">
                    </a>
                @endif

                {{-- Nomor halaman --}}
                @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                    @if($page == $posts->currentPage())
                        <span class="page-numbers current d-flex flex-column align-items-center justify-content-center rounded-circle"
                              aria-current="page">
                            {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle">
                            {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                        </a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}"
                       class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle">
                        <img src="assets/marketing/img/icons/right-arrow-blue-2.svg" alt="Next">
                    </a>
                @else
                    <span class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle"
                          style="opacity:.35; cursor:not-allowed;">
                        <img src="assets/marketing/img/icons/right-arrow-blue-2.svg" alt="Next">
                    </span>
                @endif

            </div>
            @endif
            <!-- ── END PAGINATION ── -->

        </div>
        <!-- ── END MAIN POSTS ── -->

    </div>
</div>
<!-- BLOG LIST SECTION END -->

@endsection
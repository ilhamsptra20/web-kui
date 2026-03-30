@extends('layouts.marketing')

@section('content')

<!-- =============================================
     BREADCRUMB START
     ============================================= -->
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">

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
            {{ $breadcrumb['title'] ?? 'Blog Single' }}
        </h2>
    </div>
</div>
<!-- BREADCRUMB END -->

<!-- =============================================
     ARTIKEL DETAIL START
     ============================================= -->
<div class="container style-one ptb-130">
    <div class="row">
        <div class="col-xl-8 offset-xl-2">

            <!-- ── HEADER ARTIKEL ── -->
            <div class="blog-desc mb-55">
                <ul class="blog-metainfo list-unstyled mb-20">

                    {{-- Category --}}
                    @if(!empty($article['category']))
                    <li class="blog-category">
                        <a href="{{ $article['category_url'] ?? '#' }}"
                           class="fs-15 text-white bg_primary round-oval">
                            {{ $article['category'] }}
                        </a>
                    </li>
                    @endif

                    {{-- Author --}}
                    <li>By
                        <a href="{{ $article['author_url'] ?? '#' }}">
                            {{ $article['author'] ?? 'Admin' }}
                        </a>
                    </li>

                    {{-- Date --}}
                    <li>
                        <a href="{{ $article['date_url'] ?? '#' }}">
                            {{ $article['date'] ?? '-' }}
                        </a>
                    </li>
                </ul>

                {{-- Judul --}}
                <h1 class="font-secondary fw-medium pb-3">
                    {{ $article['title'] ?? 'Judul artikel belum diisi' }}
                </h1>

                {{-- Hero Image --}}
                @if(!empty($article['hero_image']))
                <div class="single-img round-10 mb-30">
                    <img src="{{ asset("storage/".$article['hero_image']) }}"
                         alt="{{ $article['title'] ?? 'Article Image' }}"
                         class="round-10 w-100"
                         style="max-height: 480px; object-fit: cover;">
                </div>
                @endif

                <!-- ── CONTENT BLOCKS ── -->
                @if(!empty($article['content']))
                    {{ $article['content'] }}
                @else
                    <p class="text-muted fst-italic">Konten artikel masih kosong.</p>
                @endif
                <!-- ── END CONTENT BLOCKS ── -->

            </div>
            <!-- ── END HEADER ARTIKEL ── -->

            <!-- ── PREV / NEXT ── -->
            <div class="post-pagination d-flex flex-wrap align-items-center justify-content-between mb-50">
                @if(!empty($article['prev']))
                    <a href="{{ $article['prev']['url'] ?? '#' }}"
                       class="prev-post fs-xxl-18 fs-xx-14 fw-medium text-title hover-text-primary transition w-50">
                        <i class="ri-arrow-left-line"></i>{{ $article['prev']['label'] ?? 'Prev Article' }}
                    </a>
                @else
                    <span class="w-50"></span>
                @endif

                @if(!empty($article['next']))
                    <a href="{{ $article['next']['url'] ?? '#' }}"
                       class="next-post fs-xxl-18 fs-xx-14 fw-medium text-title hover-text-primary transition w-50 text-end">
                        {{ $article['next']['label'] ?? 'Next Article' }}<i class="ri-arrow-right-line"></i>
                    </a>
                @endif
            </div>

            <!-- ── TAGS & SHARE ── -->
            <div class="post-metaoption round-5 mb-50">
                <div class="row align-items-center">

                    {{-- Tags --}}
                    <div class="col-md-6">
                        <div class="post-tags d-flex flex-wrap align-items-center mb-sm-10">
                            <span class="fw-medium text-title me-2">Tags:</span>
                            @if(!empty($article['tags']))
                            <ul class="list-unstyled mb-0">
                                @foreach($article['tags'] as $i => $tag)
                                <li class="d-inline-block me-1">
                                    <a href="{{ $tag['url'] ?? '#' }}"
                                       class="text-para hover-text-primary transition">
                                        {{ $tag['label'] }}
                                    </a>@if(!$loop->last),@endif
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <span class="text-muted fst-italic small">Tidak ada tag.</span>
                            @endif
                        </div>
                    </div>

                    {{-- Share --}}
                    <div class="col-md-6">
                        <div class="post-share d-flex flex-wrap align-items-center justify-content-md-end">
                            <span class="fw-medium text-title me-2">Share:</span>
                            @if(!empty($article['share']))
                            <ul class="social-profile style-three list-unstyled mb-0">
                                @foreach($article['share'] as $social)
                                @php
                                    // Ganti {url} dengan URL artikel saat ini
                                    $shareUrl = str_replace('{url}', urlencode(url()->current()), $social['url']);
                                @endphp
                                <li>
                                    <a href="{{ $shareUrl }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       title="{{ $social['label'] ?? '' }}"
                                       class="d-flex flex-column align-items-center justify-content-center rounded-circle">
                                        <i class="{{ $social['icon'] }}"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- ── KOMENTAR ── -->
            @if(!empty($comments) && count($comments) > 0)
            <div class="comment-item-wrap mb-55">

                @foreach($comments as $comment)

                {{-- Komentar utama --}}
                <div class="comment-item d-flex flex-wrap">
                    <div class="comment-author-img round-5">
                        @if(!empty($comment['avatar']))
                            <img src="{{ $comment['avatar'] }}" alt="{{ $comment['name'] ?? 'Avatar' }}"
                                 class="round-5" style="width:60px; height:60px; object-fit:cover;">
                        @else
                            <div class="round-5 bg-light d-flex align-items-center justify-content-center"
                                 style="width:60px; height:60px;">
                                <i class="ri-user-line text-muted fs-20"></i>
                            </div>
                        @endif
                    </div>
                    <div class="comment-author-info">
                        <h5 class="fs-16 fw-semibold font-primary text-title mb-12">
                            {{ $comment['name'] ?? 'Anonymous' }}
                            <span class="comment-date fw-medium text-para">{{ $comment['date'] ?? '' }}</span>
                        </h5>
                        <p class="comment-text">{{ $comment['text'] ?? '' }}</p>
                        <a href="#cmt-form" class="reply-btn text_primary link-hover-primary fw-medium">Reply</a>
                    </div>
                </div>

                {{-- Replies --}}
                @if(!empty($comment['replies']))
                    @foreach($comment['replies'] as $reply)
                    <div class="comment-item d-flex flex-wrap reply">
                        <div class="comment-author-img round-5">
                            @if(!empty($reply['avatar']))
                                <img src="{{ $reply['avatar'] }}" alt="{{ $reply['name'] ?? 'Avatar' }}"
                                     class="round-5" style="width:60px; height:60px; object-fit:cover;">
                            @else
                                <div class="round-5 bg-light d-flex align-items-center justify-content-center"
                                     style="width:60px; height:60px;">
                                    <i class="ri-user-line text-muted fs-20"></i>
                                </div>
                            @endif
                        </div>
                        <div class="comment-author-info">
                            <h5 class="fs-16 fw-semibold font-primary text-title mb-12">
                                {{ $reply['name'] ?? 'Anonymous' }}
                                <span class="comment-date fw-medium text-para">{{ $reply['date'] ?? '' }}</span>
                            </h5>
                            <p class="comment-text">{{ $reply['text'] ?? '' }}</p>
                            <a href="#cmt-form" class="reply-btn text_primary link-hover-primary fw-medium">Reply</a>
                        </div>
                    </div>
                    @endforeach
                @endif

                @endforeach

            </div>
            @endif
            <!-- ── END KOMENTAR ── -->

            <!-- ── FORM KOMENTAR ── -->
            <div class="comment-form-box round-10" id="cmt-form">
                <form action=""
                      method="POST"
                      class="comment-form style-one round-10">
                    @csrf
                    <div class="row gx-xl-3">

                        <div class="col-12">
                            <h3 class="fs-20 fw-semibold mb-18">Add A Comment</h3>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group position-relative mb-20">
                                <input type="text" name="name" required
                                       value="{{ old('name') }}"
                                       class="w-100 ht-52 round-5 bg-white text-para border-0"
                                       placeholder="Name">
                                @error('name')
                                    <span class="text-danger fs-13">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-20">
                                <input type="email" name="email" required
                                       value="{{ old('email') }}"
                                       class="w-100 ht-52 round-5 bg-white text-para border-0"
                                       placeholder="Email">
                                @error('email')
                                    <span class="text-danger fs-13">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-20">
                                <textarea name="comment" id="comment" cols="30" rows="10"
                                          required
                                          placeholder="Write your comment..."
                                          class="w-100 round-20 bg-white text-para border-0 resize-0">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <span class="text-danger fs-13">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check checkbox style-two mb-25">
                                <input class="form-check-input" type="checkbox"
                                       name="save_info" id="save_info"
                                       {{ old('save_info') ? 'checked' : '' }}>
                                <label class="form-check-label" for="save_info">
                                    Save my name, email, and website in this browser for the next time I comment.
                                </label>
                            </div>
                            <div class="col-xl-5 col-md-6">
                                <button class="btn style-three fw-semibold position-relative round-oval"
                                        type="submit">
                                    Post A Comment
                                    <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                                    </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- ── END FORM KOMENTAR ── -->

            <!-- ── RELATED POSTS ── -->
            @if(!empty($relatedPosts) && count($relatedPosts) > 0)
            <div class="related-posts mt-80">
                <h3 class="fs-24 fw-semibold mb-30">Related Articles</h3>
                <div class="row">
                    @foreach($relatedPosts as $index => $related)
                    <div class="col-md-4" data-cue="slideInUp" data-delay="{{ $index * 100 }}">
                        <div class="blog-card style-one img-hover-wrap round-10 mb-30">
                            <div class="blog-img position-relative img-hover overflow-hidden round-10">
                                @if(!empty($related['image']))
                                    <img src="{{ asset("storage/".$related['image']) }}"
                                         alt="{{ $related['title'] ?? 'Related' }}"
                                         class="transition round-10"
                                         style="width:100%; height:180px; object-fit:cover;">
                                @else
                                    <div class="round-10 bg-light d-flex align-items-center justify-content-center"
                                         style="height:180px; border:2px dashed #ccc;">
                                        <i class="ri-image-line text-muted fs-24"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="blog-info">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    @if(!empty($related['category']))
                                    <a class="blog-category fs-15 fw-medium d-inline-block round-oval"
                                       href="{{ $related['category_url'] ?? '#' }}">
                                        {{ $related['category'] }}
                                    </a>
                                    @endif
                                    <ul class="blog-metainfo list-unstyled">
                                        <li>By <a href="{{ $related['author_url'] ?? '#' }}">{{ $related['author'] ?? 'Admin' }}</a></li>
                                        <li><a href="{{ $related['date_url'] ?? '#' }}">{{ $related['date'] ?? '-' }}</a></li>
                                    </ul>
                                </div>
                                <h3 class="fs-18 fw-semibold">
                                    <a href="{{ $related['url'] ?? '#' }}"
                                       class="text-black link-hover-primary transition">
                                        {{ $related['title'] ?? 'Judul belum ada' }}
                                    </a>
                                </h3>
                                <a href="{{ $related['url'] ?? '#' }}" class="link style-two fw-semibold">
                                    Read More<i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            <!-- ── END RELATED POSTS ── -->

        </div>
    </div>
</div>
<!-- ARTIKEL DETAIL END -->

@endsection
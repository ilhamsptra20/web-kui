@extends('layouts.marketing')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block"><a href="index.html">HOME</a></li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">BLOG</li>
        </ul>
        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-6">Blog</h2>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Section Start -->
<div class="container style-one ptb-130">
    <div class="row">
            <div class="col-xl-4 ps-xxl-5 order-xl-1 order-2">
            <aside class="sidebar mt-lg-50">
                <form action="#" class="search-widget position-relative mb-30">
                    <input type="search" placeholder="Search" class="fw-medium w-100 ht-56 bg_primary border-0 round-5 text-white outline-0">
                    <button class="position-absolute bg-transparent position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center border-0"><img src="assets/marketing/img/icons/search-white.svg" alt="Icon"></button>
                </form>
                <div class="sidebar-widget category-widget round-5">
                    <h3 class="sidebar-widget-title fs-18 fw-semibold text-black mb-20">Categories</h3>
                    <ul class="list-unstyled mb-0">
                        <li><a href="posts-by-category.html" class="position-relative">News <img src="assets/marketing/img/icons/right-arrow-blue.svg" alt="Icon"></a></li>
                        <li><a href="posts-by-category.html" class="position-relative">Robotics <img src="assets/marketing/img/icons/right-arrow-blue.svg" alt="Icon"></a></li>
                        <li><a href="posts-by-category.html" class="position-relative">Machine Learning <img src="assets/marketing/img/icons/right-arrow-blue.svg" alt="Icon"></a></li>
                        <li><a href="posts-by-category.html" class="position-relative">Agriculture <img src="assets/marketing/img/icons/right-arrow-blue.svg" alt="Icon"></a></li>
                        <li><a href="posts-by-category.html" class="position-relative">Real Time Prediction <img src="assets/marketing/img/icons/right-arrow-blue.svg" alt="Icon"></a></li>
                        <li><a href="posts-by-category.html" class="position-relative">Module Evolution <img src="assets/marketing/img/icons/right-arrow-blue.svg" alt="Icon"></a></li>
                    </ul>
                </div>
                <div class="sidebar-widget round-5">
                    <h3 class="sidebar-widget-title fs-18 fw-semibold text-black mb-20">Recent Posts</h3>
                        <div class="rp-post-wrap">
                        <div class="rp-post-card d-flex flex-wrap align-items-center">
                            <div class="rp-post-img">
                                <img src="assets/marketing/img/blog/post-thumb-1.jpg" alt="Post Thumb">
                            </div>
                            <div class="rp-post-info">
                                <a href="posts-by-date.html" class="fs-15 fw-medium text_primary   hover-text-title d-block mb-1">19 Aug, 2025</a>
                                <h5 class="fs-15 fw-semibold mb-0 pe-xxl-4"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">How Predictive AI Is Transforming Decision-Making In Business</a></h5>
                            </div>
                        </div>
                        <div class="rp-post-card d-flex flex-wrap align-items-center">
                            <div class="rp-post-img">
                                <img src="assets/marketing/img/blog/post-thumb-2.jpg" alt="Post Thumb">
                            </div>
                            <div class="rp-post-info">
                                <a href="posts-by-date.html" class="fs-15 fw-medium text_primary   hover-text-title d-block mb-1">16 Aug, 2025</a>
                                <h5 class="fs-15 fw-semibold mb-0 pe-xxl-4"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">Building Trust In AI: Transparency, Accuracy & Accountability</a></h5>
                            </div>
                        </div>
                        <div class="rp-post-card d-flex flex-wrap align-items-center">
                            <div class="rp-post-img">
                                <img src="assets/marketing/img/blog/post-thumb-3.jpg" alt="Post Thumb">
                            </div>
                            <div class="rp-post-info">
                                <a href="posts-by-date.html" class="fs-15 fw-medium text_primary   hover-text-title d-block mb-1">22 Aug, 2025</a>
                                <h5 class="fs-15 fw-semibold mb-0 pe-xxl-5"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">From Data To Action: The Power Of Machine Learning</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-widget tags-widget round-5">
                    <h3 class="sidebar-widget-title fs-18 fw-semibold text-title mb-22">Tags</h3>
                    <ul class="list-unstyled mb-0">
                        <li><a href="posts-by-tag.html">AI News</a></li>
                        <li><a href="posts-by-tag.html">Analysis</a></li>
                        <li><a href="posts-by-tag.html">ChatGPT</a></li>
                        <li><a href="posts-by-tag.html">Neural</a></li>
                        <li><a href="posts-by-tag.html">AI Model</a></li>
                        <li><a href="posts-by-tag.html">Marketing</a></li>
                    </ul>
                </div>
            </aside>
        </div>
        <div class="col-xl-8 order-xl-2 order-1">
            <div class="row justify-content-center">
                <div class="col-md-6" data-cue="slideInUp">
                    <div class="blog-card style-one img-hover-wrap round-10 mb-30">
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            <img src="assets/marketing/img/blog/blog-10.jpg" alt="Image" class="transition round-10">
                        </div>
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <a class="blog-category fs-15 fw-medium d-inline-block round-oval" href="blog-left-sidebar.html">Startup</a>
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By <a href="posts-by-author.html">Admin</a></li>
                                    <li><a href="posts-by-date.html">12 Aug, 2025</a></li>
                                </ul>
                            </div>
                            <h3 class="fs-20 fw-semibold"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">How AI Automation Is Reshaping The Future Of Business Operations</a></h3>
                            <a href="blog-single-right-sidebar.html" class="link style-two fw-semibold">Read More<i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-cue="slideInUp">
                    <div class="blog-card style-one img-hover-wrap round-10 mb-30">
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            <img src="assets/marketing/img/blog/blog-2.jpg" alt="Image" class="transition round-10">
                        </div>
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <a class="blog-category fs-15 fw-medium d-inline-block round-oval" href="blog-left-sidebar.html">Technology</a>
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By <a href="posts-by-author.html">Admin</a></li>
                                    <li><a href="posts-by-date.html">16 Aug, 2025</a></li>
                                </ul>
                            </div>
                            <h3 class="fs-20 fw-semibold"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">Top 7 Ways SaaS Companies Benefit From Predictive Analytics</a></h3>
                            <a href="blog-single-right-sidebar.html" class="link style-two fw-semibold">Read More<i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-cue="slideInUp">
                    <div class="blog-card style-one img-hover-wrap round-10 mb-30">
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            <img src="assets/marketing/img/blog/blog-11.jpg" alt="Image" class="transition round-10">
                        </div>
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <a class="blog-category fs-15 fw-medium d-inline-block round-oval" href="blog-left-sidebar.html">Agency</a>
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By <a href="posts-by-author.html">Admin</a></li>
                                    <li><a href="posts-by-date.html">22 Aug, 2025</a></li>
                                </ul>
                            </div>
                            <h3 class="fs-20 fw-semibold"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">Scaling Smarter: How Startups Use AI To Accelerate Business Growth</a></h3>
                        <a href="blog-single-right-sidebar.html" class="link style-two fw-semibold">Read More<i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-cue="slideInUp">
                    <div class="blog-card style-one img-hover-wrap round-10 mb-30">
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            <img src="assets/marketing/img/blog/blog-12.jpg" alt="Image" class="transition round-10">
                        </div>
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <a class="blog-category fs-15 fw-medium d-inline-block round-oval" href="blog-left-sidebar.html">Robotics</a>
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By <a href="posts-by-author.html">Admin</a></li>
                                    <li><a href="posts-by-date.html">26 Aug, 2025</a></li>
                                </ul>
                            </div>
                            <h3 class="fs-20 fw-semibold"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">How Predictive AI Is Transforming Decision-Making In Business</a></h3>
                        <a href="blog-single-right-sidebar.html" class="link style-two fw-semibold">Read More<i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-cue="slideInUp">
                    <div class="blog-card style-one img-hover-wrap round-10 mb-30">
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            <img src="assets/marketing/img/blog/blog-13.jpg" alt="Image" class="transition round-10">
                        </div>
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <a class="blog-category fs-15 fw-medium d-inline-block round-oval" href="blog-left-sidebar.html">Agency</a>
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By <a href="posts-by-author.html">Admin</a></li>
                                    <li><a href="posts-by-date.html">27 Aug, 2025</a></li>
                                </ul>
                            </div>
                            <h3 class="fs-20 fw-semibold"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">Building Trust In AI: Transparency, Accuracy, And Accountability</a></h3>
                        <a href="blog-single-right-sidebar.html" class="link style-two fw-semibold">Read More<i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-cue="slideInUp">
                    <div class="blog-card style-one img-hover-wrap round-10 mb-30">
                        <div class="blog-img position-relative img-hover overflow-hidden round-10">
                            <img src="assets/marketing/img/blog/blog-14.jpg" alt="Image" class="transition round-10">
                        </div>
                        <div class="blog-info">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <a class="blog-category fs-15 fw-medium d-inline-block round-oval" href="blog-left-sidebar.html">Technology</a>
                                <ul class="blog-metainfo list-unstyled">
                                    <li>By <a href="posts-by-author.html">Admin</a></li>
                                    <li><a href="posts-by-date.html">28 Aug, 2025</a></li>
                                </ul>
                            </div>
                            <h3 class="fs-20 fw-semibold"><a href="blog-single-right-sidebar.html" class="text-black link-hover-primary transition">From Data To Action: The Power Of Machine Learning In Forecasting</a></h3>
                        <a href="blog-single-right-sidebar.html" class="link style-two fw-semibold">Read More<i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination-area d-flex align-items-center justify-content-center mt-xl-5">
                <span class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle" aria-current="page"><img src="assets/marketing/img/icons/left-arrow-blue.svg" alt="Icon"></span>
                <span class="page-numbers current d-flex flex-column align-items-center justify-content-center rounded-circle" aria-current="page">01</span>
                <a href="blog-right-sidebar.html" class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle">02</a>
                <a href="blog-right-sidebar.html" class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle">03</a>
                <a href="blog-right-sidebar.html" class="page-numbers d-flex flex-column align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/right-arrow-blue-2.svg" alt="Icon"></a>
            </div>
        </div>
    </div>
</div>
<!-- Blog Details Section End -->
@endsection
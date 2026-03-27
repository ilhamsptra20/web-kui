@extends('layouts.marketing')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block"><a href="index.html">HOME</a></li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">ABOUT US</li>
        </ul>
        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-6">About Us</h2>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- About us Section Start -->
<div class="about-area style-four overflow-hidden ptb-130">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-4 col-xl-5 col-lg-6">
                <div class="about-img-wrap position-relative mb-md-30">
                    <img src="assets/marketing/img/about/about-img-1.png" alt="Image" class="about-img position-absolute rotate">
                    <img src="assets/marketing/img/about/about-shape-3.png" alt="Shape" class="about-img-shape mx-auto d-block">
                </div>
            </div>
            <div class="col-xxl-7 col-xl-7 col-lg-6 ps-xl-4 pe-xxl-5">
                <div class="about-content position-relative">
                    <div class="about-promo-text style-one move-right sm-none"><img src="assets/marketing/img/about/thumbnail-2.png" alt="Image">Write a blog post </div>
                    <div class="about-promo-text style-two move-left sm-none"><img src="assets/marketing/img/about/thumbnail-3.png" alt="Image">Checklist task</div>
                    <span class="section-subtitle style-two d-inline-block text_primary fw-bold fs-14 ls-15 mb-12" data-cue="slideInUp">ABOUT US</span>
                    <h2 class="section-title style-four font-secondary fw-medium text-title">
                        Driven By Innovation, Powered By Intelligence — Discover How Aixio AI Is Transforming <span class="blur-text reveal-text">The Future Of Business</span>
                        <span class="thumb"><img src="assets/marketing/img/about/thumbnail-2.jpg" alt="Image"></span>
                        <span class="reveal-text blur-text d-block">Through Smarter, Scalable, And Secure Artificial Intelligence Solutions For Every Industry.</span> 
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About us Section End -->

<!-- Mission Section Start -->
<div class="container style-one pb-130">
    <div class="row">
        <div class="col-lg-5  mb-30">
            <div class="vision-tab bg-f round-10">
                <ul class="nav nav-tabs list-unstyled vision-tablist d-flex align-items-center justify-content-start w-100 mb-20" role="tablist">
                    <li class="nav-item border-0">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab_1" type="button" role="tab">Mission</button>
                    </li>
                    <li class="nav-item border-0">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab_2" type="button" role="tab">Vision</button>
                    </li>
                </ul>
                <div class="tab-content product-tab-content">
                    <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                        <div class="single-para mb-65">
                            <p>To empower industries with intelligent robotics and AI-driven automation that enhance efficiency, ensure safety and accelerate </p>
                            <p>innovation—transforming how businesses operate, scale and compete in a rapidly evolving world.</p>
                        </div>
                        <img src="assets/marketing/img/about/mission-thumb.png" alt="Image" class="d-block mx-auto">
                    </div>
                    <div class="tab-pane fade" id="tab_2" role="tabpanel">
                        <p>Innovation—transforming how businesses operate, scale and compete in a rapidly evolving world.</p>
                            <p>To empower industries with intelligent robotics and AI-driven automation that enhance efficiency, ensure safety and accelerate </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7  mb-30">
            <div class="mission-bg bg-f position-relative overflow-hidden z-1 round-10">
                <div class="exp-box">
                    <span class="font-secondary d-block text-white fw-semibold mb-20">50+</span>
                    <p class="text-offwhite fw-semibold mb-0">Successful Deployments</p>
                </div>
                <h4 class="fw-semibold text-white mb-0">Aixio is a pioneering AI agency delivering intelligent automation</h4>
            </div>
        </div>
    </div>
</div>
<!-- Mission Section End -->

<div class="move-text-wrapper overflow-hidden mb-120">
    <div class="move-text style-seven position-relative z-1">
        <ul class="list-unstyled mb-0">
            <li class="position-relative font-secondary fw-normal">AN AI-FIRST PLATFORM BUILT TO AUTOMATE, ANALYZE, AND ACCELERATE YOUR BUSINESS OPERATIONS </li>
            <li class="position-relative font-secondary fw-normal">AN AI-FIRST PLATFORM BUILT TO AUTOMATE, ANALYZE, AND ACCELERATE YOUR BUSINESS OPERATIONS </li>
            <li class="position-relative font-secondary fw-normal">AN AI-FIRST PLATFORM BUILT TO AUTOMATE, ANALYZE, AND ACCELERATE YOUR BUSINESS OPERATIONS </li>
        </ul>
    </div>
</div>

<!-- Why Choose Us Section Start -->
<div class="wh-area style-four bg_primary position-relative z-1 round-20 pb-100">
    <img src="assets/marketing/img/box-shape-2.png" alt="Shape" class="section-shape-one position-absolute bottom-0 start-0 z-n1">
    <img src="assets/marketing/img/box-shape-3.png" alt="Shape" class="section-shape-two position-absolute top-0 end-0 z-n1">
    <div class="container-fluid style-two">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-6 pe-xxl-5 ps-xxl-3">
                <div class="wh-bg bg-f bg-2 round-10"></div>
            </div>
            <div class="col-xl-5 col-lg-6 ps-xxl-5">
                <div class="wh-content mb-md-30">
                    <span class="section-subtitle d-inline-block text_secondary fw-bold fs-14 ls-15 mb-12" data-cue="slideInUp">WHY CHOOSE AIXIO</span>
                    <h2 class="section-title style-one font-secondary fw-medium text-white mb-15">Trusted By Enterprises For Scalable, Automated Cyber Defense</h2>
                    <p class="text-offwhite mb-30">We believe cybersecurity should be smart, seamless, and scalable Our AI-powered platform continuously analyzes data </p>
                    <ul class="feature-list d-flex flex-wrap list-unstyled mb-10 w-xxl-75">
                        <li class="position-relative fw-semibold text-white">
                            <span class="d-flex flex-column align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/shield-pink.svg" alt="Icon"></span>
                            Scalable Across Environments
                        </li>
                        <li class="position-relative fw-semibold text-white">
                            <span class="d-flex flex-column align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/compliance-pink.svg" alt="Icon"></span>
                            Built-In Compliance Support
                        </li>
                        <li class="position-relative fw-semibold text-white">
                            <span class="d-flex flex-column align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/folder-pink.svg" alt="Icon"></span>
                            Centralized Security Dashboard
                        </li>
                        <li class="position-relative fw-semibold text-white">
                            <span class="d-flex flex-column align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/encrypted.svg" alt="Icon"></span>
                            Behavior-Based Monitoring
                        </li>
                        <li class="position-relative fw-semibold text-white">
                            <span class="d-flex flex-column align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/lock-pink.svg" alt="Icon"></span>
                            Minimal Resource Footprint
                        </li>
                        <li class="position-relative fw-semibold text-white">
                            <span class="d-flex flex-column align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/sensor-pink.svg" alt="Icon"></span>
                            Autonomous Incident Response
                        </li>
                    </ul>
                    <a href="login.html" class="btn style-one text-white fw-semibold position-relative round-oval">Explore Our Security Advantage<span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center"><img src="assets/marketing/img/icons/right-arrow-black.svg" alt="Icon"></span></a>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- Why Choose Us Section End -->

<!-- Testimonial Start -->
<div class="testimonial-area style-four position-relative z-1 ptb-130">
    <div class="container style-one">
        <div class="row">
            <div class="col-lg-4">
                <div class="circle-text-wrap position-relative d-flex flex-column justify-content-center align-items-center rounded-circle me-auto">
                    <img src="assets/marketing/img/trusted-client-white.png" alt="Image" class="circle-text d-lock mx-auto rotate">
                    <img src="assets/marketing/img/icons/quote-pink.svg" alt="Icon" class="position-absolute">
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 ps-xxl-5 pe-xxl-0">
                <div class="testimonial-slider-two swiper ps-xxl-4">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-card style-two">
                                <p class="font-secondary fw-medium text-title">
                                    “We’ve used several cybersecurity 
                                    platforms, but none match Aixio’s AI precision and speed. Their automated response prevented a major data breach, and the compliance tools made our audits effortless.”
                                </p>
                                <div class="client-info-wrap d-flex flex-wrap align-items-center">
                                    <div class="client-img rounded-circle">
                                        <img src="assets/marketing/img/clients/client-1.jpg" alt="Image" class="rounded-circle">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="fs-20 fw-medium text-black mb-0">Michael Reyes</h5>
                                        <span>CISO, DataTrust Corp</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card style-two">
                                <p class="font-secondary fw-medium text-title">
                                    “Aixio’s AI precision and speed we’ve used several cybersecurity platforms, but none match . Their automated response prevented a major data breach, and the compliance tools made our audits effortless.”
                                </p>
                                <div class="client-info-wrap d-flex flex-wrap align-items-center">
                                    <div class="client-img rounded-circle">
                                        <img src="assets/marketing/img/clients/client-2.jpg" alt="Image" class="rounded-circle">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="fs-20 fw-medium text-black mb-0">Tony Conor</h5>
                                        <span>Entreprenuer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-card style-two">
                                <p class="font-secondary fw-medium text-title">
                                    “Awesome AI service from Aixio platforms, but none match Aixio’s AI precision and speed. Their automated response prevented a major data breach, and the compliance tools made our audits effortless.”
                                </p>
                                <div class="client-info-wrap d-flex flex-wrap align-items-center">
                                    <div class="client-img rounded-circle">
                                        <img src="assets/marketing/img/clients/client-3.jpg" alt="Image" class="rounded-circle">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="fs-20 fw-medium text-black mb-0">Andrew Higins</h5>
                                        <span>Founder & CEO, BIMST</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-btn d-flex flex-wrap align-items-ecnter">
                        <button class="prev-btn testimonial-prev border-0 d-flex flex-column align-items-center justify-content-center rounded-circle">
                            <img src="assets/marketing/img/icons/left-arrow-black.svg" alt="Image">
                        </button>
                        <div class="testimonial-pagination"></div>
                        <button class="next-btn testimonial-next border-0 d-flex flex-column align-items-center justify-content-center rounded-circle">
                            <img src="assets/marketing/img/icons/right-arrow-black.svg" alt="Image">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<!-- Data Security Section Start -->
<div class="data-section style-one pt-130 pb-100 round-20">
    <div class="container style-one">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-1 text-center">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15"><img src="assets/marketing/img/icons/lock.svg" alt="Icon">DATA SECURITY</span>
                <h2 class="section-title style-one font-secondary fw-medium mb-40">Secure Your Data With Zero Trust Architecture And Controls</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-30">
                <div class="data-card style-one bg-f d-flex flex-wrap flex-column text-center round-10">
                    <div class="data-logo rounded-circle"><img src="assets/marketing/img/about/ai-logo.png" alt="Image" class="rounded-circle"></div>
                    <h3 class="fs-24 fw-semibold mb-15">AI For Absolute Security</h3>
                    <p class="mb-0">Our platform uses advanced encryption protocols to ensure your sensitive</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="data-card-img bg-f round-10 mb-30"><img src="assets/marketing/img/about/ai-img-1.jpg" alt="Image" class="round-10"></div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="data-card style-two bg_primary round-10 mb-30">
                    <div class="data-card-header fs-30 font-secondary fw-semibold d-flex flex-wrap align-items-center mb-15">
                        <span class="data-icon d-flex flex-wrap align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/shield-white.svg" alt="Icon"></span>
                        <span class="data-header-text text-white">100%</span>
                    </div>
                    <h3 class="fs-20 fw-bold text-white mb-1">Security Guarantee</h3>
                    <p class="text-offwhite mb-0">AI Encryption keeps your data safe.</p>
                </div>
                <div class="data-card style-three bg-white round-10 mb-30">
                    <div class="data-card-header fs-30 font-secondary fw-semibold d-flex flex-wrap align-items-center mb-15">
                        <span class="data-icon d-flex flex-wrap align-items-center justify-content-center rounded-circle"><img src="assets/marketing/img/icons/shield-blue.svg" alt="Icon"></span>
                        <span class="data-header-text text-title">24/7</span>
                    </div>
                    <h3 class="fs-20 fw-bold text-title mb-1">Real- time monitoring</h3>
                    <p class="mb-0">Track activity and get security analytics 24/7</p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-30">
                <div class="data-card style-four position-relative z-1 bg-f d-flex flex-column align-items-center justify-content-end round-10 text-center">
                    <h3 class="fs-20 text-white mb-10">Military - Grade Encryption</h3>
                    <p class="text-offwhite mb-0">advanced encryption protocols to ensure your sensitive</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Data Security Section End -->

<!-- Brand Section Start -->
<div class="container style-two pt-130">
    <div class="brand-slider-one swiper">
        <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-1.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-2.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-3.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-4.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-5.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-6.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-7.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-8.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-1.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-3.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="brand-logo style-one">
                    <img src="assets/marketing/img/brand/brand-4.svg" alt="Logo" class="d-block mx-auto">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Section End -->

<!-- Team Section Start -->
<div class="container style-one pt-130">
        <div class="row">
        <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-1 text-center">
            <span class="section-subtitle style-two d-inline-block text_primary fw-bold fs-14 ls-15 mb-12">TEAM MEMBER</span>
            <h2 class="section-title style-one fw-medium text-center text-title mb-40 px-xxl-5">A Team Member In The Companys AI And Robotics Division</h2>
        </div>
    </div>
</div>
<div class="team-slider-wrap position-relative pb-130">
    <div class="container">
        <div class="team-slider-one swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="team-card style-one position-relative z-1 overflow-hidden text-center round-10">
                        <div class="team-member-bg bg-1 position-absolute top-0 start-0 w-100 h-100 transition"></div>
                        <div class="team-thumb rounded-circle mx-auto">
                            <img src="assets/marketing/img/team/team-thumb-1.jpg" alt="Image" class="rounded-circle transition">
                        </div>
                        <div class="team-info position-relative z-1">
                            <h3 class="fs-20 fw-semibold text-title transition">Elena Marlowe</h3>
                            <span class="fs-15 d-block transition">Chief Automation Strategist</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="team-card style-one position-relative z-1 overflow-hidden text-center round-10">
                        <div class="team-member-bg bg-2 position-absolute top-0 start-0 w-100 h-100 transition"></div>
                        <div class="team-thumb rounded-circle mx-auto">
                            <img src="assets/marketing/img/team/team-thumb-2.jpg" alt="Image" class="rounded-circle transition">
                        </div>
                        <div class="team-info position-relative z-1">
                            <h3 class="fs-20 fw-semibold text-title transition">Ravi Deshmukh</h3>
                            <span class="fs-15 d-block transition">Director of Operations</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="team-card style-one position-relative z-1 overflow-hidden text-center round-10">
                        <div class="team-member-bg bg-3 position-absolute top-0 start-0 w-100 h-100 transition"></div>
                        <div class="team-thumb rounded-circle mx-auto">
                            <img src="assets/marketing/img/team/team-thumb-3.jpg" alt="Image" class="rounded-circle transition">
                        </div>
                        <div class="team-info position-relative z-1">
                            <h3 class="fs-20 fw-semibold text-title transition">Sophia Zhang</h3>
                            <span class="fs-15 d-block transition">Robotics Integration Manager</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="team-card style-one position-relative z-1 overflow-hidden text-center round-10">
                        <div class="team-member-bg bg-4 position-absolute top-0 start-0 w-100 h-100 transition"></div>
                        <div class="team-thumb rounded-circle mx-auto">
                            <img src="assets/marketing/img/team/team-thumb-4.jpg" alt="Image" class="rounded-circle transition">
                        </div>
                        <div class="team-info position-relative z-1">
                            <h3 class="fs-20 fw-semibold text-title transition">Lucas Anders</h3>
                            <span class="fs-15 d-block transition">Senior AI Engineer</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="team-card style-one position-relative z-1 overflow-hidden text-center round-10">
                        <div class="team-member-bg bg-5 position-absolute top-0 start-0 w-100 h-100 transition"></div>
                        <div class="team-thumb rounded-circle mx-auto">
                            <img src="assets/marketing/img/team/team-thumb-5.jpg" alt="Image" class="rounded-circle transition">
                        </div>
                        <div class="team-info position-relative z-1">
                            <h3 class="fs-20 fw-semibold text-title transition">Luca Moretti</h3>
                            <span class="fs-15 d-block transition">LogicBay Systems</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="team-card style-one position-relative z-1 overflow-hidden text-center round-10">
                        <div class="team-member-bg bg-6 position-absolute top-0 start-0 w-100 h-100 transition"></div>
                        <div class="team-thumb rounded-circle mx-auto">
                            <img src="assets/marketing/img/team/team-thumb-6.jpg" alt="Image" class="rounded-circle transition">
                        </div>
                        <div class="team-info position-relative z-1">
                            <h3 class="fs-20 fw-semibold text-title transition">James Holdon</h3>
                            <span class="fs-15 d-block transition">Director of Machine</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="slider-btn">
        <button class="prev-btn team-prev bg-transparent border-0 d-flex flex-column align-items-center justify-content-center rounded-circle">
            <img src="assets/marketing/img/icons/left-arrow-large.svg" alt="Image">
        </button>
        <button class="next-btn team-next bg-transparent border-0 d-flex flex-column align-items-center justify-content-center rounded-circle">
            <img src="assets/marketing/img/icons/right-arrow-large.svg" alt="Image">
        </button>
    </div>
</div>
<!-- Team Section End -->

<!-- Feature Section Start -->
<div class="container style-one">
    <div class="row">
        <div class="col-xxl-6 col-lg-7 mb-md-30">
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-card style-three mb-45">
                        <img src="assets/marketing/img/features/automation.svg" alt="Icon" class="feature-icon">
                        <h3 class="fs-20 fw-semibold text-title">AI-Powered Automation</h3>
                        <p class="mb-0">Automate complex workflows with machine learning algorithms  optimize performance and decision</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-card style-three mb-45">
                        <img src="assets/marketing/img/features/system-integration.svg" alt="Icon" class="feature-icon">
                        <h3 class="fs-20 fw-semibold text-title">Seamless System Integration</h3>
                        <p class="mb-0">Our solutions integrate effortlessly with existing hardware, software, and infrastructure—minimizing </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-card style-three mb-30">
                        <img src="assets/marketing/img/features/analytics.svg" alt="Icon" class="feature-icon">
                        <h3 class="fs-20 fw-semibold text-title">Real-Time Monitoring & Analytics</h3>
                        <p class="mb-0">Track performance, detect anomalies, and predict failures through intuitive dashboards and smart data</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-card style-three mb-30">
                        <img src="assets/marketing/img/features/modular-design.svg" alt="Icon" class="feature-icon">
                        <h3 class="fs-20 fw-semibold text-title">Scalable & Modular Design</h3>
                        <p class="mb-0">Whether for a single machine or a full-scale operation, our modular systems scale with your business growth.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-5 offset-xxl-1 col-lg-5 ps-xxl-4 pe-xxl-0">
            <span class="section-subtitle style-three fs-14 fw-bold ls-15 d-inline-block text_primary mb-15">FEATURES</span>
            <h2 class="section-title style-one fw-medium text-title mb-20">User-Friendly Interfaces For Maximum Control And Flexibility</h2>
            <img src="assets/marketing/img/features/feature-6.png" alt="Image" class="feature-img d-block ms-auto">
        </div>
    </div>
</div>
<!-- Feature Section End -->
@endsection
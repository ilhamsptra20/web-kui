@extends('layouts.marketing')

@section('content')
@php
    $pageImage = $aboutPage['about_page_image'] ?? null;
    $values = $aboutPage['about_page_values'] ?? [];
    $programs = $aboutPage['about_page_programs'] ?? [];
@endphp

<div class="breadcrumb-area bg-f round-20 position-relative z-1 about-kui-breadcrumb">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ url('/') }}">HOME</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                {{ $aboutPage['about_page_subtitle'] ?? 'PROFILE KUI UNIDA' }}
            </li>
        </ul>
        <h1 class="section-title style-one fw-medium font-secondary text-black text-center mb-3">
            {{ $aboutPage['about_page_title'] ?? 'Profil KUI Unida' }}
        </h1>
        <p class="mx-auto about-page-lead text-para mb-0">
            {{ $aboutPage['about_page_lead'] ?? '' }}
        </p>
    </div>
</div>

<section class="pt-130 pb-100 position-relative z-1">
    <div class="container style-one">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <div class="about-kui-image-wrap position-relative overflow-hidden round-20">
                    @if($pageImage)
                        <img src="{{ $pageImage }}" alt="KUI Unida" class="w-100 about-kui-image">
                    @else
                        <div class="about-kui-image-placeholder d-flex align-items-center justify-content-center round-20">
                            <div class="text-center text-muted">
                                <i class="ri-image-line d-block mb-2"></i>
                                Gambar profil KUI belum diatur
                            </div>
                        </div>
                    @endif
                    <div class="about-kui-badge">
                        <span>KUI UNIDA</span>
                        <strong>International Office</strong>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15">
                    <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                    {{ $aboutPage['about_page_intro_title'] ?? 'Tentang KUI Unida' }}
                </span>
                <p class="about-kui-copy mb-30">
                    {{ $aboutPage['about_page_intro_description'] ?? '' }}
                </p>

                @if(!empty($values))
                    <h3 class="fs-22 fw-semibold text-title mb-20">
                        {{ $aboutPage['about_page_values_title'] ?? 'Nilai Utama' }}
                    </h3>
                    <div class="row g-3">
                        @foreach($values as $value)
                            <div class="col-md-6">
                                <div class="about-kui-value-card h-100">
                                    <span class="about-kui-value-icon"><i class="ri-check-line"></i></span>
                                    <p class="mb-0">{{ $value }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="pb-100">
    <div class="container style-one">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="about-kui-panel h-100">
                    <span class="about-kui-panel-icon bg_primary text-white">
                        <i class="ri-flag-line"></i>
                    </span>
                    <h2 class="fs-32 fw-semibold mb-15">{{ $aboutPage['about_page_mission_title'] ?? 'Misi' }}</h2>
                    <p class="mb-0">{{ $aboutPage['about_page_mission_description'] ?? '' }}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-kui-panel h-100 about-kui-panel-dark">
                    <span class="about-kui-panel-icon bg_secondary text-title">
                        <i class="ri-eye-line"></i>
                    </span>
                    <h2 class="fs-32 fw-semibold mb-15">{{ $aboutPage['about_page_vision_title'] ?? 'Visi' }}</h2>
                    <p class="mb-0">{{ $aboutPage['about_page_vision_description'] ?? '' }}</p>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            @foreach($aboutStats as $stat)
                <div class="col-lg-3 col-md-6">
                    <div class="about-kui-stat-card text-center h-100">
                        <h3 class="font-secondary fw-medium mb-2">
                            {{ $stat['value'] }}{{ $stat['suffix'] ?? '' }}
                        </h3>
                        <p class="mb-0">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="pb-100">
    <div class="container style-one">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15">
                    <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                    {{ $aboutPage['about_page_programs_title'] ?? 'Fokus Layanan' }}
                </span>
                <h2 class="section-title style-one font-secondary fw-medium mb-20">
                    Program Dan Layanan Internasional Untuk Sivitas Akademika Universitas Juanda
                </h2>
                <p class="mb-0 text-para">
                    KUI Unida mendukung pengembangan jejaring internasional, mobilitas akademik, dan tata kelola layanan global yang lebih terstruktur.
                </p>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    @foreach($programs as $program)
                        <div class="col-md-6">
                            <div class="about-kui-program-card h-100">
                                <div class="about-kui-program-icon">
                                    <i class="ri-global-line"></i>
                                </div>
                                <p class="mb-0">{{ $program }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@if($teamPreview->isNotEmpty())
    <section class="pb-100">
        <div class="container style-one">
            <div class="row align-items-end g-4 mb-40">
                <div class="col-lg-8">
                    <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15">
                        <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                        TIM KUI UNIDA
                    </span>
                    <h2 class="section-title style-one font-secondary fw-medium mb-15">
                        Tim Yang Menggerakkan Layanan Dan Kolaborasi Internasional Universitas Juanda
                    </h2>
                    <p class="mb-0 text-para">
                        Kenali anggota tim KUI Unida yang mendampingi komunikasi kelembagaan, mobilitas akademik, serta pengelolaan program internasional kampus.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('teams-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">
                        Lihat Semua Tim
                        <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                        </span>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                @foreach($teamPreview as $member)
                    <div class="col-lg-3 col-md-6">
                        <article class="about-kui-team-card h-100">
                            <div class="about-kui-team-card__media">
                                @if(!empty($member['image_url']))
                                    <img src="{{ $member['image_url'] }}" alt="{{ $member['name'] }}" class="about-kui-team-card__image">
                                @else
                                    <div class="about-kui-team-card__placeholder">
                                        <i class="ri-user-smile-line"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="about-kui-team-card__body">
                                @if(!empty($member['position']))
                                    <span class="about-kui-team-card__role">{{ $member['position'] }}</span>
                                @endif
                                <h3 class="about-kui-team-card__name">
                                    <a href="{{ route('team.show-marketing', $member['slug']) }}">{{ $member['name'] }}</a>
                                </h3>
                                <p class="about-kui-team-card__bio">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($member['bio'] ?: 'Profil tim KUI Unida akan tampil lengkap pada halaman detail.'), 110) }}
                                </p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if($partnerItems->isNotEmpty())
    <section class="pb-100">
        <div class="container style-one">
            <div class="about-kui-partner-wrap round-20">
                <div class="text-center mb-40">
                    <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15">
                        <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                        JEJARING MITRA
                    </span>
                    <h2 class="section-title style-one font-secondary fw-medium mb-0">
                        Kolaborasi Yang Mendukung Internasionalisasi Kampus
                    </h2>
                </div>

                <div class="row g-3 justify-content-center">
                    @foreach($partnerItems as $partner)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="about-kui-partner-card h-100 text-center">
                                @if(!empty($partner['logo_url']))
                                    <img src="{{ $partner['logo_url'] }}" alt="{{ $partner['name'] ?? 'Mitra' }}" class="about-kui-partner-logo">
                                @else
                                    <div class="about-kui-partner-logo about-kui-partner-logo-placeholder">
                                        <i class="ri-government-line"></i>
                                    </div>
                                @endif
                                <h3 class="fs-18 fw-semibold mt-3 mb-1">{{ $partner['name'] ?? 'Mitra KUI' }}</h3>
                                @if(!empty($partner['description']))
                                    <p class="mb-0 text-muted small">{{ \Illuminate\Support\Str::limit($partner['description'], 110) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

<section class="pb-130">
    <div class="container style-one">
        <div class="about-kui-cta round-20">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h2 class="section-title style-one font-secondary fw-medium text-white mb-15">
                        {{ $aboutPage['about_page_cta_title'] ?? 'Siap Berkolaborasi Dengan KUI Unida' }}
                    </h2>
                    <p class="mb-0 text-white opacity-75">
                        {{ $aboutPage['about_page_cta_description'] ?? '' }}
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ $aboutPage['about_page_cta_button_url'] ?? route('contact-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">
                        {{ $aboutPage['about_page_cta_button_text'] ?? 'Hubungi KUI' }}
                        <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .about-kui-breadcrumb {
        padding: 110px 0 80px;
    }

    .about-page-lead {
        max-width: 860px;
        font-size: 18px;
        line-height: 1.8;
    }

    .about-kui-image-wrap {
        min-height: 560px;
        background: linear-gradient(135deg, #121429 0%, #1f2351 100%);
        box-shadow: 0 35px 80px rgba(20, 24, 74, 0.16);
    }

    .about-kui-image {
        width: 100%;
        height: 560px;
        object-fit: cover;
        display: block;
    }

    .about-kui-image-placeholder {
        min-height: 560px;
        background: #f5f7fb;
        border: 2px dashed #d9dff0;
        color: #8690b0;
        font-size: 18px;
    }

    .about-kui-image-placeholder i {
        font-size: 44px;
    }

    .about-kui-badge {
        position: absolute;
        left: 24px;
        bottom: 24px;
        padding: 18px 22px;
        border-radius: 18px;
        background: rgba(13, 18, 43, 0.84);
        backdrop-filter: blur(12px);
        color: #fff;
    }

    .about-kui-badge span,
    .about-kui-badge strong {
        display: block;
    }

    .about-kui-badge span {
        font-size: 12px;
        letter-spacing: 2px;
        opacity: 0.7;
        margin-bottom: 4px;
    }

    .about-kui-badge strong {
        font-size: 20px;
        font-weight: 600;
    }

    .about-kui-copy {
        font-size: 17px;
        line-height: 1.9;
    }

    .about-kui-value-card,
    .about-kui-program-card,
    .about-kui-stat-card,
    .about-kui-team-card,
    .about-kui-partner-card,
    .about-kui-panel {
        border-radius: 20px;
        background: #fff;
        border: 1px solid #edf0f6;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
    }

    .about-kui-value-card {
        padding: 22px 22px 22px 58px;
        position: relative;
    }

    .about-kui-value-icon {
        position: absolute;
        left: 20px;
        top: 22px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #d9ff31;
        color: #111827;
        font-size: 16px;
    }

    .about-kui-panel {
        padding: 36px;
    }

    .about-kui-panel-dark {
        background: #121429;
        border-color: #121429;
        color: #fff;
    }

    .about-kui-panel-dark p,
    .about-kui-panel-dark h2 {
        color: #fff;
    }

    .about-kui-panel-icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .about-kui-stat-card {
        padding: 28px 18px;
    }

    .about-kui-stat-card h3 {
        font-size: 40px;
        color: var(--primaryColor);
    }

    .about-kui-program-card {
        padding: 24px;
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .about-kui-program-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(93, 95, 239, 0.12);
        color: var(--primaryColor);
        font-size: 22px;
        flex-shrink: 0;
    }

    .about-kui-team-card {
        overflow: hidden;
        transition: transform 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
    }

    .about-kui-team-card:hover {
        transform: translateY(-6px);
        border-color: rgba(93, 95, 239, 0.22);
        box-shadow: 0 26px 60px rgba(93, 95, 239, 0.12);
    }

    .about-kui-team-card__media {
        height: 250px;
        background: linear-gradient(145deg, #161a39 0%, #2b3271 100%);
    }

    .about-kui-team-card__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .about-kui-team-card__placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.78);
        font-size: 60px;
    }

    .about-kui-team-card__body {
        padding: 22px;
    }

    .about-kui-team-card__role {
        display: inline-flex;
        align-items: center;
        margin-bottom: 12px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(217, 255, 49, 0.22);
        color: #111827;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .about-kui-team-card__name {
        margin-bottom: 10px;
        font-size: 22px;
        font-weight: 600;
        line-height: 1.3;
    }

    .about-kui-team-card__name a {
        color: #101828;
        text-decoration: none;
    }

    .about-kui-team-card__name a:hover {
        color: var(--primaryColor);
    }

    .about-kui-team-card__bio {
        margin-bottom: 0;
        color: #667085;
        line-height: 1.8;
    }

    .about-kui-partner-wrap {
        background: #f5f7fb;
        padding: 54px 36px;
    }

    .about-kui-partner-card {
        padding: 28px 18px;
    }

    .about-kui-partner-logo {
        width: 88px;
        height: 88px;
        object-fit: contain;
        margin: 0 auto;
        display: block;
    }

    .about-kui-partner-logo-placeholder {
        border-radius: 18px;
        background: rgba(93, 95, 239, 0.08);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--primaryColor);
        font-size: 36px;
    }

    .about-kui-cta {
        background: linear-gradient(135deg, #151933 0%, #5d5fef 100%);
        padding: 48px;
        box-shadow: 0 30px 70px rgba(24, 28, 79, 0.22);
    }

    @media (max-width: 991px) {
        .about-kui-breadcrumb {
            padding: 90px 0 70px;
        }

        .about-kui-image-wrap,
        .about-kui-image,
        .about-kui-image-placeholder {
            min-height: 380px;
            height: 380px;
        }

        .about-kui-cta,
        .about-kui-panel,
        .about-kui-partner-wrap {
            padding: 28px;
        }
    }
</style>
@endpush

@extends('layouts.marketing')

@section('content')
<div class="breadcrumb-area bg-f round-20 position-relative z-1 team-page-breadcrumb">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ url('/') }}">HOME</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                {{ $teamPage['team_page_subtitle'] ?? 'TIM KUI UNIDA' }}
            </li>
        </ul>
        <h1 class="section-title style-one fw-medium font-secondary text-black text-center mb-3">
            {{ $teamPage['team_page_title'] ?? 'Tim KUI Universitas Juanda' }}
        </h1>
        <p class="mx-auto team-page-lead text-para mb-0">
            {{ $teamPage['team_page_description'] ?? '' }}
        </p>
    </div>
</div>

<section class="pt-120 pb-60">
    <div class="container style-one">
        <div class="team-page-highlight">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15">
                        <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                        PROFIL TIM
                    </span>
                    <h2 class="section-title style-one font-secondary fw-medium mb-15">
                        {{ $teamPage['team_page_highlight_title'] ?? 'Kolaboratif, Responsif, Dan Siap Mendampingi Program Internasional' }}
                    </h2>
                    <p class="mb-0 text-para">
                        {{ $teamPage['team_page_highlight_description'] ?? '' }}
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="team-page-stat-card text-center">
                                <h3>{{ $teamStats['members'] }}</h3>
                                <p class="mb-0">Anggota Tim</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="team-page-stat-card text-center">
                                <h3>{{ $teamStats['positions'] }}</h3>
                                <p class="mb-0">Bidang/Peran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-100">
    <div class="container style-one">
        @if ($teams->isEmpty())
            <div class="team-empty-state text-center">
                <span class="team-empty-state__icon"><i class="ri-team-line"></i></span>
                <h3>Profil tim belum tersedia</h3>
                <p>Tambahkan data tim melalui dashboard admin agar halaman ini menampilkan struktur pengelola KUI Universitas Juanda.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('about-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">
                        Lihat Profil KUI
                        <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                        </span>
                    </a>
                    <a href="{{ route('contact-marketing') }}" class="btn style-two fw-semibold position-relative round-oval">
                        Hubungi KUI
                        <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                        </span>
                    </a>
                </div>
            </div>
        @else
            <div class="row g-4">
                @foreach ($teams as $member)
                    <div class="col-xl-4 col-md-6">
                        <article class="team-profile-card h-100">
                            <div class="team-profile-card__image-wrap">
                                @if ($member['image_url'])
                                    <img src="{{ $member['image_url'] }}" alt="{{ $member['name'] }}" class="team-profile-card__image">
                                @else
                                    <div class="team-profile-card__placeholder">
                                        <i class="ri-user-smile-line"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="team-profile-card__body">
                                @if ($member['position'])
                                    <span class="team-profile-card__position">{{ $member['position'] }}</span>
                                @endif
                                <h3 class="team-profile-card__name">
                                    <a href="{{ route('team.show-marketing', $member['slug']) }}">{{ $member['name'] }}</a>
                                </h3>
                                @if ($member['npp'])
                                    <p class="team-profile-card__meta">NPP: {{ $member['npp'] }}</p>
                                @endif
                                <p class="team-profile-card__bio">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($member['bio'] ?: 'Profil singkat anggota tim KUI Universitas Juanda akan tampil pada halaman ini setelah diperbarui melalui dashboard.'), 155) }}
                                </p>
                                <a href="{{ route('team.show-marketing', $member['slug']) }}" class="team-profile-card__link">
                                    Lihat Profil
                                    <i class="ri-arrow-right-up-line"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            @if ($teams->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $teams->links() }}
                </div>
            @endif
        @endif
    </div>
</section>

<section class="pb-130">
    <div class="container style-one">
        <div class="team-page-cta round-20">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h2 class="section-title style-one font-secondary fw-medium text-white mb-15">
                        {{ $teamPage['team_page_cta_title'] ?? 'Butuh Dukungan Atau Ingin Berkolaborasi Dengan Tim KUI?' }}
                    </h2>
                    <p class="mb-0 text-white opacity-75">
                        {{ $teamPage['team_page_cta_description'] ?? '' }}
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ $teamPage['team_page_cta_button_url'] ?? route('contact-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">
                        {{ $teamPage['team_page_cta_button_text'] ?? 'Hubungi KUI' }}
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
    .team-page-breadcrumb {
        padding: 110px 0 82px;
    }

    .team-page-lead {
        max-width: 860px;
        font-size: 18px;
        line-height: 1.85;
    }

    .team-page-highlight {
        padding: 36px;
        border-radius: 28px;
        background: linear-gradient(180deg, #ffffff 0%, #f7f9ff 100%);
        border: 1px solid #e9edf7;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
    }

    .team-page-stat-card {
        padding: 24px 18px;
        border-radius: 22px;
        background: #11162f;
        color: #fff;
        height: 100%;
    }

    .team-page-stat-card h3 {
        margin-bottom: 8px;
        color: #d9ff31;
        font-size: 34px;
        font-weight: 600;
    }

    .team-page-stat-card p {
        color: rgba(255, 255, 255, 0.74);
    }

    .team-empty-state {
        padding: 62px 28px;
        border-radius: 28px;
        background: linear-gradient(180deg, #ffffff 0%, #f8faff 100%);
        border: 1px solid #e9edf7;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
    }

    .team-empty-state__icon {
        width: 84px;
        height: 84px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        border-radius: 24px;
        background: rgba(93, 95, 239, 0.12);
        color: var(--primaryColor);
        font-size: 36px;
    }

    .team-empty-state h3 {
        margin-bottom: 12px;
        font-size: 34px;
        font-weight: 600;
    }

    .team-empty-state p {
        max-width: 640px;
        margin: 0 auto 24px;
        color: #667085;
        line-height: 1.85;
    }

    .team-profile-card {
        overflow: hidden;
        border-radius: 26px;
        background: linear-gradient(180deg, #ffffff 0%, #f9fbff 100%);
        border: 1px solid #e8edf6;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .team-profile-card:hover {
        transform: translateY(-6px);
        border-color: rgba(93, 95, 239, 0.22);
        box-shadow: 0 24px 58px rgba(93, 95, 239, 0.13);
    }

    .team-profile-card__image-wrap {
        position: relative;
        height: 320px;
        background: linear-gradient(145deg, #161a39 0%, #2b3271 100%);
    }

    .team-profile-card__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .team-profile-card__placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.8);
        font-size: 70px;
    }

    .team-profile-card__body {
        padding: 26px 26px 28px;
    }

    .team-profile-card__position {
        display: inline-flex;
        align-items: center;
        margin-bottom: 14px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(217, 255, 49, 0.22);
        color: #111827;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .team-profile-card__name {
        margin-bottom: 10px;
        font-size: 26px;
        font-weight: 600;
        line-height: 1.25;
    }

    .team-profile-card__name a {
        color: #101828;
        text-decoration: none;
    }

    .team-profile-card__name a:hover {
        color: var(--primaryColor);
    }

    .team-profile-card__meta {
        margin-bottom: 14px;
        color: #667085;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .team-profile-card__bio {
        margin-bottom: 22px;
        color: #667085;
        line-height: 1.85;
        min-height: 104px;
    }

    .team-profile-card__link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primaryColor);
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
    }

    .team-profile-card__link i {
        transition: transform 0.2s ease;
    }

    .team-profile-card__link:hover i {
        transform: translate(3px, -3px);
    }

    .team-page-cta {
        padding: 40px 42px;
        background: linear-gradient(135deg, #10152d 0%, #232866 100%);
        box-shadow: 0 30px 70px rgba(16, 21, 45, 0.2);
    }

    @media (max-width: 991px) {
        .team-page-breadcrumb {
            padding: 92px 0 66px;
        }

        .team-page-highlight,
        .team-page-cta,
        .team-empty-state {
            padding: 28px 22px;
        }

        .team-profile-card__image-wrap {
            height: 290px;
        }
    }

    @media (max-width: 767px) {
        .team-page-lead {
            font-size: 16px;
        }

        .team-empty-state h3 {
            font-size: 28px;
        }

        .team-profile-card__body {
            padding: 22px 20px 24px;
        }

        .team-profile-card__name {
            font-size: 22px;
        }

        .team-profile-card__bio {
            min-height: 0;
        }
    }
</style>
@endpush

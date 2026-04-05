@extends('layouts.marketing')

@section('content')
<div class="breadcrumb-area bg-f round-20 position-relative z-1 team-detail-breadcrumb">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ url('/') }}">HOME</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ route('teams-marketing') }}">{{ $teamPage['team_page_subtitle'] ?? 'TIM KUI UNIDA' }}</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                {{ $team['name'] }}
            </li>
        </ul>
        <h1 class="section-title style-one fw-medium font-secondary text-black text-center mb-0">
            {{ $team['name'] }}
        </h1>
    </div>
</div>

<section class="pt-120 pb-100">
    <div class="container style-one">
        <div class="team-detail-card">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="team-detail-media">
                        @if ($team['image_url'])
                            <img src="{{ $team['image_url'] }}" alt="{{ $team['name'] }}" class="team-detail-media__image">
                        @else
                            <div class="team-detail-media__placeholder">
                                <i class="ri-user-smile-line"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
                    @if ($team['position'])
                        <span class="team-detail-role">{{ $team['position'] }}</span>
                    @endif
                    <h2 class="section-title style-one font-secondary fw-medium mb-15">{{ $team['name'] }}</h2>
                    @if ($team['npp'])
                        <p class="team-detail-meta mb-20">NPP: {{ $team['npp'] }}</p>
                    @endif

                    <div class="team-detail-bio">
                        {!! nl2br(e($team['bio'] ?: 'Profil anggota tim ini belum diperbarui melalui dashboard.')) !!}
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-30">
                        <a href="{{ route('contact-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">
                            Hubungi KUI
                            <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                            </span>
                        </a>
                        <a href="{{ route('teams-marketing') }}" class="btn style-two fw-semibold position-relative round-oval">
                            Kembali Ke Tim
                            <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($relatedTeams->isNotEmpty())
    <section class="pb-130">
        <div class="container style-one">
            <div class="text-center mb-40">
                <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15">
                    <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                    TIM LAINNYA
                </span>
                <h2 class="section-title style-one font-secondary fw-medium mb-0">
                    Kenali Anggota Tim KUI Universitas Juanda Lainnya
                </h2>
            </div>

            <div class="row g-4">
                @foreach ($relatedTeams as $item)
                    <div class="col-lg-4 col-md-6">
                        <article class="team-mini-card h-100">
                            <div class="team-mini-card__media">
                                @if ($item['image_url'])
                                    <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="team-mini-card__image">
                                @else
                                    <div class="team-mini-card__placeholder">
                                        <i class="ri-user-smile-line"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="team-mini-card__body">
                                @if ($item['position'])
                                    <span class="team-mini-card__role">{{ $item['position'] }}</span>
                                @endif
                                <h3 class="team-mini-card__name">
                                    <a href="{{ route('team.show-marketing', $item['slug']) }}">{{ $item['name'] }}</a>
                                </h3>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection

@push('styles')
<style>
    .team-detail-breadcrumb {
        padding: 110px 0 80px;
    }

    .team-detail-card {
        padding: 36px;
        border-radius: 30px;
        background: linear-gradient(180deg, #ffffff 0%, #f8faff 100%);
        border: 1px solid #e9edf7;
        box-shadow: 0 26px 65px rgba(15, 23, 42, 0.08);
    }

    .team-detail-media {
        overflow: hidden;
        border-radius: 28px;
        min-height: 500px;
        background: linear-gradient(145deg, #161a39 0%, #2b3271 100%);
    }

    .team-detail-media__image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        display: block;
    }

    .team-detail-media__placeholder {
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.82);
        font-size: 96px;
    }

    .team-detail-role,
    .team-mini-card__role {
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

    .team-detail-meta {
        color: #667085;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .team-detail-bio {
        color: #475467;
        font-size: 16px;
        line-height: 1.95;
    }

    .team-mini-card {
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(180deg, #ffffff 0%, #f9fbff 100%);
        border: 1px solid #e9edf7;
        box-shadow: 0 18px 44px rgba(15, 23, 42, 0.08);
    }

    .team-mini-card__media {
        height: 260px;
        background: linear-gradient(145deg, #161a39 0%, #2b3271 100%);
    }

    .team-mini-card__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .team-mini-card__placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.82);
        font-size: 66px;
    }

    .team-mini-card__body {
        padding: 22px;
    }

    .team-mini-card__name {
        margin-bottom: 0;
        font-size: 23px;
        font-weight: 600;
        line-height: 1.3;
    }

    .team-mini-card__name a {
        color: #101828;
        text-decoration: none;
    }

    .team-mini-card__name a:hover {
        color: var(--primaryColor);
    }

    @media (max-width: 991px) {
        .team-detail-breadcrumb {
            padding: 92px 0 68px;
        }

        .team-detail-card {
            padding: 28px 22px;
        }

        .team-detail-media,
        .team-detail-media__image,
        .team-detail-media__placeholder {
            min-height: 380px;
            height: 380px;
        }
    }

    @media (max-width: 767px) {
        .team-detail-bio {
            font-size: 15px;
        }
    }
</style>
@endpush

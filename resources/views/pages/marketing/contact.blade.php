@extends('layouts.marketing')

@section('content')
<div class="breadcrumb-area bg-f round-20 position-relative z-1 contact-kui-breadcrumb">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ url('/') }}">HOME</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                {{ $contactPage['contact_page_subtitle'] ?? 'HUBUNGI KUI UNIDA' }}
            </li>
        </ul>
        <h1 class="section-title style-one fw-medium font-secondary text-black text-center mb-3">
            {{ $contactPage['contact_page_title'] ?? 'Hubungi KUI Unida' }}
        </h1>
        <p class="mx-auto contact-kui-lead text-para mb-0">
            {{ $contactPage['contact_page_description'] ?? '' }}
        </p>
    </div>
</div>

<section class="pt-130 pb-100">
    <div class="container style-one">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="contact-kui-panel h-100">
                    <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-block bg_secondary text-title round-oval mb-15">
                        <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                        {{ $contactPage['contact_page_card_title'] ?? 'Kantor Urusan Internasional' }}
                    </span>

                    <h2 class="section-title style-one font-secondary fw-medium mb-20">
                        KUI Universitas Juanda
                    </h2>

                    <p class="mb-30">
                        {{ $contactPage['contact_page_response_note'] ?? '' }}
                    </p>

                    <div class="contact-kui-list">
                        <div class="contact-kui-item">
                            <span class="contact-kui-icon"><i class="ri-map-pin-line"></i></span>
                            <div>
                                <strong>Alamat</strong>
                                <p class="mb-0">{{ $contactInfo['footer_address'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="contact-kui-item">
                            <span class="contact-kui-icon"><i class="ri-mail-line"></i></span>
                            <div>
                                <strong>Email</strong>
                                <p class="mb-0">
                                    <a href="mailto:{{ $contactInfo['footer_email'] ?? '' }}">{{ $contactInfo['footer_email'] ?? '-' }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="contact-kui-item">
                            <span class="contact-kui-icon"><i class="ri-phone-line"></i></span>
                            <div>
                                <strong>Telepon</strong>
                                <p class="mb-0">
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactInfo['footer_phone'] ?? '') }}">{{ $contactInfo['footer_phone'] ?? '-' }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="contact-kui-item">
                            <span class="contact-kui-icon"><i class="ri-time-line"></i></span>
                            <div>
                                <strong>{{ $contactPage['contact_page_hours_title'] ?? 'Jam Layanan' }}</strong>
                                <p class="mb-0">{{ $contactPage['contact_page_hours_value'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-kui-visual h-100">
                    @if(!empty($contactPage['contact_page_map_embed_url']))
                        <iframe
                            src="{{ $contactPage['contact_page_map_embed_url'] }}"
                            width="100%"
                            height="100%"
                            style="border:0; min-height: 540px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @else
                        <div class="contact-kui-placeholder h-100">
                            <div class="contact-kui-placeholder-badge">KUI UNIDA</div>
                            <h3 class="font-secondary fw-medium mb-3">Kolaborasi Internasional Dimulai Dari Komunikasi Yang Tepat</h3>
                            <p class="mb-4">
                                Silakan gunakan email, telepon, atau kanal media sosial resmi untuk memulai komunikasi dengan Kantor Urusan Internasional Universitas Juanda.
                            </p>

                            @if(!empty($socialLinks))
                                <div class="contact-kui-socials d-flex flex-wrap gap-2">
                                    @foreach($socialLinks as $socialLink)
                                        <a href="{{ $socialLink['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="contact-kui-social-pill">
                                            <i class="{{ $socialLink['icon'] ?? 'ri-global-line' }}"></i>
                                            <span>{{ $socialLink['title'] ?? 'Social Media' }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .contact-kui-breadcrumb {
        padding: 110px 0 80px;
    }

    .contact-kui-lead {
        max-width: 860px;
        font-size: 18px;
        line-height: 1.8;
    }

    .contact-kui-panel,
    .contact-kui-visual {
        height: 100%;
        border-radius: 24px;
        background: #fff;
        border: 1px solid #edf0f6;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
    }

    .contact-kui-panel {
        padding: 36px;
    }

    .contact-kui-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .contact-kui-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 18px 20px;
        border-radius: 18px;
        background: #f8f9fd;
    }

    .contact-kui-icon {
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

    .contact-kui-item strong {
        display: block;
        margin-bottom: 4px;
        color: #111827;
    }

    .contact-kui-item a {
        color: inherit;
    }

    .contact-kui-placeholder {
        min-height: 540px;
        padding: 42px;
        border-radius: 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: linear-gradient(135deg, #141834 0%, #1f2461 100%);
        color: #fff;
    }

    .contact-kui-placeholder-badge {
        display: inline-flex;
        width: fit-content;
        padding: 10px 16px;
        border-radius: 999px;
        background: #d9ff31;
        color: #111827;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 22px;
    }

    .contact-kui-social-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        transition: 0.2s ease;
    }

    .contact-kui-social-pill:hover {
        background: rgba(255, 255, 255, 0.16);
        color: #fff;
    }

    @media (max-width: 991px) {
        .contact-kui-breadcrumb {
            padding: 90px 0 70px;
        }

        .contact-kui-panel,
        .contact-kui-placeholder {
            padding: 28px;
        }

        .contact-kui-placeholder {
            min-height: 420px;
        }
    }
</style>
@endpush

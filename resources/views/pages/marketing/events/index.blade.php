@extends('layouts.marketing')

@section('content')

{{-- ============================================================ --}}
{{-- BREADCRUMB --}}
{{-- ============================================================ --}}
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block"><a href="{{ url('/') }}">HOME</a></li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">AGENDA</li>
        </ul>
        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-6">{{ $breadcrumb['title'] ?? 'Agenda & Kegiatan' }}</h2>
    </div>
</div>
{{-- Breadcrumb End --}}

{{-- ============================================================ --}}
{{-- AGENDA LIST --}}
{{-- ============================================================ --}}
<section class="agenda-area pt-100 pb-80">
    <div class="container">

        @if ($agendas->isEmpty())
            <div class="marketing-empty-state">
                <div class="marketing-empty-state__card text-center mx-auto">
                    <span class="marketing-empty-state__icon">
                        <i class="ri-calendar-event-line"></i>
                    </span>
                    <span class="marketing-empty-state__eyebrow">AGENDA KUI UNIDA</span>
                    <h3 class="marketing-empty-state__title">Belum Ada Agenda Kegiatan Yang Dipublikasikan</h3>
                    <p class="marketing-empty-state__description">
                        Informasi agenda, kunjungan internasional, sosialisasi program, dan kegiatan resmi KUI Universitas Juanda akan tampil di halaman ini setelah dipublikasikan melalui dashboard admin.
                    </p>
                    <div class="marketing-empty-state__actions d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ url('/') }}" class="btn style-two fw-semibold position-relative round-oval">
                            Kembali ke Beranda
                            <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                            </span>
                        </a>
                        <a href="{{ route('contact-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">
                            Hubungi KUI
                            <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="row p-5" >
                @foreach ($agendas as $agenda)
                    <div class="col-xl-4 col-md-6 mb-4 mb-xl-5">
                        <div class="event-showcase-card h-100">
                            <div class="event-showcase-card__top">
                                <span class="event-showcase-card__eyebrow">Agenda KUI</span>

                                @if ($agenda->isOngoing())
                                    <span class="event-showcase-card__status event-showcase-card__status--ongoing">
                                        Berlangsung
                                    </span>
                                @elseif ($agenda->isUpcoming())
                                    <span class="event-showcase-card__status event-showcase-card__status--upcoming">
                                        Akan Datang
                                    </span>
                                @else
                                    <span class="event-showcase-card__status event-showcase-card__status--past">
                                        Selesai
                                    </span>
                                @endif
                            </div>

                            <div class="event-showcase-card__body">
                                <div class="event-showcase-card__date-box">
                                    <span class="event-showcase-card__date-day">{{ $agenda->start_date->format('d') }}</span>
                                    <span class="event-showcase-card__date-month">{{ $agenda->start_date->translatedFormat('M Y') }}</span>
                                </div>

                                <div class="event-showcase-card__content">
                                    <h5 class="event-showcase-card__title">
                                        <a href="{{ route('event.show-marketing', $agenda->slug) }}" class="text-decoration-none">
                                            {{ $agenda->trans('name') }}
                                        </a>
                                    </h5>

                                    <ul class="event-showcase-card__meta list-unstyled mb-0">
                                        <li>
                                            <i class="ri-calendar-line"></i>
                                            <span>
                                                {{ $agenda->start_date->format('d M Y') }}
                                                @if ($agenda->end_date && $agenda->start_date->format('d M Y') !== $agenda->end_date->format('d M Y'))
                                                    &ndash; {{ $agenda->end_date->format('d M Y') }}
                                                @endif
                                            </span>
                                        </li>
                                        <li>
                                            <i class="ri-time-line"></i>
                                            <span>
                                                {{ $agenda->start_date->format('H:i') }}
                                                @if ($agenda->end_date)
                                                    &ndash; {{ $agenda->end_date->format('H:i') }}
                                                @endif
                                            </span>
                                        </li>
                                        @if ($agenda->trans('location'))
                                            <li>
                                                <i class="ri-map-pin-line"></i>
                                                <span>{{ $agenda->trans('location') }}</span>
                                            </li>
                                        @endif
                                    </ul>

                                    <p class="event-showcase-card__description">
                                        {{ Str::limit($agenda->trans('description') ?: 'Agenda resmi KUI Universitas Juanda akan memuat informasi waktu, lokasi, dan rangkaian kegiatan secara lengkap pada halaman detail.', 130) }}
                                    </p>

                                    <a href="{{ route('event.show-marketing', $agenda->slug) }}" class="event-showcase-card__link">
                                        Lihat Detail Agenda
                                        <i class="ri-arrow-right-up-line"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ================================================ --}}
            {{-- PAGINATION --}}
            {{-- ================================================ --}}
            @if ($agendas->hasPages())
                <div class="row mt-20">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $agendas->links() }}
                    </div>
                </div>
            @endif

        @endif

    </div>
</section>

@endsection

@push('styles')
<style>
    .marketing-empty-state {
        padding: 40px 0 70px;
    }

    .marketing-empty-state__card {
        max-width: 760px;
        padding: 54px 42px;
        border-radius: 28px;
        background: linear-gradient(135deg, #151933 0%, #232866 100%);
        box-shadow: 0 28px 70px rgba(21, 25, 51, 0.18);
    }

    .marketing-empty-state__icon {
        width: 86px;
        height: 86px;
        border-radius: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 22px;
        background: rgba(217, 255, 49, 0.14);
        color: #d9ff31;
        font-size: 38px;
    }

    .marketing-empty-state__eyebrow {
        display: inline-block;
        margin-bottom: 14px;
        padding: 9px 16px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        color: #d9ff31;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .marketing-empty-state__title {
        margin-bottom: 14px;
        color: #fff;
        font-size: 38px;
        font-weight: 600;
        line-height: 1.2;
    }

    .marketing-empty-state__description {
        max-width: 620px;
        margin: 0 auto 30px;
        color: rgba(255, 255, 255, 0.76);
        font-size: 16px;
        line-height: 1.85;
    }

    .marketing-empty-state__actions .btn {
        min-width: 220px;
    }

    .event-showcase-card {
        height: 100%;
        padding: 28px;
        border-radius: 24px;
        background: linear-gradient(180deg, #ffffff 0%, #f7f9ff 100%);
        border: 1px solid #e9edf7;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .event-showcase-card:hover {
        transform: translateY(-6px);
        border-color: rgba(93, 95, 239, 0.22);
        box-shadow: 0 24px 60px rgba(93, 95, 239, 0.12);
    }

    .event-showcase-card__top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 26px;
    }

    .event-showcase-card__eyebrow {
        display: inline-flex;
        align-items: center;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(217, 255, 49, 0.2);
        color: #111827;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .event-showcase-card__status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .event-showcase-card__status--ongoing {
        background: rgba(16, 185, 129, 0.14);
        color: #047857;
    }

    .event-showcase-card__status--upcoming {
        background: rgba(93, 95, 239, 0.12);
        color: var(--primaryColor);
    }

    .event-showcase-card__status--past {
        background: rgba(148, 163, 184, 0.16);
        color: #475569;
    }

    .event-showcase-card__body {
        display: flex;
        gap: 22px;
        height: calc(100% - 62px);
    }

    .event-showcase-card__date-box {
        width: 92px;
        min-width: 92px;
        padding: 20px 14px;
        border-radius: 22px;
        background: linear-gradient(160deg, #171a38 0%, #262c69 100%);
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .event-showcase-card__date-day {
        display: block;
        font-size: 34px;
        font-weight: 700;
        line-height: 1;
    }

    .event-showcase-card__date-month {
        display: block;
        margin-top: 10px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        opacity: 0.82;
    }

    .event-showcase-card__content {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
    }

    .event-showcase-card__title {
        margin-bottom: 16px;
        font-size: 24px;
        font-weight: 600;
        line-height: 1.25;
    }

    .event-showcase-card__title a {
        color: #101828;
    }

    .event-showcase-card__title a:hover {
        color: var(--primaryColor);
    }

    .event-showcase-card__meta {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 22px;
    }

    .event-showcase-card__meta li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #667085;
        font-size: 14px;
        line-height: 1.6;
    }

    .event-showcase-card__meta i {
        margin-top: 2px;
        color: var(--primaryColor);
        font-size: 17px;
        flex-shrink: 0;
    }

    .event-showcase-card__description {
        margin-bottom: 26px;
        color: #667085;
        font-size: 14px;
        line-height: 1.85;
        flex-grow: 1;
    }

    .event-showcase-card__link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: auto;
        color: var(--primaryColor);
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
    }

    .event-showcase-card__link i {
        font-size: 16px;
        transition: transform 0.2s ease;
    }

    .event-showcase-card__link:hover i {
        transform: translate(3px, -3px);
    }

    @media (max-width: 767px) {
        .marketing-empty-state__card {
            padding: 36px 24px;
        }

        .marketing-empty-state__title {
            font-size: 30px;
        }

        .marketing-empty-state__actions .btn {
            width: 100%;
            min-width: 0;
        }

        .event-showcase-card {
            padding: 22px;
        }

        .event-showcase-card__body {
            flex-direction: column;
            gap: 16px;
        }

        .event-showcase-card__date-box {
            width: 100%;
            min-width: 0;
            flex-direction: row;
            gap: 12px;
            justify-content: flex-start;
            text-align: left;
        }

        .event-showcase-card__date-month {
            margin-top: 0;
        }

        .event-showcase-card__title {
            font-size: 22px;
        }

        .agenda-area {
            padding-top: 82px;
            padding-bottom: 68px;
        }
    }
</style>
@endpush

@extends('layouts.marketing')

@section('content')

{{-- ============================================================ --}}
{{-- BREADCRUMB --}}
{{-- ============================================================ --}}
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block"><a href="index.html">HOME</a></li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">EVENTS</li>
        </ul>
        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-6">Events</h2>
    </div>
</div>
{{-- Breadcrumb End --}}

{{-- ============================================================ --}}
{{-- AGENDA LIST --}}
{{-- ============================================================ --}}
<section class="agenda-area pt-100 pb-70">
    <div class="container">

        @if ($agendas->isEmpty())
            <div class="text-center py-60">
                <p class="text-muted fs-16">Belum ada agenda yang tersedia.</p>
            </div>
        @else
            <div class="row">
                @foreach ($agendas as $agenda)
                    <div class="col-xl-4 col-md-6 mb-30">
                        <div class="agenda-card bg-white round-10 overflow-hidden h-100 d-flex flex-column">

                            {{-- Date Badge --}}
                            <div class="agenda-card__header bg_primary p-25 d-flex align-items-center justify-content-between gap-10">
                                <div class="agenda-card__date text-white">
                                    <span class="d-block fs-30 fw-bold lh-1">
                                        {{ $agenda->start_date->format('d') }}
                                    </span>
                                    <span class="fs-13 fw-semibold ls-1 text-uppercase">
                                        {{ $agenda->start_date->translatedFormat('M Y') }}
                                    </span>
                                </div>

                                {{-- Status Badge --}}
                                @if ($agenda->isOngoing())
                                    <span class="badge bg-success fs-11 fw-semibold ls-1 px-10 py-6 round-20">
                                        Berlangsung
                                    </span>
                                @elseif ($agenda->isUpcoming())
                                    <span class="badge bg_secondary fs-11 fw-semibold ls-1 px-10 py-6 round-20">
                                        Akan Datang
                                    </span>
                                @else
                                    <span class="badge bg-secondary fs-11 fw-semibold ls-1 px-10 py-6 round-20 opacity-75">
                                        Selesai
                                    </span>
                                @endif
                            </div>

                            {{-- Card Body --}}
                            <div class="agenda-card__body p-25 d-flex flex-column flex-grow-1">

                                {{-- Title --}}
                                <h5 class="agenda-card__title fw-semibold font-secondary mb-15 lh-sm">
                                    <a href="{{ route('agendas.show', $agenda->slug) }}"
                                       class="text-black hover-primary text-decoration-none">
                                        {{ $agenda->trans('name') }}
                                    </a>
                                </h5>

                                {{-- Meta --}}
                                <ul class="agenda-card__meta list-unstyled mb-15 d-flex flex-column gap-8">

                                    {{-- Tanggal range --}}
                                    <li class="d-flex align-items-center gap-8 fs-14 text-muted">
                                        <i class="ri-calendar-line text_primary fs-16 flex-shrink-0"></i>
                                        <span>
                                            {{ $agenda->start_date->format('d M Y') }}
                                            @if ($agenda->end_date && $agenda->start_date->format('d M Y') !== $agenda->end_date->format('d M Y'))
                                                &ndash; {{ $agenda->end_date->format('d M Y') }}
                                            @endif
                                        </span>
                                    </li>

                                    {{-- Jam --}}
                                    <li class="d-flex align-items-center gap-8 fs-14 text-muted">
                                        <i class="ri-time-line text_primary fs-16 flex-shrink-0"></i>
                                        <span>
                                            {{ $agenda->start_date->format('H:i') }}
                                            @if ($agenda->end_date)
                                                &ndash; {{ $agenda->end_date->format('H:i') }}
                                            @endif
                                        </span>
                                    </li>

                                    {{-- Lokasi --}}
                                    @if ($agenda->trans('location'))
                                        <li class="d-flex align-items-center gap-8 fs-14 text-muted">
                                            <i class="ri-map-pin-line text_primary fs-16 flex-shrink-0"></i>
                                            <span>{{ $agenda->trans('location') }}</span>
                                        </li>
                                    @endif

                                </ul>

                                {{-- Description --}}
                                @if ($agenda->trans('description'))
                                    <p class="fs-14 text-muted lh-md mb-20 flex-grow-1">
                                        {{ Str::limit($agenda->trans('description'), 100) }}
                                    </p>
                                @else
                                    <div class="flex-grow-1"></div>
                                @endif

                                {{-- CTA --}}
                                <a href="{{ route('event.show-marketing', $agenda->slug) }}"
                                   class="btn-link text_primary fw-semibold fs-14 d-inline-flex align-items-center gap-6 text-decoration-none mt-auto">
                                    Selengkapnya
                                    <i class="ri-arrow-right-line"></i>
                                </a>

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
                        {{ $agendas->links('components.pagination') }}
                    </div>
                </div>
            @endif

        @endif

    </div>
</section>

@endsection
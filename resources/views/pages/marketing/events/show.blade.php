@extends('layouts.marketing')

@section('content')

{{-- ============================================================ --}}
{{-- BREADCRUMB --}}
{{-- ============================================================ --}}
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            @foreach ($breadcrumb['menus'] as $menu)
                <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                    @if ($menu['url'])
                        <a href="{{ $menu['url'] }}">{{ $menu['label'] }}</a>
                    @else
                        {{ $menu['label'] }}
                    @endif
                </li>
            @endforeach
        </ul>
        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-6">
            {{ $breadcrumb['title'] }}
        </h2>
    </div>
</div>
{{-- Breadcrumb End --}}

{{-- ============================================================ --}}
{{-- DETAIL AGENDA --}}
{{-- ============================================================ --}}
<section class="agenda-detail-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">

                {{-- Header Card --}}
                <div class="agenda-detail__header bg_primary round-10 p-40 mb-30 position-relative overflow-hidden">

                    {{-- Status --}}
                    <div class="mb-15">
                        @if ($agenda->isOngoing())
                            <span class="badge bg-success fs-12 fw-semibold ls-1 px-12 py-8 round-20">
                                <i class="ri-live-line me-4"></i> Sedang Berlangsung
                            </span>
                        @elseif ($agenda->isUpcoming())
                            <span class="badge bg_secondary fs-12 fw-semibold ls-1 px-12 py-8 round-20">
                                <i class="ri-time-line me-4"></i> Akan Datang
                            </span>
                        @else
                            <span class="badge bg-secondary opacity-75 fs-12 fw-semibold ls-1 px-12 py-8 round-20">
                                <i class="ri-checkbox-circle-line me-4"></i> Selesai
                            </span>
                        @endif
                    </div>

                    {{-- Title --}}
                    <h2 class="font-secondary fw-bold text-white lh-sm mb-25">
                        {{ $agenda->trans('name') }}
                    </h2>

                    {{-- Meta --}}
                    <ul class="list-unstyled d-flex flex-wrap gap-20 mb-0">
                        <li class="d-flex align-items-center gap-8 text-white fs-14">
                            <i class="ri-calendar-line fs-18 opacity-75"></i>
                            <span>
                                {{ $agenda->start_date->format('d M Y') }}
                                @if ($agenda->end_date && $agenda->start_date->format('d M Y') !== $agenda->end_date->format('d M Y'))
                                    &ndash; {{ $agenda->end_date->format('d M Y') }}
                                @endif
                            </span>
                        </li>
                        <li class="d-flex align-items-center gap-8 text-white fs-14">
                            <i class="ri-time-line fs-18 opacity-75"></i>
                            <span>
                                {{ $agenda->start_date->format('H:i') }}
                                @if ($agenda->end_date)
                                    &ndash; {{ $agenda->end_date->format('H:i') }}
                                @endif
                            </span>
                        </li>
                        @if ($agenda->trans('location'))
                            <li class="d-flex align-items-center gap-8 text-white fs-14">
                                <i class="ri-map-pin-line fs-18 opacity-75"></i>
                                <span>{{ $agenda->trans('location') }}</span>
                            </li>
                        @endif
                    </ul>

                </div>

                {{-- Description --}}
                @if ($agenda->trans('description'))
                    <div class="agenda-detail__body bg-white round-10 p-40 mb-30">
                        <h5 class="fw-semibold font-secondary mb-20">Informasi Agenda</h5>
                        <div class="fs-15 lh-lg text-muted">
                            {!! nl2br(e($agenda->trans('description'))) !!}
                        </div>
                    </div>
                @endif

                {{-- Prev / Next Navigation --}}
                @if ($prev || $next)
                    <div class="agenda-detail__nav d-flex justify-content-between gap-15 mt-30">

                        @if ($prev)
                            <a href="{{ route('event.show-marketing', $prev->slug) }}"
                               class="agenda-nav__item d-flex align-items-center gap-12 text-decoration-none p-20 bg-white round-10 flex-grow-1" style="max-width: 48%;">
                                <i class="ri-arrow-left-line text_primary fs-20 flex-shrink-0"></i>
                                <div class="overflow-hidden">
                                    <span class="d-block fs-12 fw-semibold ls-1 text-muted mb-4">AGENDA SEBELUMNYA</span>
                                    <span class="d-block fs-14 fw-semibold text-black text-truncate">
                                        {{ $prev->trans('name') }}
                                    </span>
                                </div>
                            </a>
                        @else
                            <div class="flex-grow-1"></div>
                        @endif

                        @if ($next)
                            <a href="{{ route('event.show-marketing', $next->slug) }}"
                               class="agenda-nav__item d-flex align-items-center justify-content-end gap-12 text-decoration-none p-20 bg-white round-10 flex-grow-1 text-end" style="max-width: 48%;">
                                <div class="overflow-hidden">
                                    <span class="d-block fs-12 fw-semibold ls-1 text-muted mb-4">AGENDA BERIKUTNYA</span>
                                    <span class="d-block fs-14 fw-semibold text-black text-truncate">
                                        {{ $next->trans('name') }}
                                    </span>
                                </div>
                                <i class="ri-arrow-right-line text_primary fs-20 flex-shrink-0"></i>
                            </a>
                        @else
                            <div class="flex-grow-1"></div>
                        @endif

                    </div>
                @endif

                {{-- Back Button --}}
                <div class="text-center mt-40">
                    <a href="{{ route('events-marketing') }}"
                       class="btn bg_primary text-white round-6 px-30 py-14 fw-semibold text-decoration-none">
                        <i class="ri-arrow-left-line me-6"></i>
                        Kembali ke Daftar Agenda
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

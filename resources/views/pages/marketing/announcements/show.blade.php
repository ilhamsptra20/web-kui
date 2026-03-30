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
{{-- DETAIL ANNOUNCEMENT --}}
{{-- ============================================================ --}}
<section class="announcement-detail-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">

                {{-- Header --}}
                <div class="announcement-detail__header mb-30">

                    {{-- Date --}}
                    <div class="d-flex align-items-center gap-8 mb-15">
                        <i class="ri-calendar-line text_primary fs-16"></i>
                        <span class="fs-13 fw-semibold ls-1 text-muted">
                            {{ $announcement->created_at->format('d M Y') }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h2 class="font-secondary fw-bold text-black lh-sm mb-0">
                        {{ $announcement->trans('title') }}
                    </h2>

                </div>

                {{-- Divider --}}
                <hr class="mb-30 opacity-25">

                {{-- Content --}}
                @if ($announcement->trans('content'))
                    <div class="announcement-detail__content fs-15 lh-lg text-muted mb-30">
                        {!! nl2br(e($announcement->trans('content'))) !!}
                    </div>
                @endif

                {{-- File Attachment --}}
                @if ($announcement->hasFile())
                    <div class="announcement-detail__attachment bg-white round-10 p-20 d-flex align-items-center gap-15 mb-30">
                        <div class="attachment__icon bg_primary_light round-8 p-12 flex-shrink-0 d-flex align-items-center justify-content-center"
                             style="width: 48px; height: 48px;">
                            <i class="{{ $announcement->fileIcon() }} text_primary fs-22"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <span class="d-block fs-13 text-muted mb-2">Lampiran</span>
                            <span class="d-block fs-14 fw-semibold text-black text-truncate">
                                {{ basename($announcement->file_path) }}
                            </span>
                        </div>
                        <a href="{{ Storage::url($announcement->file_path) }}"
                           target="_blank"
                           class="btn bg_primary text-white round-6 px-20 py-10 fw-semibold fs-14 text-decoration-none flex-shrink-0">
                            <i class="ri-download-line me-6"></i>
                            Unduh
                        </a>
                    </div>
                @endif

                {{-- Divider --}}
                <hr class="mb-30 opacity-25">

                {{-- Prev / Next Navigation --}}
                @if ($prev || $next)
                    <div class="announcement-detail__nav d-flex justify-content-between gap-15 mb-30">

                        @if ($prev)
                            <a href="{{ route('announcements.show', $prev->id) }}"
                               class="announcement-nav__item d-flex align-items-center gap-12 text-decoration-none p-20 bg-white round-10 flex-grow-1"
                               style="max-width: 48%;">
                                <i class="ri-arrow-left-line text_primary fs-20 flex-shrink-0"></i>
                                <div class="overflow-hidden">
                                    <span class="d-block fs-12 fw-semibold ls-1 text-muted mb-4">SEBELUMNYA</span>
                                    <span class="d-block fs-14 fw-semibold text-black text-truncate">
                                        {{ $prev->trans('title') }}
                                    </span>
                                </div>
                            </a>
                        @else
                            <div class="flex-grow-1"></div>
                        @endif

                        @if ($next)
                            <a href="{{ route('announcements.show', $next->id) }}"
                               class="announcement-nav__item d-flex align-items-center justify-content-end gap-12 text-decoration-none p-20 bg-white round-10 flex-grow-1 text-end"
                               style="max-width: 48%;">
                                <div class="overflow-hidden">
                                    <span class="d-block fs-12 fw-semibold ls-1 text-muted mb-4">BERIKUTNYA</span>
                                    <span class="d-block fs-14 fw-semibold text-black text-truncate">
                                        {{ $next->trans('title') }}
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
                <div class="text-center">
                    <a href="{{ route('announcements-marketing') }}"
                       class="btn bg_primary text-white round-6 px-30 py-14 fw-semibold text-decoration-none">
                        <i class="ri-arrow-left-line me-6"></i>
                        Kembali ke Pengumuman
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
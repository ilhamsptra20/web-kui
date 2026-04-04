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
{{-- ANNOUNCEMENT LIST --}}
{{-- ============================================================ --}}
<section class="announcement-area pt-100 pb-70">
    <div class="container">

        @if ($announcements->isEmpty())
            <div class="text-center py-60">
                <i class="ri-notification-off-line fs-48 text-muted opacity-50 d-block mb-15"></i>
                <p class="text-muted fs-16">Belum ada pengumuman saat ini.</p>
            </div>
        @else
            <div class="row">
                <div class="col-lg-10 offset-lg-1">

                    {{-- List --}}
                    <div class="announcement-list d-flex flex-column gap-15">
                        @foreach ($announcements as $item)
                            <div class="announcement-item bg-white round-10 p-25 d-flex align-items-start gap-20">

                                {{-- Icon --}}
                                <div class="announcement-item__icon bg_primary_light round-8 p-15 flex-shrink-0 d-flex align-items-center justify-content-center"
                                     style="width: 52px; height: 52px;">
                                    <i class="ri-megaphone-line text_primary fs-22"></i>
                                </div>

                                {{-- Content --}}
                                <div class="announcement-item__content flex-grow-1 overflow-hidden">

                                    <div class="d-flex align-items-start justify-content-between gap-10 mb-8 flex-wrap">
                                        <h6 class="fw-semibold font-secondary mb-0 lh-sm">
                                            <a href="{{ route('announcements.marketing.show', $item->id) }}"
                                               class="text-black hover-primary text-decoration-none">
                                                {{ $item->trans('title') }}
                                            </a>
                                        </h6>
                                        <span class="fs-12 text-muted fw-medium flex-shrink-0">
                                            <i class="ri-calendar-line me-4"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    @if ($item->trans('content'))
                                        <p class="fs-14 text-muted lh-md mb-0">
                                            {{ Str::limit(strip_tags($item->trans('content')), 120) }}
                                        </p>
                                    @endif

                                    {{-- Footer: file + read more --}}
                                    <div class="d-flex align-items-center gap-15 mt-12 flex-wrap">

                                        @if ($item->hasFile())
                                            <a href="{{ Storage::url($item->file_path) }}"
                                               target="_blank"
                                               class="d-inline-flex align-items-center gap-6 fs-13 fw-semibold text_primary text-decoration-none">
                                                <i class="{{ $item->fileIcon() }} fs-16"></i>
                                                Unduh Lampiran
                                            </a>
                                        @endif

                                        <a href="{{ route('announcements.marketing.show', $item->id) }}"
                                           class="d-inline-flex align-items-center gap-6 fs-13 fw-semibold text_primary text-decoration-none ms-auto">
                                            Baca Selengkapnya
                                            <i class="ri-arrow-right-line"></i>
                                        </a>

                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    {{-- ============================================ --}}
                    {{-- PAGINATION --}}
                    {{-- ============================================ --}}
                    @if ($announcements->hasPages())
                        <div class="d-flex justify-content-center mt-40">
                            {{ $announcements->links() }}
                        </div>
                    @endif

                </div>
            </div>
        @endif

    </div>
</section>

@endsection

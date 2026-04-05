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
<section class="announcement-area pt-100 pb-80">
    <div class="container">

        @if ($announcements->isEmpty())
            <div class="marketing-empty-state">
                <div class="marketing-empty-state__card text-center mx-auto">
                    <span class="marketing-empty-state__icon marketing-empty-state__icon--announcement">
                        <i class="ri-megaphone-line"></i>
                    </span>
                    <span class="marketing-empty-state__eyebrow">PENGUMUMAN KUI UNIDA</span>
                    <h3 class="marketing-empty-state__title">Belum Ada Pengumuman Aktif Saat Ini</h3>
                    <p class="marketing-empty-state__description">
                        Informasi resmi, pemberitahuan program, pembukaan pendaftaran, dan update penting dari Kantor Urusan Internasional Universitas Juanda akan muncul di sini setelah dipublikasikan.
                    </p>
                    <div class="marketing-empty-state__actions d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('events-marketing') }}" class="btn style-two fw-semibold position-relative round-oval">
                            Lihat Agenda KUI
                            <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                            </span>
                        </a>
                        <a href="{{ url('/') }}" class="btn style-three fw-semibold position-relative round-oval">
                            Kembali ke Beranda
                            <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="row p-5">
                <div class="col-lg-10 offset-lg-1">

                    <div class="announcement-list d-flex flex-column gap-4 gap-lg-4">
                        @foreach ($announcements as $item)
                            <div class="announcement-spotlight-card">
                                <div class="announcement-spotlight-card__accent"></div>

                                <div class="announcement-spotlight-card__main">
                                    <div class="announcement-spotlight-card__icon">
                                        <i class="ri-megaphone-line"></i>
                                    </div>

                                    <div class="announcement-spotlight-card__content">
                                        <div class="announcement-spotlight-card__header">
                                            <div>
                                                <span class="announcement-spotlight-card__eyebrow">Pengumuman Resmi</span>
                                                <h5 class="announcement-spotlight-card__title">
                                                    <a href="{{ route('announcements.marketing.show', $item->id) }}" class="text-decoration-none">
                                                        {{ $item->trans('title') }}
                                                    </a>
                                                </h5>
                                            </div>

                                            <div class="announcement-spotlight-card__date">
                                                <i class="ri-calendar-line"></i>
                                                <span>{{ $item->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>

                                        <p class="announcement-spotlight-card__excerpt">
                                            {{ Str::limit(strip_tags($item->trans('content') ?: 'Pengumuman resmi KUI Universitas Juanda akan memuat informasi penting, jadwal, serta dokumen pendukung yang dapat diakses pada halaman detail.'), 180) }}
                                        </p>

                                        <div class="announcement-spotlight-card__footer">
                                            <div class="announcement-spotlight-card__meta">
                                                @if ($item->hasFile())
                                                    <a href="{{ Storage::url($item->file_path) }}" target="_blank" class="announcement-spotlight-card__attachment">
                                                        <i class="{{ $item->fileIcon() }}"></i>
                                                        Lampiran Tersedia
                                                    </a>
                                                @else
                                                    <span class="announcement-spotlight-card__plain-meta">
                                                        <i class="ri-information-line"></i>
                                                        Informasi internal KUI Unida
                                                    </span>
                                                @endif
                                            </div>

                                            <a href="{{ route('announcements.marketing.show', $item->id) }}" class="announcement-spotlight-card__link">
                                                Baca Selengkapnya
                                                <i class="ri-arrow-right-up-line"></i>
                                            </a>
                                        </div>
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

@push('styles')
<style>
    .marketing-empty-state {
        padding: 40px 0 70px;
    }

    .marketing-empty-state__card {
        max-width: 760px;
        padding: 54px 42px;
        border-radius: 28px;
        background: linear-gradient(135deg, #ffffff 0%, #f3f6fb 100%);
        border: 1px solid #e8edf6;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
    }

    .marketing-empty-state__icon {
        width: 86px;
        height: 86px;
        border-radius: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 22px;
        background: rgba(93, 95, 239, 0.12);
        color: var(--primaryColor);
        font-size: 38px;
    }

    .marketing-empty-state__icon--announcement {
        background: rgba(255, 201, 61, 0.2);
        color: #d78f00;
    }

    .marketing-empty-state__eyebrow {
        display: inline-block;
        margin-bottom: 14px;
        padding: 9px 16px;
        border-radius: 999px;
        background: #d9ff31;
        color: #111827;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .marketing-empty-state__title {
        margin-bottom: 14px;
        color: #111827;
        font-size: 38px;
        font-weight: 600;
        line-height: 1.2;
    }

    .marketing-empty-state__description {
        max-width: 620px;
        margin: 0 auto 30px;
        color: #6b7280;
        font-size: 16px;
        line-height: 1.85;
    }

    .marketing-empty-state__actions .btn {
        min-width: 220px;
    }

    .announcement-spotlight-card {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(180deg, #ffffff 0%, #f8faff 100%);
        border: 1px solid #ebeff6;
        box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .announcement-spotlight-card:hover {
        transform: translateY(-5px);
        border-color: rgba(93, 95, 239, 0.18);
        box-shadow: 0 22px 56px rgba(93, 95, 239, 0.12);
    }

    .announcement-spotlight-card__accent {
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        background: linear-gradient(180deg, #5d5fef 0%, #9092ff 100%);
    }

    .announcement-spotlight-card__main {
        display: flex;
        gap: 24px;
        padding: 30px 32px 30px 36px;
    }

    .announcement-spotlight-card__icon {
        width: 64px;
        height: 64px;
        min-width: 64px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(93, 95, 239, 0.1);
        color: var(--primaryColor);
        font-size: 28px;
    }

    .announcement-spotlight-card__content {
        flex: 1 1 auto;
    }

    .announcement-spotlight-card__header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .announcement-spotlight-card__eyebrow {
        display: inline-flex;
        align-items: center;
        margin-bottom: 14px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(217, 255, 49, 0.22);
        color: #111827;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.9px;
        text-transform: uppercase;
    }

    .announcement-spotlight-card__title {
        margin-bottom: 0;
        font-size: 27px;
        font-weight: 600;
        line-height: 1.25;
    }

    .announcement-spotlight-card__title a {
        color: #101828;
    }

    .announcement-spotlight-card__title a:hover {
        color: var(--primaryColor);
    }

    .announcement-spotlight-card__date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        background: #f3f6fb;
        color: #667085;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .announcement-spotlight-card__date i {
        color: var(--primaryColor);
        font-size: 15px;
    }

    .announcement-spotlight-card__excerpt {
        margin-bottom: 22px;
        color: #667085;
        font-size: 15px;
        line-height: 1.95;
    }

    .announcement-spotlight-card__footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .announcement-spotlight-card__meta {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .announcement-spotlight-card__attachment,
    .announcement-spotlight-card__plain-meta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        background: #f8fafc;
        color: #475467;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .announcement-spotlight-card__attachment i,
    .announcement-spotlight-card__plain-meta i {
        color: var(--primaryColor);
        font-size: 16px;
    }

    .announcement-spotlight-card__attachment:hover {
        color: var(--primaryColor);
        background: #eef2ff;
    }

    .announcement-spotlight-card__link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primaryColor);
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
    }

    .announcement-spotlight-card__link i {
        font-size: 16px;
        transition: transform 0.2s ease;
    }

    .announcement-spotlight-card__link:hover i {
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

        .announcement-spotlight-card__main {
            flex-direction: column;
            padding: 24px 22px 24px 26px;
            gap: 18px;
        }

        .announcement-spotlight-card__header {
            flex-direction: column;
            gap: 12px;
        }

        .announcement-spotlight-card__title {
            font-size: 22px;
        }

        .announcement-area {
            padding-top: 82px;
            padding-bottom: 68px;
        }
    }
</style>
@endpush

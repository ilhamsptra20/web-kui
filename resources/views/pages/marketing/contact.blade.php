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

<section class="contact-kui-section">
    <div class="container style-one">
        <div class="row g-4 align-items-stretch">
            <div class="col-xl-5">
                <div class="contact-kui-info-card h-100">
                    <div class="contact-kui-card-head">
                        <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-flex align-items-center bg_secondary text-title round-oval mb-18">
                            <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                            {{ $contactPage['contact_page_card_title'] ?? 'Kantor Urusan Internasional' }}
                        </span>
                        <h2 class="section-title style-one font-secondary fw-medium mb-18">
                            KUI Universitas Juanda
                        </h2>
                        <p class="contact-kui-copy mb-0">
                            {{ $contactPage['contact_page_response_note'] ?? 'Tim kami siap membantu komunikasi terkait kerja sama internasional, mobilitas mahasiswa, dan kebutuhan informasi global.' }}
                        </p>
                    </div>

                    <div class="contact-kui-contact-grid">
                        <article class="contact-kui-contact-tile">
                            <span class="contact-kui-tile-icon">
                                <i class="ri-map-pin-line"></i>
                            </span>
                            <div>
                                <small>Alamat Kantor</small>
                                <h3>Lokasi KUI</h3>
                                <p class="mb-0">{{ $contactInfo['footer_address'] ?? '-' }}</p>
                            </div>
                        </article>

                        <article class="contact-kui-contact-tile">
                            <span class="contact-kui-tile-icon">
                                <i class="ri-mail-line"></i>
                            </span>
                            <div>
                                <small>Email Resmi</small>
                                <h3>Hubungi Via Email</h3>
                                <p class="mb-0">
                                    <a href="mailto:{{ $contactInfo['footer_email'] ?? '' }}">{{ $contactInfo['footer_email'] ?? '-' }}</a>
                                </p>
                            </div>
                        </article>

                        <article class="contact-kui-contact-tile">
                            <span class="contact-kui-tile-icon">
                                <i class="ri-phone-line"></i>
                            </span>
                            <div>
                                <small>Telepon</small>
                                <h3>Kontak Cepat</h3>
                                <p class="mb-0">
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactInfo['footer_phone'] ?? '') }}">{{ $contactInfo['footer_phone'] ?? '-' }}</a>
                                </p>
                            </div>
                        </article>

                        <article class="contact-kui-contact-tile">
                            <span class="contact-kui-tile-icon">
                                <i class="ri-time-line"></i>
                            </span>
                            <div>
                                <small>{{ $contactPage['contact_page_hours_title'] ?? 'Jam Layanan' }}</small>
                                <h3>Layanan Kantor</h3>
                                <p class="mb-0">{{ $contactPage['contact_page_hours_value'] ?? '-' }}</p>
                            </div>
                        </article>
                    </div>

                    @if(!empty($socialLinks))
                        <div class="contact-kui-social-wrap">
                            <span class="contact-kui-eyebrow">KANAL RESMI KUI</span>
                            <div class="contact-kui-social-list">
                                @foreach($socialLinks as $socialLink)
                                    <a href="{{ $socialLink['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="contact-kui-social-pill">
                                        <i class="{{ $socialLink['icon'] ?? 'ri-global-line' }}"></i>
                                        <span>{{ $socialLink['title'] ?? 'Social Media' }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-7">
                <div class="contact-kui-form-card h-100">
                    <div class="contact-kui-card-head contact-kui-card-head--compact">
                        <span class="section-subtitle style-two fs-13 fw-medium ls-1 d-inline-flex align-items-center bg_secondary text-title round-oval mb-18">
                            <img src="{{ asset('assets/marketing/img/icons/lock.svg') }}" alt="Icon">
                            KIRIM PESAN
                        </span>
                        <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3">
                            <div>
                                <h2 class="section-title style-one font-secondary fw-medium mb-12">
                                    Kirim Pesan Langsung Ke Inbox KUI
                                </h2>
                                <p class="contact-kui-copy mb-0">
                                    Sampaikan pertanyaan, kebutuhan informasi, atau usulan kerja sama internasional melalui formulir berikut.
                                </p>
                            </div>
                            <div class="contact-kui-meta-pill">
                                <i class="ri-shield-check-line"></i>
                                <span>Form dilindungi rate limit anti-spam</span>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="contact-kui-alert contact-kui-alert--success">
                            <i class="ri-checkbox-circle-line"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="contact-kui-alert contact-kui-alert--error">
                            <i class="ri-error-warning-line"></i>
                            <div>
                                <strong class="d-block mb-1">Pesan belum bisa dikirim.</strong>
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.inbox.store') }}" method="POST" class="contact-kui-form">
                        @csrf
                        <input type="text" name="website" value="" tabindex="-1" autocomplete="off" class="contact-kui-honeypot" aria-hidden="true">

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label contact-kui-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control contact-kui-input" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label contact-kui-label">Email Aktif</label>
                                <input type="email" name="email" class="form-control contact-kui-input" value="{{ old('email') }}" placeholder="nama@email.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label contact-kui-label">Subjek</label>
                                <input type="text" name="subject" class="form-control contact-kui-input" value="{{ old('subject') }}" placeholder="Misalnya: Kerja sama internasional atau student exchange">
                            </div>
                            <div class="col-12">
                                <label class="form-label contact-kui-label">Pesan</label>
                                <textarea name="message" rows="7" class="form-control contact-kui-input contact-kui-textarea" placeholder="Tuliskan kebutuhan atau pertanyaan Anda secara jelas." required>{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <div class="contact-kui-form-foot">
                            <p class="contact-kui-form-note mb-0">
                                Mohon gunakan data yang valid. Sistem akan membatasi pengiriman berulang agar inbox KUI tetap aman dari spam.
                            </p>
                            <button type="submit" class="btn style-three fw-semibold position-relative round-oval">
                                Kirim Ke Inbox
                                <span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon">
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-4 contact-kui-bottom-row">
            <div class="col-xl-8">
                <div class="contact-kui-map-card h-100">
                    <div class="contact-kui-section-head">
                        <div>
                            <span class="contact-kui-eyebrow">LOKASI KAMPUS</span>
                            <h3 class="font-secondary fw-medium mb-0">Temukan Kantor Urusan Internasional Universitas Juanda</h3>
                        </div>
                    </div>

                    <div class="contact-kui-map-frame">
                        @if(!empty($contactPage['contact_page_map_embed_url']))
                            <iframe
                                src="{{ $contactPage['contact_page_map_embed_url'] }}"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @else
                            <div class="contact-kui-map-placeholder">
                                <span class="contact-kui-placeholder-badge">KUI UNIDA</span>
                                <h3 class="font-secondary fw-medium mb-3">Lokasi peta belum ditambahkan</h3>
                                <p class="mb-0">
                                    Silakan isi pengaturan peta di dashboard setting agar pengunjung dapat langsung menemukan lokasi kantor KUI.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="contact-kui-side-card h-100">
                    <div class="contact-kui-section-head">
                        <div>
                            <span class="contact-kui-eyebrow">PANDUAN KONTAK</span>
                            <h3 class="font-secondary fw-medium mb-0">Cara tercepat menghubungi KUI</h3>
                        </div>
                    </div>

                    <div class="contact-kui-guide-list">
                        <div class="contact-kui-guide-item">
                            <span>01</span>
                            <div>
                                <strong>Gunakan email resmi</strong>
                                <p class="mb-0">Cocok untuk surat pengantar, proposal kerja sama, dan kebutuhan dokumen formal.</p>
                            </div>
                        </div>
                        <div class="contact-kui-guide-item">
                            <span>02</span>
                            <div>
                                <strong>Kirim inbox dari website</strong>
                                <p class="mb-0">Ideal untuk konsultasi awal, pertanyaan program, atau pengantar kebutuhan koordinasi.</p>
                            </div>
                        </div>
                        <div class="contact-kui-guide-item">
                            <span>03</span>
                            <div>
                                <strong>Datang saat jam layanan</strong>
                                <p class="mb-0">Untuk koordinasi langsung dengan tim KUI pada jam operasional yang tersedia.</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-kui-inline-meta">
                        <div>
                            <small>Respon layanan</small>
                            <strong>{{ $contactPage['contact_page_hours_value'] ?? 'Senin - Jumat, 08.00 - 16.00 WIB' }}</strong>
                        </div>
                        <a href="{{ route('about-marketing') }}" class="contact-kui-text-link">
                            Tentang KUI
                            <i class="ri-arrow-right-up-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .contact-kui-breadcrumb {
        padding: 110px 0 82px;
    }

    .contact-kui-lead {
        max-width: 860px;
        font-size: 18px;
        line-height: 1.85;
    }

    .contact-kui-section {
        padding: 120px 0 110px;
    }

    .contact-kui-info-card,
    .contact-kui-form-card,
    .contact-kui-map-card,
    .contact-kui-side-card {
        height: 100%;
        border-radius: 28px;
        background: #fff;
        border: 1px solid #edf0f6;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
    }

    .contact-kui-info-card {
        padding: 36px;
        background:
            radial-gradient(circle at top right, rgba(217, 255, 49, 0.22), transparent 28%),
            linear-gradient(160deg, #141834 0%, #1a2052 100%);
        color: #fff;
        border-color: rgba(255, 255, 255, 0.08);
    }

    .contact-kui-form-card,
    .contact-kui-map-card,
    .contact-kui-side-card {
        padding: 36px;
    }

    .contact-kui-card-head {
        margin-bottom: 30px;
    }

    .contact-kui-card-head--compact {
        margin-bottom: 26px;
    }

    .contact-kui-copy {
        line-height: 1.8;
        opacity: 0.9;
    }

    .contact-kui-contact-grid {
        display: grid;
        gap: 14px;
        margin-bottom: 28px;
    }

    .contact-kui-contact-tile {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 18px 18px 20px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .contact-kui-contact-tile small {
        display: inline-block;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .contact-kui-contact-tile h3 {
        color: #fff;
        font-size: 18px;
        margin-bottom: 6px;
    }

    .contact-kui-contact-tile p,
    .contact-kui-contact-tile a {
        color: rgba(255, 255, 255, 0.88);
        line-height: 1.75;
    }

    .contact-kui-tile-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(217, 255, 49, 0.16);
        color: #d9ff31;
        font-size: 22px;
    }

    .contact-kui-social-wrap {
        padding-top: 28px;
        border-top: 1px solid rgba(255, 255, 255, 0.12);
    }

    .contact-kui-eyebrow {
        display: inline-flex;
        margin-bottom: 16px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--primaryColor);
    }

    .contact-kui-social-list {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
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

    .contact-kui-meta-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        border-radius: 999px;
        background: #f4f6fb;
        color: #344054;
        font-size: 13px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .contact-kui-meta-pill i {
        color: var(--primaryColor);
        font-size: 18px;
    }

    .contact-kui-alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 22px;
        padding: 16px 18px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.75;
    }

    .contact-kui-alert i {
        margin-top: 1px;
        font-size: 18px;
        flex-shrink: 0;
    }

    .contact-kui-alert--success {
        background: rgba(16, 185, 129, 0.12);
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .contact-kui-alert--error {
        background: rgba(239, 68, 68, 0.1);
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.18);
    }

    .contact-kui-form {
        position: relative;
    }

    .contact-kui-label {
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 700;
        color: #111827;
    }

    .contact-kui-input {
        min-height: 56px;
        border-radius: 16px;
        border: 1px solid #dce3f0;
        padding: 14px 18px;
        box-shadow: none;
    }

    .contact-kui-input:focus {
        border-color: rgba(93, 95, 239, 0.35);
        box-shadow: 0 0 0 4px rgba(93, 95, 239, 0.08);
    }

    .contact-kui-textarea {
        min-height: 190px;
        resize: vertical;
    }

    .contact-kui-form-foot {
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid #edf0f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .contact-kui-form-note {
        color: #667085;
        font-size: 13px;
        line-height: 1.8;
        max-width: 420px;
    }

    .contact-kui-honeypot {
        position: absolute;
        left: -9999px;
        opacity: 0;
        pointer-events: none;
    }

    .contact-kui-bottom-row {
        margin-top: 18px;
    }

    .contact-kui-section-head {
        margin-bottom: 22px;
    }

    .contact-kui-map-frame {
        min-height: 420px;
        overflow: hidden;
        border-radius: 22px;
        background: #f8f9fd;
        border: 1px solid #edf0f6;
    }

    .contact-kui-map-frame iframe {
        display: block;
        min-height: 420px;
    }

    .contact-kui-map-placeholder {
        min-height: 420px;
        padding: 40px;
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

    .contact-kui-guide-list {
        display: grid;
        gap: 16px;
    }

    .contact-kui-guide-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 18px 0;
        border-top: 1px solid #edf0f6;
    }

    .contact-kui-guide-item:first-child {
        padding-top: 0;
        border-top: 0;
    }

    .contact-kui-guide-item span {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(93, 95, 239, 0.1);
        color: var(--primaryColor);
        font-weight: 700;
        flex-shrink: 0;
    }

    .contact-kui-guide-item strong {
        display: block;
        margin-bottom: 6px;
        color: #111827;
    }

    .contact-kui-guide-item p {
        color: #667085;
        line-height: 1.8;
    }

    .contact-kui-inline-meta {
        margin-top: 26px;
        padding-top: 22px;
        border-top: 1px solid #edf0f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .contact-kui-inline-meta small {
        display: block;
        margin-bottom: 4px;
        color: #98a2b3;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .contact-kui-inline-meta strong {
        color: #111827;
    }

    .contact-kui-text-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primaryColor);
        font-weight: 600;
    }

    @media (max-width: 1199px) {
        .contact-kui-form-foot,
        .contact-kui-inline-meta {
            flex-direction: column;
            align-items: flex-start;
        }

        .contact-kui-meta-pill {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 991px) {
        .contact-kui-breadcrumb {
            padding: 90px 0 70px;
        }

        .contact-kui-section {
            padding: 90px 0;
        }

        .contact-kui-info-card,
        .contact-kui-form-card,
        .contact-kui-map-card,
        .contact-kui-side-card {
            padding: 28px;
            border-radius: 24px;
        }

        .contact-kui-map-frame,
        .contact-kui-map-frame iframe,
        .contact-kui-map-placeholder {
            min-height: 340px;
        }
    }

    @media (max-width: 767px) {
        .contact-kui-lead {
            font-size: 16px;
        }

        .contact-kui-contact-tile {
            padding: 16px;
        }

        .contact-kui-form-foot {
            margin-top: 24px;
            padding-top: 20px;
        }
    }
</style>
@endpush

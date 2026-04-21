@php
    $brandSettings = $marketingBrandSettings ?? [];
    $contactButton = $marketingContactButton ?? [];
    $baseLogo = $brandSettings['site_logo'] ?? '/assets/logo/unida.png';
    $lightLogo = $brandSettings['site_logo_light'] ?? $baseLogo;
    $darkLogo = $brandSettings['site_logo_dark'] ?? $lightLogo;
    $contactUrl = $contactButton['primary_contact_button_url'] ?? route('contact-marketing');
    $contactText = $contactButton['primary_contact_button_text'] ?? 'Get In Touch';
@endphp

<div class="navbar-area style-two position-relative" id="navbar">
    <div class="container-fluid">
        <div class="navbar-wrapper d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ $lightLogo }}" alt="{{ config('app.name') }} Logo" class="logo-light">
                <img src="{{ $darkLogo }}" alt="{{ config('app.name') }} Logo" class="logo-dark">
            </a>
            <div class="menu-area mx-auto">
                <div class="overlay"></div>
                <nav class="menu">
                    <div class="menu-mobile-header">
                        <button type="button" class="menu-mobile-arrow bg-transparent border-0"><i class="ri-arrow-left-s-line"></i></button>
                    <div class="menu-mobile-title"></div>
                    <button type="button" class="menu-mobile-close bg-transparent border-0"><i class="ri-close-line"></i></button>
                    </div>
                    <ul class="menu-section p-0 mb-0 lh-1">
                        @foreach($marketingNavbarItems ?? [] as $item)
                            @include('components.layout.marketing.navigation-item', ['item' => $item, 'isRoot' => true])
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="option-item ms-3">
                <div class="dropdown language-switcher">
                    <button class="bg-transparent border-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <img 
                            src="https://flagcdn.com/w20/{{ app()->getLocale() == 'id' ? 'id' : (app()->getLocale() == 'ar' ? 'sa' : 'us') }}.png"
                            width="20"
                            class="me-2"
                        >

                        <span class="fw-semibold">{{ strtoupper(app()->getLocale()) }}</span>

                        <i class="ri-arrow-down-s-fill ms-1"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end border-0">
                        <li>
                            <a href="{{ route('language.switch', 'id') }}" class="dropdown-item">🇮🇩 Indonesia</a>
                        </li>
                        <li>
                            <a href="{{ route('language.switch', 'en') }}" class="dropdown-item">🇺🇸 English</a>
                        </li>
                        <li>
                            <a href="{{ route('language.switch', 'ar') }}" class="dropdown-item">🇸🇦 العربية</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="other-options d-flex flex-wrap align-items-center justify-content-end">
                <div class="option-item d-lg-none">
                    <button type="button" class="menu-mobile-trigger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

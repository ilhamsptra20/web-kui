<div class="navbar-area style-two position-relative" id="navbar">
    <div class="container-fluid">
        <div class="navbar-wrapper d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('assets/logo/unida.png') }}" alt="Logo" class="logo-light">
                <img src="{{ asset('assets/logo/unida.png') }}" alt="Logo" class="logo-dark">
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
                        <li class="menu-item-has-children">
                            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">{{ __('nav.home') }}</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('about-marketing') }}" class="{{ request()->routeIs('about-marketing') ? 'active' : '' }}">{{ __('nav.about') }}</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('events-marketing') }}" class="{{ request()->routeIs('events-marketing') ? 'active' : '' }}">{{ __('nav.events') }}</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('announcements-marketing') }}" class="{{ request()->routeIs('announcements-marketing') ? 'active' : '' }}">{{ __('nav.announcements') }}</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('gallery-marketing') }}" class="{{ request()->routeIs('gallery-marketing') ? 'active' : '' }}">{{ __('nav.gallery') }}</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('articles-marketing') }}" class="{{ request()->routeIs('articles-marketing') ? 'active' : '' }}">{{ __('nav.articles') }}</a>
                        </li>
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
                <div class="option-item">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="mobile-options position-relative d-lg-none me-3">
                            <button class="dropdown-toggle  text-center bg-transparent border-0 p-0 transition" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="ri-more-fill"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-centered mobile-option-list top-1 border-0" data-bs-popper="static">
                                <a href="{{ route('contact-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">Get In Touch<span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon"></span></a>
                            </div>
                        </div>
                        <button  class="search-btn bg-transparent border-0 d-flex flex-wrap align-items-center dropdown-toggle text-center p-0 transition" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                <img src="{{ asset('assets/marketing/img/icons/search.svg') }}" alt="Search Icon">
                        </button>
                        <div class="search-dropdown dropdown-menu dropdown-menu-right top-1 border-0" data-bs-popper="static">
                                <form class="search-popup position-relative" action="#">
                                <input type="search" class="form-control text-para" placeholder="Search Here....">
                                <button type="submit" class="position-absolute top-0 end-0 h-100 border-0 bg-transparent d-flex flex-column align-items-center justify-content-center"><i class="ri-search-2-line"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="option-item d-lg-block d-none">
                    <a href="{{ route('contact-marketing') }}" class="btn style-three fw-semibold position-relative round-oval">Get In Touch<span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon"></span></a>
                </div>
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

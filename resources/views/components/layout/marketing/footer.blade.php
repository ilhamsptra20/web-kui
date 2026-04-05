@php
    $footerBrand = $marketingFooterBrand ?? [];
    $footerContent = $marketingFooterContent ?? [];
    $footerLogo = $footerBrand['footer_logo'] ?? ($footerBrand['site_logo'] ?? '/assets/logo/unida.png');
    $footerAddress = $footerContent['footer_address'] ?? '952 Bad Hill St, Asheville, NC 28803, USA';
    $footerEmail = $footerContent['footer_email'] ?? 'contact@aixio.com';
    $footerPhone = $footerContent['footer_phone'] ?? '+96 76867 8869';
    $newsletterTitle = $footerContent['footer_newsletter_title'] ?? 'Subscribe To Our Newsletter';
    $newsletterPlaceholder = $footerContent['footer_newsletter_placeholder'] ?? 'Enter Your Email';
    $footerCopyright = $footerContent['footer_copyright'] ?? 'Copyright © 2026 Nabila Maulidia. All Rights Reserved.';
    $socialLinks = $marketingSocialLinks ?? [];
@endphp

<footer class="footer-area style-one bg-black position-relative z-1 pt-130">
    <div class="container style-one">
        <div class="row justify-content-center mb-40">
            <div class="col-lg-2 col-md-6" data-cue="slideInUp">
                <div class="footer-widget mb-30">
                    <a href="{{ url('/') }}" class="logo"><img src="{{ $footerLogo }}" alt="{{ config('app.name') }} Logo"></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget mb-30 ps-xxl-5 ms-xxl-1" data-cue="slideInUp">
                    <h3 class="footer-widget-title text-white fs-18 fw-semibold">{{ __('nav.quick_links') }}</h3>
                    <ul class="footer-menu list-unstyled mb-0">
                        @foreach($marketingFooterItems ?? [] as $item)
                            <li>
                                <a href="{{ $item['url'] ?? '#' }}" @if(($item['target'] ?? '_self') === '_blank') target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $item['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 ps-xxl-0 pe-xxl-5 pe-lg-4" data-cue="slideInUp">
                <div class="footer-widget mb-30">
                    <h3 class="footer-widget-title text-white fs-18 fw-semibold">Address</h3>
                    <ul class="contact-info list-unstyled mb-0">
                        <li class="position-relative">
                            <img src="{{ asset('assets/marketing/img/icons/pin-small.svg') }}" alt="Icon">
                            <span class="text-white fw-medium">Address :</span> {{ $footerAddress }}
                        </li>
                        <li class="position-relative">
                            <img src="{{ asset('assets/marketing/img/icons/mail-small.svg') }}" alt="Icon">
                            <span class="text-white fw-medium d-block">Email :</span>
                            <a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a>
                        </li>
                        <li class="position-relative">
                            <img src="{{ asset('assets/marketing/img/icons/phone-small.svg') }}" alt="Icon">
                            <span class="text-white fw-medium d-block">Phone :</span> 
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}">{{ $footerPhone }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 ps-xxl-4 pe-xxl-1" data-cue="slideInUp">
                <div class="footer-widget mb-30">
                    <h3 class="text-white fs-20 font-secondary fw-medium mb-12">{{ $newsletterTitle }}</h3>
                    <form action="#" class="newsletter-form position-relative">
                        <input type="email" class="fs-15 w-100 bg-transparent text-white outline-0" placeholder="{{ $newsletterPlaceholder }}">
                        <button class="position-absolute bg-transparent border-0 end-0"><img src="{{ asset('assets/marketing/img/icons/plane-small.svg') }}" alt="Icon"></button>
                    </form>
                    <div class="post-share d-flex flex-wrap align-items-center">
                        <span class="text-white fw-medium me-2">Follow Us :</span>
                        <ul class="social-profile style-one list-unstyled mb-0">
                            @foreach($socialLinks as $socialLink)
                                <li>
                                    <a href="{{ $socialLink['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" title="{{ $socialLink['title'] ?? 'Social Media' }}" class="d-flex flex-column align-items-center justify-content-center rounded-circle">
                                        <i class="{{ $socialLink['icon'] ?? 'ri-global-line' }}"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom position-relative overflow-hidden z-1" data-cue="fadIn">
        <div class="container-fluid position-relative px-xxl-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-white mb-0">{{ $footerCopyright }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>

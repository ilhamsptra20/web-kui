<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    
<!-- Mirrored from templates.hibotheme.com/aixio/default/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Sep 2025 07:45:59 GMT -->
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Link of CSS files -->
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/scrollcue.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/remixicon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/marketing/css/dark-theme.css') }}">
        
        <title>{{ config('app.name') }}</title>
        <link rel="icon" type="image/png" href="{{ ($marketingLayoutSettings['favicon_logo'] ?? '/favicon.ico') }}">
        @stack('styles')
    </head>
    <body>

       <!--  Preloader Start -->
        <div class="preloader-area" id="preloader">
            <div class="spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <!--  Preloader End -->

        <!-- Theme Switcher Start -->
        <div class="switch-theme-mode">
            <label id="switch" class="switch">
                <input type="checkbox" onchange="toggleTheme()" id="slider">
                <span class="slider round"></span>
            </label>
        </div>
        <!-- Theme Switcher End -->

        <!-- Custom Cursor -->
        <div class="cursor"><span class="cursor-text"></span></div>
        <div class="cursor-inner"></div>

        <div id="smooth-wrapper">
            <div id="smooth-content">

                <!-- Navbar Start -->
                <x-layout.marketing.navbar />
                <!-- Navbar End -->

                @yield('content')

                <!-- Footer Section Start -->
                <x-layout.marketing.footer />
                <!-- Footer End -->

            </div>
        </div>
        <!-- Back to Top -->
        <div id="progress-wrap" class="progress-wrap style-one">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
              <path id="progress-path" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>

        <!-- Link of JS files -->
        <script data-cfasync="false" src="{{ asset('assets/marketing/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/megamenu.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/fslightbox.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/gsap.min.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/scrollTrigger.min.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/lenis.min.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/scrollToPlugin.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/SplitText.min.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/customEase.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/scrollcue.min.js') }}"></script>
        <script src="{{ asset('assets/marketing/js/main.js') }}"></script>
        @stack('scripts')
    </body>

<!-- Mirrored from templates.hibotheme.com/aixio/default/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Sep 2025 07:46:26 GMT -->
</html>

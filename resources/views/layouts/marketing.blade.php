<!DOCTYPE html>
<html lang="zxx">
    
<!-- Mirrored from templates.hibotheme.com/aixio/default/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Sep 2025 07:45:59 GMT -->
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
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
        
        <title>Aixio - Technology & AI Startup HTML Template</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/marketing/img/favicon.png') }}">
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
                <div class="navbar-area style-two position-relative" id="navbar">
                    <div class="container-fluid">
                        <div class="navbar-wrapper d-flex justify-content-between align-items-center">
                            <a href="index.html" class="navbar-brand">
                                <img src="{{ asset('assets/marketing/img/logo.png') }}" alt="Logo" class="logo-light">
                                <img src="{{ asset('assets/marketing/img/logo-white.png') }}" alt="Logo" class="logo-dark">
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
                                            <a href="/" class="active">Home<i class="ri-arrow-down-s-fill"></i></a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0)">Pages<i class="ri-arrow-down-s-fill"></i></a>
                                            <ul class="menu-subs menu-column-1">
                                                <li><a href="about">About Us</a></li>
                                                <li class="menu-item-has-children">
                                                    <a href="javascript:void(0)">Services<i class="ri-arrow-right-s-fill"></i></a>
                                                    <ul class="menu-subs menu-column-1">
                                                        <li><a href="services.html">Services</a></li>
                                                        <li><a href="service-details.html">Service Details</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href="javascript:void(0)">Careers<i class="ri-arrow-right-s-fill"></i></a>
                                                    <ul class="menu-subs menu-column-1">
                                                        <li><a href="careers.html">Careers</a></li>
                                                        <li><a href="career-single.html">Career Single</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="team.html">Team</a></li>
                                                <li><a href="testimonials.html">Testimonials</a></li>
                                                <li><a href="pricing-plan.html">Pricing Plan</a></li>
                                                <li><a href="faq.html">FAQ</a></li>
                                                <li><a href="terms-conditions.html">Terms & Conditions</a></li>
                                                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                                <li><a href="error-404.html">Error 404</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0)">Projects<i class="ri-arrow-down-s-fill"></i></a>
                                            <ul class="menu-subs menu-column-1">
                                                <li><a href="projects.html">Projects</a></li>
                                                <li><a href="project-single.html">Project Single</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0)">Shop<i class="ri-arrow-down-s-fill"></i></a>
                                            <ul class="menu-subs menu-column-1">
                                                <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                                <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                                <li><a href="shop-grid.html">Shop Grid</a></li>
                                                <li><a href="product-single.html">Product Single</a></li>
                                                <li><a href="cart.html">Cart</a></li>
                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="login.html">Login</a></li>
                                                <li><a href="register.html">Register</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0)">Blog<i class="ri-arrow-down-s-fill"></i></a>
                                            <ul class="menu-subs menu-column-1">
                                                <li class="menu-item-has-children"><a href="javascript:void(0)">Blog Layout<i class="ri-arrow-right-s-fill"></i></a>
                                                    <ul class="menu-subs menu-column-1">
                                                        <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                                        <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children"><a href="javascript:void(0)">Blog Single Layout<i class="ri-arrow-right-s-fill"></i></a>
                                                    <ul class="menu-subs menu-column-1">
                                                        <li><a href="blog-single-left-sidebar.html">Blog Single Left Sidebar</a></li>
                                                        <li><a href="blog-single-right-sidebar.html">Blog Single Right Sidebar</a></li>
                                                        <li><a href="blog-single-no-sidebar.html">Blog Single No Sidebar</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children"><a href="javascript:void(0)">Others<i class="ri-arrow-right-s-fill"></i></a>
                                                    <ul class="menu-subs menu-column-1">
                                                        <li><a href="posts-by-author.html">Posts By Author</a></li>
                                                        <li><a href="posts-by-date.html">Posts By Date</a></li>
                                                        <li><a href="posts-by-category.html">Posts By Category</a></li>
                                                        <li><a href="posts-by-tag.html">Posts By Tag</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="other-options d-flex flex-wrap align-items-center justify-content-end">
                                <div class="option-item">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="mobile-options position-relative d-lg-none me-3">
                                            <button class="dropdown-toggle  text-center bg-transparent border-0 p-0 transition" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                                <i class="ri-more-fill"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-centered mobile-option-list top-1 border-0" data-bs-popper="static">
                                                <a href="login.html" class="btn style-three fw-semibold position-relative round-oval">Get In Touch<span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon"></span></a>
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
                                    <a href="contact.html" class="btn style-three fw-semibold position-relative round-oval">Get In Touch<span class="position-absolute top-0 end-0 h-100 d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('assets/marketing/img/icons/right-arrow-white.svg') }}" alt="Icon"></span></a>
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
                <!-- Navbar End -->

                @yield('content')

                <!-- Footer Section Start -->
                <footer class="footer-area style-one bg-black position-relative z-1 pt-130">
                    <div class="container style-one">
                        <div class="row justify-content-center mb-40">
                            <div class="col-lg-2 col-md-6" data-cue="slideInUp">
                                <div class="footer-widget mb-30">
                                    <a href="index.html" class="logo"><img src="{{ asset('assets/marketing/img/logo-white.png') }}" alt="Logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-widget mb-30 ps-xxl-5 ms-xxl-1" data-cue="slideInUp">
                                    <h3 class="footer-widget-title text-white fs-18 fw-semibold">Quick Links</h3>
                                    <ul class="footer-menu list-unstyled mb-0">
                                        <li><a href="about-us.html">Features</a></li>
                                        <li><a href="about-us.html">About</a></li>
                                        <li><a href="testimonials.html">Testimonials</a></li>
                                        <li><a href="pricing-plan.html">Pricing</a></li>
                                        <li><a href="blog-right-sidebar.html">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 ps-xxl-0 pe-xxl-5 pe-lg-4" data-cue="slideInUp">
                                <div class="footer-widget mb-30">
                                    <h3 class="footer-widget-title text-white fs-18 fw-semibold">Address</h3>
                                    <ul class="contact-info list-unstyled mb-0">
                                        <li class="position-relative">
                                            <img src="{{ asset('assets/marketing/img/icons/pin-small.svg') }}" alt="Icon">
                                            <span class="text-white fw-medium">Address :</span> 952 Bad Hill St, Asheville, NC 28803, USA
                                        </li>
                                        <li class="position-relative">
                                            <img src="{{ asset('assets/marketing/img/icons/mail-small.svg') }}" alt="Icon">
                                            <span class="text-white fw-medium d-block">Email :</span>
                                            <a href="https://templates.hibotheme.com/cdn-cgi/l/email-protection#34575b5a4055574074555d4c5d5b1a575b59"><span class="__cf_email__" data-cfemail="c5a6aaabb1a4a6b185a4acbdacaaeba6aaa8">[email&#160;protected]</span></a>
                                        </li>
                                        <li class="position-relative">
                                            <img src="{{ asset('assets/marketing/img/icons/phone-small.svg') }}" alt="Icon">
                                            <span class="text-white fw-medium d-block">Phone :</span> 
                                            <a href="tel:96768678869">+96 76867 8869</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 ps-xxl-4 pe-xxl-1" data-cue="slideInUp">
                                <div class="footer-widget mb-30">
                                    <h3 class="text-white fs-20 font-secondary fw-medium mb-12">Subscribe To Our Newsletter</h3>
                                    <form action="#" class="newsletter-form position-relative">
                                        <input type="email" class="fs-15 w-100 bg-transparent text-white outline-0" placeholder="Enter Your Email">
                                        <button class="position-absolute bg-transparent border-0 end-0"><img src="{{ asset('assets/marketing/img/icons/plane-small.svg') }}" alt="Icon"></button>
                                    </form>
                                    <div class="post-share d-flex flex-wrap align-items-center">
                                        <span class="text-white fw-medium me-2">Follow Us :</span>
                                        <ul class="social-profile style-one list-unstyled mb-0">
                                            <li><a href="https://www.facebook.com/" target="_blank" class="d-flex flex-column align-items-center justify-content-center rounded-circle"><i class="ri-facebook-fill"></i></a></li>
                                            <li><a href="https://x.com/?lang=en" target="_blank" class="d-flex flex-column align-items-center justify-content-center rounded-circle"><i class="ri-twitter-x-line"></i></a></li>
                                            <li><a href="https://www.instagram.com/" target="_blank" class="d-flex flex-column align-items-center justify-content-center rounded-circle"><i class="ri-instagram-line"></i></a></li>
                                            <li><a href="https://www.linkedin.com/" target="_blank" class="d-flex flex-column align-items-center justify-content-center rounded-circle"><i class="ri-linkedin-fill"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom position-relative overflow-hidden z-1" data-cue="fadIn">
                        <div class="container-fluid position-relative px-xxl-4">
                            <img src="{{ asset('assets/marketing/img/logo-large.png') }}" alt="Logo">
                            <p class="copyright-text position-absolute bg_primary round-oval d-inline-block text-white text-center mb-0" ><i class="ri-copyright-line"></i><span class="text_secondary fw-semibold">Aixio </span> is Proudly Owned by <a href="https://hibotheme.com/" target="_blank" class="link style-one fw-semibold">HiboTheme</a></p>
                        </div>
                    </div>
                </footer>
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
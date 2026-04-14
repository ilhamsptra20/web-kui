<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    @php
        $sidebarLogo = $adminBrandSettings['sidebar_logo'] ?? '/assets/logo/unida.png';
    @endphp

    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ Route::has('dashboard') ? route('dashboard') : url('/') }}">
                    <span class="brand-logo d-inline-flex align-items-center justify-content-center" style="background: none;">
                        <img src="{{ $sidebarLogo }}" alt="{{ config('app.name', 'KUI UNIDA') }} Logo" style="width: 38px; height: 38px; object-fit: contain;">
                    </span>
                    <h2 class="brand-text mb-0">{{ config('app.name', 'KUI UNIDA') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @foreach($adminSidebarItems ?? config('navigator.sidebar', []) as $menu)
                @if(isset($menu['header']))
                    <li class="navigation-header"><span>{{ $menu['header'] }}</span></li>
                @else
                    @include('partials.menu-item', ['item' => $menu])
                @endif
            @endforeach
        </ul>
    </div>
</div>

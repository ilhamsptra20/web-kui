@php
    $hasSubmenu = isset($item['submenu']) && count($item['submenu']) > 0;
    $routeName = $item['route_name'] ?? null;
    $rawUrl = $item['url'] ?? '#';

    if ($routeName && Route::has($routeName)) {
        try {
            $rawUrl = route($routeName, [], false);
        } catch (\Throwable) {
            $rawUrl = $item['url'] ?? '#';
        }
    }
    $isExternal = str_starts_with($rawUrl, 'http://') || str_starts_with($rawUrl, 'https://');
    $isSpecial = str_starts_with($rawUrl, '//') || str_starts_with($rawUrl, 'mailto:') || str_starts_with($rawUrl, 'tel:');
    $isAnchor = str_starts_with($rawUrl, '#');
    $href = $isExternal || $isSpecial || $isAnchor || $rawUrl === '#' ? $rawUrl : url($rawUrl);
    $normalized = trim(parse_url($rawUrl, PHP_URL_PATH) ?: '', '/');
    $isRoot = $normalized === '';
    $childActive = collect($item['submenu'] ?? [])->contains(function (array $child): bool {
        $routeName = $child['route_name'] ?? null;

        if ($routeName && Route::has($routeName) && request()->routeIs($routeName)) {
            return true;
        }

        $url = trim(parse_url($child['url'] ?? '', PHP_URL_PATH) ?: '', '/');

        return $url === '' ? request()->url() === url('/') : request()->is($url . '*');
    });
    $isActive = $routeName && Route::has($routeName) ? request()->routeIs($routeName) : ($isRoot ? request()->url() === url('/') : request()->is($normalized . '*'));
    $isActive = $isActive || $childActive;
@endphp

<li class="nav-item {{ $hasSubmenu ? 'has-sub' : '' }} {{ $isActive ? 'active' : '' }}">
    <a href="{{ $hasSubmenu ? '#' : $href }}" @if(($item['target'] ?? '_self') === '_blank') target="_blank" rel="noopener noreferrer" @endif>
        <i class="{{ $item['icon'] ?? 'feather icon-circle' }}"></i>
        <span class="menu-title">{{ $item['title'] }}</span>
        
        @if(isset($item['badge']))
            <span class="badge badge-pill {{ $item['badge']['class'] }} float-right mr-2">
                {{ $item['badge']['text'] }}
            </span>
        @endif
    </a>

    @if($hasSubmenu)
        <ul class="menu-content">
            @foreach($item['submenu'] as $sub)
                {{-- Rekursif: Panggil partial ini lagi --}}
                @include('partials.menu-item', ['item' => $sub])
            @endforeach
        </ul>
    @endif
</li>

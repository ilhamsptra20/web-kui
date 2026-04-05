@php
    $isRoot = $isRoot ?? false;
    $children = $item['children'] ?? [];
    $hasChildren = count($children) > 0;
    $url = $item['url'] ?? '#';

    $isActive = false;

    if (($item['route_name'] ?? null)) {
        $isActive = request()->routeIs($item['route_name']);
    } elseif ($url === '/') {
        $isActive = request()->url() === url('/');
    } elseif (str_starts_with($url, '/')) {
        $pattern = trim($url, '/') . '*';
        $isActive = request()->is($pattern);
    }
@endphp

<li class="{{ $isRoot ? 'menu-item-has-children' : '' }} {{ $hasChildren ? 'menu-item-has-children' : '' }}">
    <a href="{{ $url }}" class="{{ $isActive ? 'active' : '' }}" @if(($item['target'] ?? '_self') === '_blank') target="_blank" rel="noopener noreferrer" @endif>
        {{ $item['title'] }}
    </a>

    @if($hasChildren)
        <ul class="menu-subs menu-column menu-dropdown list-unstyled">
            @foreach($children as $child)
                @include('components.layout.marketing.navigation-item', ['item' => $child, 'isRoot' => false])
            @endforeach
        </ul>
    @endif
</li>

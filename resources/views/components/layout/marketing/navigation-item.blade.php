@php
    $isRoot = $isRoot ?? false;
    $children = $item['children'] ?? [];
    $hasChildren = count($children) > 0;
    $url = $item['url'] ?? '#';

    $isItemActive = function (array $candidate) use (&$isItemActive): bool {
        $candidateUrl = $candidate['url'] ?? '#';

        if (($candidate['route_name'] ?? null) && request()->routeIs($candidate['route_name'])) {
            return true;
        }

        if ($candidateUrl === '/' && request()->url() === url('/')) {
            return true;
        }

        if (str_starts_with($candidateUrl, '/')) {
            $pattern = trim($candidateUrl, '/') . '*';

            if (request()->is($pattern)) {
                return true;
            }
        }

        foreach ($candidate['children'] ?? [] as $child) {
            if ($isItemActive($child)) {
                return true;
            }
        }

        return false;
    };

    $isActive = $isItemActive($item);
@endphp

<li class="{{ $isRoot ? 'marketing-nav-root' : 'marketing-nav-child' }} {{ $hasChildren ? 'menu-item-has-children marketing-nav-has-dropdown' : '' }}">
    <a href="{{ $url }}" class="{{ $isActive ? 'active' : '' }}" @if($hasChildren) aria-haspopup="true" aria-expanded="false" @endif @if(($item['target'] ?? '_self') === '_blank') target="_blank" rel="noopener noreferrer" @endif>{{ $item['title'] }}@if($hasChildren)<i class="ri-arrow-down-s-line marketing-nav-caret"></i>@endif</a>

    @if($hasChildren)
        <ul class="menu-subs menu-column menu-dropdown marketing-nav-dropdown list-unstyled">
            @foreach($children as $child)
                @include('components.layout.marketing.navigation-item', ['item' => $child, 'isRoot' => false])
            @endforeach
        </ul>
    @endif
</li>

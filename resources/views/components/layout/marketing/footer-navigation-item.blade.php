@php
    $children = $item['children'] ?? [];
    $hasChildren = count($children) > 0;
@endphp

<li>
    <a href="{{ $item['url'] ?? '#' }}" @if(($item['target'] ?? '_self') === '_blank') target="_blank" rel="noopener noreferrer" @endif>
        {{ $item['title'] ?? '-' }}
    </a>

    @if($hasChildren)
        <ul class="footer-submenu list-unstyled mb-0 mt-1 ps-3">
            @foreach($children as $child)
                @include('components.layout.marketing.footer-navigation-item', ['item' => $child])
            @endforeach
        </ul>
    @endif
</li>

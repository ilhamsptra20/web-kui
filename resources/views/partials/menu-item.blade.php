@php
    $hasSubmenu = isset($item['submenu']) && count($item['submenu']) > 0;
    $isActive = request()->is(trim($item['url'], '/').'*');
@endphp

<li class="nav-item {{ $hasSubmenu ? 'has-sub' : '' }} {{ $isActive ? 'active' : '' }}">
    <a href="{{ $hasSubmenu ? '#' : url($item['url']) }}">
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
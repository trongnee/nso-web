<li class="{{ $item_classes }}">
    <a href="{{ $url }}" class="menu-link {{ isset($children) ? 'menu-toggle' : '' }}">
        @if (isset($icon) && !$is_sub)
            <i class="menu-icon tf-icons ti {{ $icon }}"></i>
        @endif

        <div data-i18n="{{ $label }}">{{ $label }}</div>
    </a>

    @if (isset($children))
        <ul class="menu-sub">
            {{ NSO\Backend\Theme\Menu::render($children) }}
        </ul>
    @endif
</li>

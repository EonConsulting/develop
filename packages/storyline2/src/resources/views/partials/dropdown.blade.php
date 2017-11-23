<li{!! (isset($item['children']) ? ' class="dropdown-submenu"' : '') !!}>
    <a {!! (isset($item['children']) ? 'tabindex="-1"' : '') !!} href="#" class="dropdown-btn" data-parent-id="{{ $item['parent_id'] }}" data-item-id="{{ $item['id'] }}" data-prev-id="{{ $item['prev'] }}" data-next-id="{{ $item['next'] }}">{{ $item['text'] }}</a>

    @if(isset($item['children']))
    <ul class="dropdown-menu">
        @each('eon.storyline2::partials.dropdown', $item['children'], 'item')
    </ul>
    @endif
</li>
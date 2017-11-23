<li{!! (isset($item['children']) ? ' class="dropdown-submenu"' : '') !!}>
    <a
        {!! (isset($item['children']) ? 'tabindex="-1"' : '') !!}
        href="#" class="dropdown-btn {{ empty($item['required'])? '' :'in-active'}}"
        {!! (empty($item['required'])? '' :'data-toggle="tooltip" data-placement="right" title="disabled"') !!}
        req="{{ empty($item['required'])? 'null' :'in-active' }}"
        data-parent-id="{{ $item['parent_id'] }}"
        data-item-id="{{ $item['id'] }}"
        data-prev-id="{{ $item['prev'] }}"
        data-next-id="{{ $item['next'] }}"
    >
        {!! (empty($item['required'])? $item['text'] : '<strike>'.$item['text'].'</strike>') !!}
    </a>

    @if(isset($item['children']))
    <ul class="dropdown-menu">
        @each('eon.storyline2::partials.dropdown', $item['children'], 'item')
    </ul>
    @endif
</li>

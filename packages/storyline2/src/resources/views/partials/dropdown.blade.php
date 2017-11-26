<li{!! (isset($item['children']) ? ' class="dropdown-submenu"' : '') !!}>
    <a
        {!! (isset($item['children']) ? 'tabindex="-1"' : '') !!}
        href="#" class="dropdown-btn {{ (!empty($item['required']) && $item['student_progress'] !== auth()->user()->id)? 'in-active' :''}}"
        {!! (empty($item['required'] && $item['student_progress'] !== auth()->user()->id)? '' :'data-toggle="tooltip" data-placement="right" title="disabled"') !!}
        req="{{ empty($item['required'])? 'null' :'' }}"
        data-parent-id="{{ $item['parent_id'] }}"
        data-item-id="{{ $item['id'] }}"
        data-prev-id="{{ $item['prev'] }}"
        data-next-id="{{ $item['next'] }}"
    >
       {!! (!empty($item['required']) && $item['student_progress'] !== auth()->user()->id)? '<strike>'.$item['text'].'</strike>' : $item['text'] !!}
    </a>

    @if(isset($item['children']))
    <ul class="dropdown-menu">
        @each('eon.storyline2::partials.dropdown', $item['children'], 'item')
    </ul>
    @endif
</li>

<li>
    <span class="toggle-expand pull-left">
    @if(isset($item['children']))
        <i class="fa fa-caret-right"></i>
    @endif
    </span>
    
    <span>{{ $item['num'] }}</span>

    <span>
        <a
            {!! (isset($item['children']) ? 'tabindex="-1"' : '') !!}
            href="#"
            class="menu-btn {{ (!empty($item['required']) && $item['student_progress'] !== auth()->user()->id)? 'in-active' :''}}"
            {!! (empty($item['required'] && $item['student_progress'] !== auth()->user()->id)? '' :'data-toggle="tooltip" data-placement="right" title="disabled"') !!}
            req="{{ empty($item['required'])? 'null' :'' }}"
            data-parent-id="{{ $item['parent_id'] }}"
            data-item-id="{{ $item['id'] }}"
            data-prev-id="{{ $item['prev'] }}"
            data-next-id="{{ $item['next'] }}"
        >
            {!! (!empty($item['required']) && $item['student_progress'] !== auth()->user()->id)? '<strike>'.$item['text'].'</strike>' : $item['text'] !!}
        </a>
    </span>

    @if(isset($item['children']))
    <ul>
    @each('eon.storyline2::partials.items', $item['children'], 'item')
    </ul>
    @endif
</li>
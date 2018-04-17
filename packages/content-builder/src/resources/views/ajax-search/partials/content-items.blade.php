@foreach($content_items as $content)
    <div class="content-entry shadow">
        <h3>{{ $content->title }}</h3>
        <p>{{ $content->description }}</p>
        @if( ! $is_content_builder)
            <button class="content-link-btn content-action" data-action="link" data-content-id="{{ $content->id }}">Link</button>
        @endif
        <button class="content-copy-btn content-action" data-action="copy" data-content-id="{{ $content->id }}">Copy</button>
    </div>
@endforeach
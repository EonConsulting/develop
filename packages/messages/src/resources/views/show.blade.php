<div style="text-align: left;">
    <div>
        <div>
            {{ array_get($message->data, 'subject') }}

            @if($message->read_at == null)
                <b>(New Message)</b>
            @endif

            <span class="pull-right">
                <b>Sent at:</b> {{ $message->created_at->format('d M Y H:i') }}
                @if($message->read_at != null)
                    <br/>
                    <b>Read at:</b> {{ $message->read_at->format('d M Y H:i') }}
                @endif
            </span>
        </div>
        <hr/>
        <br>
        <div>
            {!! array_get($message->data, 'message') !!}
        </div>
    </div>
</div>
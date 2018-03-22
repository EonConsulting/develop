<div>

    {{ $message['message'] }}

    <br/><br/>

    @if(array_has($message, 'debugging'))

        <h4>PHP debugging</h4>

        <pre>{!! $message['debugging'] !!} </pre>

    @endif

</div>
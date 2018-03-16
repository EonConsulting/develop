@component('mail::message')

    <h3>{{ $message['title'] }}</h3>
    <br/><br/>

    {{ $message['message'] }}

    <br/><br/>

    @if(array_has($message, 'debugging'))

    <h4>PHP debugging</h4>

    {{ $message['debugging'] }}

    @endif

    Thanks,
    {{ config('app.name') }}
@endcomponent
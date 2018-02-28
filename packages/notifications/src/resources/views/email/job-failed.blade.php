@component('mail::message')

    <h3>{{ $message['title'] }}</h3>
    <br/><br/>

    {{ $message['message'] }}

    <br/><br/>

    <h4>PHP debugging</h4>

    {{ $message['debugging'] }}

    Thanks,
    {{ config('app.name') }}
@endcomponent
@component('mail::message')

    Dear {{ $user->name }},

    You've recently done a tao assessment and you scored [{{ $tao_result }}]

    Thanks,
    {{ config('app.name') }}
@endcomponent
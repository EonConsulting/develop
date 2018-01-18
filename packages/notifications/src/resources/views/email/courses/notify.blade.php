@component('mail::message')

    Course: {{ $course->title }}

    {{ $message }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
@component('mail::message')
# Introduction

Email: {{ $user->email  }}

Course: {{ $course->title }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
@extends('layouts.lecturer')

@section('site-title')
    Storyline Builder
@endsection

@section('custom-styles')

@endsection

@section('body-class')

@endsection

@section('mini-logo-title')
    Unisa
@endsection

@section('logo-title')
    Unisa
@endsection

@section('page-title')
    Storyline Builder <span style="font-size:13px;">{{ $course->title }}</span>
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.css" />
    <div class="col-md-12">
        @if (session('error_message'))
            <div class="alert alert-danger">
                {{ session('error_message') }}
            </div>
        @endif

        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        @if($errors->count() > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
    </div>
    <storyline-builder></storyline-builder>
    <div id="root" class="container">
        <progress-view inline-template>
        <div>
        <p>Hello Progres is : <% completionRate %></p>
        <p><button @click="completionRate += 10">Update Completetion Rate</button></p>
        <div>
        </progress-view>
    </div>
    <storyline-builder :courseid="{{ $course->id }}"></storyline-builder>
@endsection

@section('app-js')
    <script src="https://unpkg.com/vue"></script>
    <script src="{{url('/js/storyline_vue.js') }}"></script>
@endsection

@section('custom-scripts')
    <script src="{{url('/vendor/filemanager/lib/ckfinder/ckfinder.js') }}"></script>
@endsection
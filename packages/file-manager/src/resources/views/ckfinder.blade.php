@extends('layouts.admin')

@section('site-title')
    File Manager
@endsection

@section('custom-styles')
    <style>

    </style>
@endsection

@section('custom-menu-links')

@endsection

@section('content')
    <div class="container-fullwidth">
        <div class="row">
            <div id="finder"></div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script src="/vendor/filemanager/lib/ckfinder/ckfinder.js"></script>
    <script>
        CKFinder.start();
    </script>
@endsection
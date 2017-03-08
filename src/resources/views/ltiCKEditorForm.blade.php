@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <form class="form-horizontal" method="POST" action="{{ route('ckeditor.launchurl') }}">

                    @if (session('error_message'))
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                {{ session('error_message') }}
                            </div>
                        </div>
                    @endif

                    @if (session('success_message'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        </div>
                    @endif

                    @if($errors->count() > 0)
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">@</span>
                            <input type="text" class="form-control" name = "key" placeholder="Key" value="{{ old('key') }}" aria-describedby="sizing-addon3">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">@</span>
                            <input type="text" class="form-control" name="secret" placeholder="Secret" aria-describedby="sizing-addon3" value="{{ old('secret') }}">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">@</span>
                            <input type="text" class="form-control" placeholder="Title" name="title" aria-describedby="sizing-addon3" value="{{ old('title') }}">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">@</span>
                            <input type="text" class="form-control" placeholder="Launch URL" name="launch_url" aria-describedby="sizing-addon3" value="{{ old('launch_url') }}">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">@</span>
                            <input type="text" class="form-control" name="config_url" placeholder="Config URL" aria-describedby="sizing-addon3" value="{{ old('config_url') }}">

                    </div>
                        <p></p>
                        <div class="input-group input-group-sm">
                            <button type="submit" class="btn btn-sm btn-primary">Insert LTI</button>
                        </div>
                        </div>


                </form>
            </div>
        </div>


@endsection
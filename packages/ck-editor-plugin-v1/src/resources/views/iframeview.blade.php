@extends('ckeditorplugin::layouts.master')

@section('content')
    <div class="container ltickplugin">
        <div class="row">
            <div class="col-md-8">

                <form id="iframe-form" name="iframe-form">

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
                            <input type="text" class="form-control" name="key" id="key" placeholder="Key"
                                   value="{{ old('key') }}" aria-describedby="sizing-addon3">
                        </div>
                        <p></p>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">@</span>
                            <input type="text" class="form-control" name="secret" id="secret" placeholder="Secret"
                                   aria-describedby="sizing-addon3" value="{{ old('secret') }}">
                        </div>
                        <p></p>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">@</span>
                            <input type="text" class="form-control" placeholder="Launch URL" id="launch_url"
                                   name="launch_url" aria-describedby="sizing-addon3" value="{{ old('launch_url') }}">
                        </div>
                        <p></p>
                        <div class="input-group input-group-sm">
                            <button id="submit" type="submit" class="btn btn-lg btn-success">Insert LTI</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
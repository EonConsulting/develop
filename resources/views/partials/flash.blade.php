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
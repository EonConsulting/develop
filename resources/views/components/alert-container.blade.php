<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="alert alert-{{ $type ?? 'success' }}">
                <button type="button" class="close" data-dismiss="alert">x</button>

                <strong>{{ $title }}</strong>

                {{ $slot }}
            </div>

        </div>
    </div>
</div>
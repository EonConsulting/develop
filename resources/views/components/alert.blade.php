<div class="alert alert-{{ $type ?? 'success' }}">
    <button type="button" class="close" data-dismiss="alert">x</button>

    <strong>{{ $title }}</strong>

    {{ $slot }}
</div>
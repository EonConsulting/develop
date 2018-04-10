@foreach($assets as $asset)
    <div class="content-entry shadow">
        <h3>{{ $asset->title }}</h3>
        <p>{{ $asset->description }}</p>

        <button class="content-copy-btn import-asset" data-asset-id="{{ $asset->id }}">Import</button>
    </div>
@endforeach
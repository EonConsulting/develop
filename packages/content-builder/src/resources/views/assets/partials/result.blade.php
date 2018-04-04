<div class="results-entry shadow">
    <div class="results-entry-icon">
        <i class="fa fa-image"></i>
    </div>
    <div class="results-entry-title">
         {{ $asset->title }}
    </div>
    <div class="results-entry-actions">
        <a href="#" id="{{ $asset->id }}" class="deleteEntry" data-asset-id="{{ $asset->id }}" data-toggle="tooltip" title="delete"><i class="fa fa-trash-o"></i></a>
        <a href="{{ route('assets.edit', $asset) }}" class="editEntry" data-asset-id="{{ $asset->id }}" data-toggle="tooltip" title="edit"><i class="fa fa-pencil-square-o"></i></a>
        
        <span data-toggle="modal" data-target="#exportModal">
        <a href="#" class="exportEntry" data-asset-id="{{ $asset->id }}" data-export-name="{{ $asset->title }}" data-toggle="tooltip" title="export"><i class="fa fa-save"></i></a>
        </span>
        
        <a href="#" class="previewEntry" data-asset-id="{{ $asset->id }}" data-toggle="tooltip" title="preview"><i class="fa fa-eye"></i></a>
    </div>
</div>
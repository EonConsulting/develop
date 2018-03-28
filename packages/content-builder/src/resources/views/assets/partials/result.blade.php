<div class="results-entry shadow">
    <div class="results-entry-icon">
        <i class="fa fa-image"></i>
    </div>
    <div class="results-entry-title">
         {{$item['title']}}
    </div>
    <div class="results-entry-actions">
        <a href="#" id="{{$item['id']}}" class="deleteEntry" data-asset-id="{{$item['id']}}" data-toggle="tooltip" title="delete"><i class="fa fa-trash-o"></i></a>
        <a href="{{ route('assets.edit', $item['id']) }}" class="editEntry" data-asset-id="{{ $item['id']}}" data-toggle="tooltip" title="edit"><i class="fa fa-pencil-square-o"></i></a>
        
        <span data-toggle="modal" data-target="#exportModal">
        <a href="#" class="exportEntry" data-asset-id="{{ $item['id']}}" data-export-name="{{ $item['title']}}" data-toggle="tooltip" title="export"><i class="fa fa-save"></i></a>
        </span>
        
        <a href="#" class="previewEntry" data-asset-id="{{ $item['id']}}" data-toggle="tooltip" title="preview"><i class="fa fa-eye"></i></a>
    </div>
</div>
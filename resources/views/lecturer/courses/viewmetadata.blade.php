<div class="meta-entry-container">
    <input name="metadata_type_id" type="hidden" value="{{ $metadata_type_id }}">

    @foreach($meta_store as $meta)
        <div class="meta-entry shadow" id="{{ $meta->id }}">
            <div style="overflow-y: auto;">
                <div class="meta-checkbox">
                    <input name="metadata_store_id[]" type="checkbox" value="{{ $meta->id }}" {{ $course_meta_data->has($meta->id) ? 'checked="checked"' : ''}}>
                </div>
                <div class="meta-description">
                    {{ $meta->description }}
                </div>
            </div>
        </div>

        <div class="meta-value">
            <input placeholder="Custom Value" class="form-control" name="value[]" type="text" value="{{ $course_meta_data->get($meta->id) }}">
        </div>
    @endforeach
</div>

@if($meta_store->count() > 0)
<div class="col-lg-8" style="margin-top:50px">
    <button type="submit" class="btn btn-success ">Submit</button>
</div>
@endif
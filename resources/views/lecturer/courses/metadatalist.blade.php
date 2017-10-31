
            
@foreach($metaStore as $resource)
        <label class="form-checkbox form-normal form-green form-text">
            {{ Form::checkbox('metadata_store_id[]', $resource->id, in_array($resource->id,$MetaId) ? true : false) }}
            {{ $resource->description }}
            {{ Form::text('value',null, array('placeholder'=>'Custom Value','class' => 'form-control')) }}
        </label>
@endforeach
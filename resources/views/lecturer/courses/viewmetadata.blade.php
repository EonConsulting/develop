  
<div class="meta-entry-container">
@foreach($MetadataStore as $key=>$resource)
    <div class="meta-entry shadow" id="{{$resource->id}}"> 
            <div style="overflow-y: auto;">
                <div class="meta-checkbox">
                    {{ Form::checkbox('metadata_store_id[]', $resource->id) }}
                </div>

                <div class="meta-description">
                    {{ $resource->description }}
                </div>
            </div>
            
            <div class="meta-value">
                {{ Form::text('value[]',null, array('placeholder'=>'Custom Value','class' => 'form-control')) }}
            </div>

    </div>
@endforeach
</div>


@if(!$MetadataStore->isEmpty())
<div style="margin-bottom: 15px;">
    <a type="button" class="btn btn-success ">Submit</a>
</div>
@else
   
@endif




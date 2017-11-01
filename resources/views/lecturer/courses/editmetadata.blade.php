                        
<div class="msgdata-info"></div>
    {{ Form::hidden('course_id',$course) }}
@foreach($data as $key=>$resource)
<label class="form-checkbox form-normal form-green form-text">
    {{ Form::checkbox('metadata_store_id[]', $resource->id, in_array($resource->id,$MetaId) ? true : false) }}
    {{ $resource->description }}
    {{ Form::text('value[]',empty($resource->course_metadata->value)? '' : $resource->course_metadata->value, array('placeholder'=>'Custom Value','class' => 'form-control')) }}
</label>

@endforeach



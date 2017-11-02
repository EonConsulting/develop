  
@foreach($MetadataStore as $key=>$resource)
<div class="tab-pane active col-lg-4" id="{{$resource->id}}"> 
                     <br>
                     <br>
                    <div class="form-group">
                       <label class="form-checkbox form-normal form-green form-text">
                      {{ Form::checkbox('metadata_store_id[]', $resource->id) }}
                      {{ $resource->description }}
                      {{ Form::text('value[]',null, array('placeholder'=>'Custom Value','class' => 'form-control')) }}
                     </label>
                    </div>
                </div>
@endforeach
<br>
<br>
@if(!$MetadataStore->isEmpty())
    <div class="col-lg-8" style="margin-top:50px">
    <a type="button" class="btn btn-success ">Submit</a>
</div>
@else
   
@endif




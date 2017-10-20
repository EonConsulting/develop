



<div class="form-group">
    {{ Form::label('metadata_type_id', 'Metadata Type') }}   
    {{ Form::select('metadata_type_id', $metadataType, null, array('placeholder' => 'Please select ...','class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::text('description', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('classification', 'Classification') }}
    {{ Form::text('classification', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('sequence', 'Sequence') }}
    {{ Form::text('sequence', null, array('class' => 'form-control')) }}
</div>


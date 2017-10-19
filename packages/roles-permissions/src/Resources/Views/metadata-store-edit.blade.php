
<div class="form-group">
    {{ Form::label('metadata_type_id', 'Metadata Type') }}   
    {{ Form::select('metadata_type_id', $metadataType, $metadata->metadata_type_id, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::text('description', $metadata->description, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('classification', 'Classification') }}
    {{ Form::text('classification', $metadata->classification, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('sequence', 'Sequence') }}
    {{ Form::text('sequence', $metadata->sequence, array('class' => 'form-control')) }}
</div>



    <div class="form-group">
        {{ Form::label('metadata_type', 'Metadata Type') }}
        {{ Form::text('metadata_type', $metadata->metadata_type, array('class' => 'form-control')) }}
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



<div class="form-group">
    {{ Form::label('name', 'Type Name') }}
    {{ Form::text('name', $metadata->name, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::text('description', $metadata->description, array('class' => 'form-control')) }}
</div>



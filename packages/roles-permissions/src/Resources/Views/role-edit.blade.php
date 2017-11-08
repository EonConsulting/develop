
<div class="form-group">
    {{ Form::label('name', 'Role Name') }}
    {{ Form::text('name', $role->name, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('description', 'Role Description') }}
    {{ Form::text('description', $role->description, array('class' => 'form-control')) }}
</div>




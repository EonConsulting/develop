                        
<div class="msgdata-info"></div>

<div class="form-group">                          
    {{ Form::label('title', 'Module Title') }}                               
    {{ Form::text('title', $data->title, array('class' => 'form-control')) }}
</div>
<div class="form-group">                           
    {{ Form::label('description', 'Module Summary') }}
    {{ Form::textarea('description', $data->description, array('class' => 'form-control')) }}                           
</div>
<div class="form-group">                       
    {{ Form::label('tags', 'Tags (Separate by a comma)') }}
    {{ Form::text('tags', $data->tags, array('class' => 'form-control')) }}
    {{ Form::hidden('creator_id', $data->creator_id) }}
    {{ Form::hidden('id', $data->id) }}

</div>


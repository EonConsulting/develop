                        
<div class="msgdata-info"></div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('title', 'Module Title') }}
            {{ Form::text('title', $data->title, array('class' => 'form-control')) }}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="template">Template</label>
            <select class="form-control" name="template" id="" required>

                <?php foreach($templates as $template): ?>

                <option value="<?php echo $template['id']; ?>" <?php if($data->template_id === $template['id']) echo "selected"; ?>><?php echo $template['name']; ?></option>

                <?php endforeach; ?>

            </select>
        </div>
    </div>
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


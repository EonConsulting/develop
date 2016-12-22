<?php
/**
 * Template: Render a Faculty
 */
?>
<div class="col-md-3">

    <!--    --><?php
    $faculty = '';

    $id = $response->id;
    $first_name = $response->first;
    $mid_name = $response->middle;
    $last_name = $response->last;
    $suffix = $response->suffix;

    $faculty .= $first_name . ' ' . $mid_name . ' ' . $last_name;

    ?>

    <a href="{{ route('phpsaaswrapper.consume_with_options', ['key' => $key, 'use' => $use, 'options' => 'faculty-' . $id]) }}">
        <div class="media">
            <div class="media-left">
                <img class="media-object" src="http://placehold.it/50x50" alt="...">
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{ $faculty }}</h4>
            </div>
        </div>
        <br/>
    </a>

</div>
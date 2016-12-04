<div class="row">

    <?php
    $faculty = '';

    for($i = 0; $i < count($response->faculty); $i++) {
        $temp_faculty = $response->faculty[$i];

        $id = $temp_faculty->id;
        $first_name = $temp_faculty->first;
        $mid_name = $temp_faculty->middle;
        $last_name = $temp_faculty->last;
        $suffix = $temp_faculty->suffix;

        if($i > 0) {
            $faculty .= ', ';
        }

        $faculty .= $first_name . ' ' . $mid_name . ' ' . $last_name;
    }

    ?>

    <h3>{{ $response->title }} <small><span class="text-muted">Faculty: </span> {{ $faculty }}</small></h3>
    <div class="meta">
        <small><span class="text-muted">Field: </span> {{ $response->field }}</small> |
        <small><span class="text-muted">Term: </span> {{ $response->term }}</small>
        <br />
        <br />
    </div>
    <p>{{ $response->description }}</p>
    <hr />
    <small>{{ $response->notes }}</small>
</div>
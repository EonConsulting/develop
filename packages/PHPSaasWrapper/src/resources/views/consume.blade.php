<?php
/**
 * Consume all the API requests
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <a href="{{ url()->previous() }}">Back to list</a>

    <br /><br />

    @foreach($responses as $response_key => $response)

        <h4>{{ $response_key }}</h4>

        @if(!is_null($response['template']))

            <?php $str = 'templates.' . $response['key'] . '.' . $response['template']; ?>

            @for($i = 0; $i < count($response['response']); $i++)
                @include($str, ['response' => $response['response'][$i]])
            @endfor

        @else
            <pre>
                <?php print_r($response['response']) ?>
            </pre>
        @endif

    @endforeach
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
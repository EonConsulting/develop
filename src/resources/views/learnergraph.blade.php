@extends('ph::layouts.app')
@section('content')

    <div class="col-sm-12">
        <!-- <h1>Hello World!</h1>
        <p>Resize the browser window to see the effect.</p> -->

        <div class="row">

            <div class="col-sm-12 " style="background-color:none; ">

                <p>Preview</p>
                <div id="preview1  ">
                    <div id='jxgbox' class='textareaCode' style=' border: groove;'></div>
                </div>
            </div>

        </div>

    </div>
    <div id="preview2">
        <
        <script style="text/javascript">
            {!! $graph->code !!}
        </script>
    </div>


@endsection

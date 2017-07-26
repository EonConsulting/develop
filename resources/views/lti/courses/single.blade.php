@extends('layouts.lti')

@section('site-title')
    Modules
@endsection

@section('custom-styles')

@endsection

@section('body-class')

@endsection

@section('user-image')
    {{url('/dist/img/user3-128x128.jpg')}}
@endsection

@section('mini-logo-title')
    Modules
@endsection

@section('logo-title')
    Modules
@endsection

@section('page-title')
    Modules
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel">
                    <div class="list-group">
                        <a href="{{ route('lti.courses.single.lectures', $course['id']) }}" class="list-group-item">Go to lectures</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel">
                    <div class="pane-heading">
                        <h4 class="">{{ $course['title'] }}</h4>
                    </div>
                    <div class="panel-body">
                        <p>{!! $course['description'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div id="sample">
            <div id="myDiagramDiv" style="border: solid 1px black; width:100%; height:400px;"></div>
            <button id="SaveButton" onclick="save()">Save</button>
            <button onclick="load()">Load</button>
            <button onclick="layoutAll()">Layout</button>
            Diagram Model saved in JSON format:
            <br />
            <textarea id="mySavedModel" style="width:100%;height:400px">
{ "class": "go.TreeModel",
  "nodeDataArray": [
{"key":0, "text":"Mind Map", "loc":"0 0"},
{"key":1, "parent":0, "text":"Getting more time", "brush":"skyblue", "dir":"right", "loc":"77 -22"},
{"key":11, "parent":1, "text":"Wake up early", "brush":"skyblue", "dir":"right", "loc":"200 -48"},
{"key":12, "parent":1, "text":"Delegate", "brush":"skyblue", "dir":"right", "loc":"200 -22"},
{"key":13, "parent":1, "text":"Simplify", "brush":"skyblue", "dir":"right", "loc":"200 4"},
{"key":2, "parent":0, "text":"More effective use", "brush":"darkseagreen", "dir":"right", "loc":"77 43"},
{"key":21, "parent":2, "text":"Planning", "brush":"darkseagreen", "dir":"right", "loc":"203 30"},
{"key":211, "parent":21, "text":"Priorities", "brush":"darkseagreen", "dir":"right", "loc":"274 17"},
{"key":212, "parent":21, "text":"Ways to focus", "brush":"darkseagreen", "dir":"right", "loc":"274 43"},
{"key":22, "parent":2, "text":"Goals", "brush":"darkseagreen", "dir":"right", "loc":"203 56"},
{"key":3, "parent":0, "text":"Time wasting", "brush":"palevioletred", "dir":"left", "loc":"-20 -31.75"},
{"key":31, "parent":3, "text":"Too many meetings", "brush":"palevioletred", "dir":"left", "loc":"-117 -64.25"},
{"key":32, "parent":3, "text":"Too much time spent on details", "brush":"palevioletred", "dir":"left", "loc":"-117 -25.25"},
{"key":33, "parent":3, "text":"Message fatigue", "brush":"palevioletred", "dir":"left", "loc":"-117 0.75"},
{"key":331, "parent":31, "text":"Check messages less", "brush":"palevioletred", "dir":"left", "loc":"-251 -77.25"},
{"key":332, "parent":31, "text":"Message filters", "brush":"palevioletred", "dir":"left", "loc":"-251 -51.25"},
{"key":4, "parent":0, "text":"Key issues", "brush":"coral", "dir":"left", "loc":"-20 52.75"},
{"key":41, "parent":4, "text":"Methods", "brush":"coral", "dir":"left", "loc":"-103 26.75"},
{"key":42, "parent":4, "text":"Deadlines", "brush":"coral", "dir":"left", "loc":"-103 52.75"},
{"key":43, "parent":4, "text":"Checkpoints", "brush":"coral", "dir":"left", "loc":"-103 78.75"}
 ]
}
  </textarea>
    </div>
@endsection

@section('custom-scripts')
    <!-- jvectormap -->
    <script src="{{url('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{url('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- GO JS -->
    <script src="{{url('/vendor/storyline/mindmap/js/go.js')}}"></script>
    <script src="{{url('/vendor/storyline/mindmap/js/init.js')}}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{url('/plugins/chartjs/Chart.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{url('/dist/js/pages/dashboard2.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{url('/dist/js/demo.js')}}"></script>
@endsection
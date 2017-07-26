@extends('layouts.app')


@section('custom-styles')
    <link rel="stylesheet" href="{{url('/storyline-ng/app/angular-ui-tree.css')}}">
    <link rel="stylesheet" href="{{url('/storyline-ng/app/app.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/css/jquery.ui.theme.css" />
@endsection

@section('content')
    <div class="container-fluid" id="root app">
        <div class="row">
            @if (session('error_message'))
                <div class="alert alert-danger">
                    {{ session('error_message') }}
                </div>
            @endif

            @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
            @endif

            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- CONTROLS -->
            <div class="col-xs-6 col-md-3">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                               aria-expanded="true" aria-controls="collapseOne">
                                <p class="panel-title">Storyline Controls</p>
                            </a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="menu-name-label howto open-label" for="menu-name">
                                        <span>ToolBox Control</span></label>
                                   </div>
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- END CONTROLS -->

            <!-- STORYLINE -->
            <div class="col-xs-12 col-sm-6 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="major-publishing-actions">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label class="menu-name-label howto open-label" for="menu-name">
                                        <span>Storyline</span>
                                        <input name="menu-name" id="menu-name" type="text" class="form-control input-sm"
                                               title="Enter menu name here" value="{{ $course->title }}" disabled>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div ng-app="demoApp" class="panel-body">
                        <h5>Storyline Structure: <span style="color:#666; font-size:12px; font-style: italic">Drag any item into the Order Preferred, Toggle the Collapse on the Left for More Options</span></h5>
                        <hr />
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ng-view></ng-view>
                                    {{--<input type="hidden" id="course_id" ng-model="{{ $course->id }}" />--}}
                                    <script type="text/javascript">
                                        var course_id = '{{ $course->id }}'
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <!--<form class="form-inline">
                            <div class="form-group">
                                <input type="submit" name="save_menu" id="save_menu_header"
                                       class="btn btn-primary btn-sm" value="Save Storyline">
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
            <!-- END STORYLINE -->

        </div>
    </div>


    <!--
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="container"  >


                    </div>
                </div>
            </div>
        </div>
    -->
@endsection

@section('custom-scripts')
    <!-- JavaScript -->
    <!--[if IE 8]>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <![endif]-->

    <script src="{{url('/storyline-ng/Scripts/angular.min.js')}}"></script>
    <script src="{{url('/storyline-ng/Scripts/angular-route.min.js')}}"></script>
    <script src="{{url('/storyline-ng/Scripts/angular-ui/ui-bootstrap-tpls.min.js')}}"></script>
    <script src="{{url('/storyline-ng/app/main.js')}}"></script>
    <script src="{{url('/storyline-ng/app/controllers/handleCtrl.js')}}"></script>
    <script src="{{url('/storyline-ng/app/controllers/nodeCtrl.js')}}"></script>
    <script src="{{url('/storyline-ng/app/controllers/nodesCtrl.js')}}"></script>
    <script src="{{url('/storyline-ng/app/controllers/treeCtrl.js')}}"></script>
    <script src="{{url('/storyline-ng/app/directives/uiTree.js')}}"></script>
    <script src="{{url('/storyline-ng/app/directives/uiTreeHandle.js')}}"></script>
    <script src="{{url('/storyline-ng/app/directives/uiTreeNode.js')}}"></script>
    <script src="{{url('/storyline-ng/app/directives/uiTreeNodes.js')}}"></script>
    <script src="{{url('/storyline-ng/app/services/helper.js')}}"></script>
    <script src="{{url('/storyline-ng/app/js/app.js')}}"></script>
    <script src="{{url('/storyline-ng/app/js/story-line.js')}}"></script>
    <script src="{{url('/storyline-ng/app/js/filter-nodes.js')}}"></script>
    <script src="{{url('/storyline-ng/app/js/cloning.js')}}"></script>
    <script src="{{url('/storyline-ng/app/js/connected-trees.js')}}"></script>
    <script src="{{url('/storyline-ng/app/js/table-example.js')}}"></script>
    <script src="{{url('/storyline-ng/app/js/drop-confirmation.js')}}"></script>
    <script src="{{url('/storyline-ng/app/js/expand-on-hover.js')}}"></script>
    <script src="{{url('/vendor/filemanager/lib/ckfinder/ckfinder.js') }}"></script>
@endsection

@extends('layouts.app')


@section('custom-styles')
    <link rel="stylesheet" href="{{url('/storyline-ng/app/angular-ui-tree.css')}}">
    <link rel="stylesheet" href="{{url('/storyline-ng/app/app.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/css/jquery.ui.theme.css" />


    <style>
        .content-title {width: 40%; background: #f4f4f4; padding: 5px; color: #949494; border-color: #fb7217; border-style: solid; border-width: 0px 0px 0px 0px; outline: none;}
        .content-title:hover {outline: none; border-color: #d3d3d3; border-width: 0px 0px 1px 0px;}
        .content-title:focus:hover {outline: none; border-color: #d3d3d3; border-width: 0px 0px 1px 0px;}
        .content-title:focus {outline: none; color: #fb7217; border-width: 0px 0px 1px 0px;}
        .tree-node {border-color: #dce2e8; background: #f6f6f6; height: auto; padding: 10px; overflow-y: auto;}
        .tree-node:hover {border-color: #d3d3d3;}
        .stoyline-btn {cursor: pointer; padding: 5px;}
        .storyline-btn-delete {color: #dd4b39;}
        .storyline-btn-add {color: #00c0ef;}
    </style>
@endsection

@section('content')
    <div class="container-fluid">
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
        <div class="row">
            {{--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"/>--}}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/css/jquery.ui.theme.css" />
            <div id="root">
                <div class="col-md-12">
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
                                    <button class="btn btn-default btn-sm pull-right up-csv" data="csv">Import CSV  <span class="fa fa-file-excel-o" style="color:green"></span></button>
                                </form>
                            </div>
                            <div id="myCSV" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">CSV File Upload</h4>
                                        </div>
                                        <div class="modal-body csv-view">

                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div id="myCont" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"></h4>
                                        </div>
                                        <form id="saveCont" action="/lecturer/storeContent">
                                            <div class="modal-body csv-view">
                                                <div class="modal-msg"></div>
                                                <div class="form-group">
                                                    <input id="con-title" type="text" name="file_name" class="form-control" placeholder="Content Title">
                                                    <input type="hidden" name="storyline_id" value="">
                                                </div>
                                                <textarea id="ltieditorv2inst" class="ckeditor" name="editor">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>
                                                <input type="hidden" id="data" name="data" />
                                                <br />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" id="btnsbmit" class="btn btn-primary btn-sm">Save Content</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            {{ csrf_field() }}
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div ng-app="demoApp" class="panel-body">
                            <h5>Storyline Structure: <span style="color:#666; font-size:12px; font-style: italic">Drag any item into the Order Preferred, Toggle the Collapse on the Left for More Options</span></h5>
                            <hr />
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

            </div>
        </div>
    </div>
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

    <script src="{{url('/vendor/filemanager/lib/ckfinder/ckfinder.js')}}"></script>
    <script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>

    <script>
        $(document).ready(function(){
             //CSV upload modal
            $(".up-csv").click(function(){
                $('#myCSV').modal();
                  var course_id = '{{ $course->id }}';
                  var file_type       = $(this).attr('data');
                $.ajax({
                url: '/lecturer/csv/fileupload/'+course_id+'/'+file_type,
                type: "GET",
                asyn: false,
                beforeSend: function () {
                    $('.csv-view').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
                },
                success: function (data, textStatus, jqXHR)
                {
                    $('.csv-view').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                   // location.reload();
                }
              });
            });
            //Submit storyline
            $(document).on('submit', '#saveCont', function (event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr("action");
                $.ajax({
                    url: url,
                    type: "POST",
                    asyn: false,
                    data: formData,
                    beforeSend: function () {
                        $('#btnsbmit').text("Saving content.....");
                    },
                    success: function (data, textStatus, jqXHR)
                    {
                        var data = JSON.parse(data);
                        if(data.message == 'success') {
                            $('#btnsbmit').text("Save");
                            $('.modal-msg').html("<div class='alert alert-success'><strong>success! </strong>Content has been save successfully.</div>");
                            setTimeout(function () {
                                //location.reload(1);
                                $('textarea#ltieditorv2inst,#con-title').val("");
                                $('.modal-msg').html("");
                                $("#myCont").modal('toggle');
                            }, 5000);
                        }else{
                            $('.modal-msg').html("<div class='alert alert-warning'><strong>Warning! </strong>Please add Content Title. </div>");
                            $('#btnsbmit').text("Save");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                        location.reload();
                    }
                });
            });
        });
    </script>
    <script>
        //Dialogue Insertion Point -->
        var config = {
            extraPlugins: 'dialog',
            toolbar: [[ 'LTIButton' ]]
        };
    </script>

    <script>
        $(function(){
            var editor = CKEDITOR.replace('ltieditorv2inst', {
                    extraPlugins: 'interactivegraphs,ltieditorv1,ltieditorv2,html2PDF,mathjax,dialog,xml,templates,widget,lineutils,widgetselection,clipboard',
                    allowedContent: true,
                    fullPage: true,
                    mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG',
                    height: 280,
                    on : {
                        // maximize the editor on startup
                        'instanceReady' : function( evt ) {
                            this.document.appendStyleSheet('{{url('/vendor/storyline/core/components/css/composite-asset.css')}}');
                            this.document.appendStyleSheet('{{url('/vendor/storyline/core/components/css/composite-asset-print.css')}}');
                            this.document.appendStyleSheet(' {{url('/vendor/storyline/core/components/css/materialize.css')}}' );
                            this.document.appendStyleSheet('{{url('/vendor/storyline/core/components/css/economics.css' )}}');
                            this.document.appendStyleSheet( 'https://fonts.googleapis.com/icon?family=Material+Icons' );
                        }
                    }
                }
            );
//            CKEDITOR.on('instanceReady',
//            function (evt) {
//                var editor = evt.editor;
//                //editor.execCommand('maximize');
////                editor.resize("100%", $('#editor-wrapper').height());
//            });
            {{--CKEDITOR.document.appendStyleSheet("{{URL::asset('/vendor/ckeditorpluginv2/css/custom-contents.css')}}");--}}
            //            CKEDITOR.instances.ltieditorv2inst.updateElement();
            //            editor.updateElement();
            //Custom Function to get the Data from the Editor
            function getData() {
                return editor.getData();
            }
            $('#btnsbmit').click(function (event) {
                var data = getData();
                $('#data').val(JSON.stringify(data));
                console.log(data);
                $('#save').submit();
                console.log(data);
            });
        });
    </script>
@endsection
@extends('layouts.app')

@section('site-title')
    File Manager
@endsection

@section('custom-styles')
    <link rel="stylesheet" type="text/css" href="/vendor/filemanager/css/all.css" />
    <link rel="stylesheet" type="text/css" href="/vendor/filemanager/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <style>
        .treeview-icon  {
            width: 16px;
            height: 16px;
            background-image: url("/vendor/filemanager/images/file-icons-sprite.png");
        }
        .icon-folder {
            background-position: 0px 0px;
        }
        .icon-png {
            background-position: -16px 0px;
        }
        .icon-txt {
            background-position: -32px 0px;
        }
        .icon-pdf {
            background-position: -48px 0px;
        }
        .icon-doc {
            background-position: -64px 0px;
        }
        .icon-xls {
            background-position: -80px 0px;
        }

        #editor-block {
            position: absolute;
            top: 0px;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: inherit;
        }

        #preview-block {
            position: absolute;
            top: 0px;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: inherit;
        }

        #editor-wrapper {
            position: relative;
            min-height: 450px;
            height: 100%;
            width: 100%;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .centering{
            float:none;
            margin:0 auto
        }
        
        iframe {
            width: 100%;
            height: 100%;
            border: 1px solid #404040;
        }

    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body pb-filemng-panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="" id="treeview">
                                <ul>
                                    {!! print_r($html) !!}
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist" id="tabs">
                                        <li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Info</a></li>
                                        <li role="presentation" class="active"><a href="#editor" aria-controls="profile" role="tab" data-toggle="tab">Editor</a></li>
                                        {{--<li role="presentation"><a href="#preview" aria-controls="messages" role="tab" data-toggle="tab">Preview</a></li>--}}
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane" id="info">
                                            <table class="table table-frameless">
                                                <tr>
                                                    <td><strong>Filename:</strong></td>
                                                    <td id="filename-td"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Path:</strong></td>
                                                    <td id="path-td"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane active" id="editor">
                                            <div class="col-md-6">
                                                <h3 id="file-name-title"></h3>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="pull-right">
                                                    <small>&nbsp;</small>
                                                    <ul class="list-unstyled list-inline text-center centering">
                                                        <li><button type="button" class="btn btn-info btn-xs" id="full-screen" data-fs=""><span class="fa fa-arrows-alt"></span></button></li>
                                                        <li><button type="button" class="btn btn-success btn-xs" id="save-page"><span class="fa fa-floppy-o"></span></button></li>
                                                        <li><button type="button" class="btn btn-danger btn-xs"><span class="fa fa-trash-o"></span></button></li>
                                                    </ul>
                                                    <br />
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div id="editor-wrapper">
                                                <div id="editor-block"></div>
                                            </div>
                                        </div>
                                        {{--<div role="tabpanel" class="tab-pane" id="preview">--}}
                                            {{--<div id="editor-wrapper">--}}
                                                {{--<div id="preview-block"></div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <input type="hidden" id="tok" value="{{ csrf_token() }}"/>
@endsection



@section('custom-scripts')

<script src="/vendor/filemanager/lib/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script type="text/javascript" src="/vendor/filemanager/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="/vendor/filemanager/js/fileManagerData.js"></script>

<script>
    $(function () {
        var current_item = {};
        var app_url = '{{ env('APP_URL') }}';
        var save_url = '{{ route('eon.file-manager.save') }}';
        var _token = $('#tok').val();

//        var editor = ace.edit("editor-block");

        var editor = CKEDITOR.replace('editor-block', {
            on : {
                // maximize the editor on startup
                'instanceReady' : function( evt ) {
                    evt.editor.resize("100%", $('#editor-wrapper').height());
//                    this.document.appendStyleSheet( '/vendor/storyline/core/components/css/composite-asset.css' );
//                    this.document.appendStyleSheet( '/vendor/storyline/core/components/css/composite-asset-print.css' );
//                    this.document.appendStyleSheet( '/vendor/storyline/core/components/css/materialize.css' );
//                    this.document.appendStyleSheet( '/vendor/storyline/core/components/css/economics.css' );
//                    this.document.appendStyleSheet( 'https://fonts.googleapis.com/icon?family=Material+Icons' );
                }
            },
//            height: '100%'
        });
        editor.config.extraPlugins = 'autogrow,xml,maximize,ckawesome';
        editor.config.fullPage = true;
//        editor.config.extraPlugins = 'xml';
        editor.autoGrow_onStartup = true;
        editor.config.height = $('#editor-wrapper').height();
//        editor.resize($('#editor-wrapper').width(), $('#editor-wrapper').height(), true, false);
//        editor.resize('100%','100%');

        $("#treeview").on('changed.jstree', function (e, data) {
            console.log('Path: ', data.node.data);

            if(!data.node.data.hasOwnProperty('item') || !data.node.data.hasOwnProperty('path')) {
                return false;
            }

            var path = data.node.data.path;
            var item = data.node.data.item;
            current_item = data.node.data;

            $('#filename-td').text(item);
            $('#file-name-title').text(item);
            $('#path-td').text(path);
            $('#full-screen').data('fs', path);

            $.ajax({
                url: app_url + path + "/" + item,
                context: document.body,
                success: function (response) {
                    if(isXML(response)) {
//                        editor.destroy();
//                        console.log('response', response);
//                        editor = new CKEDITOR.xml('<\?xml version="1.0" encoding="UTF-8" standalone="yes"?><somenode>Hello</somenode>');
                        var str = new XMLSerializer().serializeToString(response);
                        console.log('str', str);
                        editor.setData(str);
//                        editor.setData(response);
                    } else {
                        editor.setData(response);
                    }
                }
            });

        }).jstree();

        function isXML(xml){
            try {
                xmlDoc = $.parseXML(xml); //is valid XML
                return true;
            } catch (err) {
                // was not XML
                return false;
            }
        }

        $('#tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $('#save-page').on('click', function() {
            $.ajax({
                url: save_url,
                type: 'post',
                data: {_token: _token, page: current_item.path + '/' + current_item.item, data: editor.getData()},
                context: document.body,
                success: function (response) {
                    console.log('res', response);
                }
            });
        });

        $('#full-screen').on('click', function() {
            editor.execCommand('maximize');
        });

    })
</script>
@endsection
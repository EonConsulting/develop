@extends('layouts.app')

@section('site-title')
    Editor | File Manager
@endsection

@section('custom-styles')
    <style>
        #editor-wrapper {
            top: 50px;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
            width: auto;
            height: auto;
        }

        #editor {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 50%;
        }

        #preview {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 50%;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: 1px solid #404040;
        }
    </style>
@endsection

@section('custom-menu-links')
    <li><a href="{{ url()->previous() }}"><span class="label label-success label-xs">Save</span></a></li>
    <li><a href="{{ url()->previous() }}"><span class="label label-primary label-xs">Back</span></a></li>
@endsection

@section('content')
    <div class="container-fullwidth">
        <div class="row">
            <div id="editor-wrapper">
                <div id="editor"></div>
                <div id="preview"></div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script src="/vendor/filemanager/lib/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8"></script>
    <script>
        var app_url = '{{ env('APP_URL') }}';
        var link = '{{ $page }}';

        var editor = CKEDITOR.replace('editor', {
            on : {
                // maximize the editor on startup
                'instanceReady' : function( evt ) {
                    evt.editor.resize("100%", $('#editor-wrapper').height());
                }
            }
        });

//        editor.resize($("#editor-wrapper").width(),$("#editor-wrapper").height(), true);

        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/html");

        $.ajax({
            url: app_url + link,
            context: document.body,
            success: function (response) {
                editor.setData(response);
            }
        });

        function showHTMLInIFrame() {
            $('#preview').html("<iframe src=" +
                "data:text/html," + encodeURIComponent(editor.getValue()) +
                "></iframe>");
        }
        editor.on("input", showHTMLInIFrame)
        showHTMLInIFrame();
        editor.navigateFileStart();
    </script>
@endsection
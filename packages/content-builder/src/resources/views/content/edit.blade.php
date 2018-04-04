@extends('layouts.app')

@section('page-title')
    Content Builder
@endsection

@section('custom-styles')
{{--<link href="{{ URL::asset('vendor/ckeditorpluginv2/css/select2.min.css') }}" type="text/css" rel="stylesheet" />--}}
    <style>
        
    .content-container {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-justify-content: flex-start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-align-content: stretch;
        -ms-flex-line-pack: stretch;
        align-content: stretch;
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    .content-info {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 0 1 auto;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        padding-bottom: 15px;
    }

    .content-editor {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
    }

    .info-bar-container {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-justify-content: flex-start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-align-content: stretch;
        -ms-flex-line-pack: stretch;
        align-content: stretch;
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    .info-bar-name {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -webkit-align-self: auto;
        -ms-flex-item-align: auto;
        align-self: auto;
        padding-right: 15px;
    }

    .info-bar-buttons {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 0 1 auto;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        -webkit-align-self: auto;
        -ms-flex-item-align: auto;
        align-self: auto;
    }

    .cke_460_uiElement {
        height: 100%;
    }

    .cktextarea {height: 100%;}
    .contentBoxHeight {height: 100%;}
    .cke_resizer {display: none;}
        /*.cke_inner {clear: both;}*/
    </style>
@endsection

@section('content')
    {{  Form::open(array('url'=>url('content/update/'.$content->id),'method'=>'post','id'=>'save'))}}

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


    <div class="content-container">

        <div class="content-info">

            <div class="container-fluid">
                <div class="info-bar-container">

                    <div class="info-bar-name">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">Title</span>
                            <input type="text" class="form-control" name="title" placeholder="Content Title" value="{{ $content->title }}"/>
                        </div>
                    </div>

                    <div class="info-bar-buttons" style="text-align: right;">
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#saveModal">
                            <i class="fa fa-save"></i>
                            <span class="hidden-xs"> Save</span>
                        </button>

                        <button type="button" id="btnsbmit" class="btn btn-danger"><i class="fa fa-trash"></i><span class="hidden-xs"> Delete</span></button>
                    </div>

                </div> <!-- row end -->
            </div>

        </div>
    

        <div class="content-editor">
            <div class="contentBoxHeight">
                <textarea id="ltieditorv2inst" class="ckeditor cktextarea" name="editor">
                    {{ $content->body }}
                </textarea>

                <input type="hidden" id="data" name="data" />
            </div>
        </div>
    
    </div>  

    {{ csrf_field() }}
    {{ Form::close() }}
@endsection

@section('exterior-content')
    <!-- Modal -->
    <div id="saveModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Modal Header</h4>
                </div>

                <div class="modal-body">
                    <p>We need a bit more information from you before we can save this content</p>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" form="save" class="form-control" name="description" value="{{ $content->description }}">
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="categories[]">Categories</label>
                        </div>

                        <?php foreach($categories as $category): ?>

                        <div>
                            <label style="font-weight: 400;">
                                <input form="save" type="checkbox" name="categories[]" value="<?php echo $category->id; ?>" <?php if($category->checked) echo "checked"; ?>>
                                <?php echo $category->name; ?>
                            </label>
                        </div>

                        <?php endforeach; ?>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input form="save" type="text" name="tags" class="form-control" id="tags" placeholder="Tags" value="{{ $content->tags }}">
                    </div>

                
                </div>

                <div class="modal-footer">
                    <button id="btnsbmit" class="btn btn-primary"><i class="fa fa-save"></i><span> Save</span></button>
                </div>
            </div>

        </div>
    </div>     
        
@endsection

@section('custom-scripts')
    <script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>
    <script src="https://use.fontawesome.com/5154cf88f4.js"></script>
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

                disableNativeSpellChecker: false,
                scayt_autoStartup: true,
                extraPlugins: 'sourcedialog,interactivegraphs,taoclient,ltieditorv2,mathjax,dialog,xml,templates,widget,lineutils,widgetselection,clipboard',
                removePlugins: 'wsc,sourcearea',
                allowedContent: true,
                fullPage: false,
                mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG',

            {{-- Leaving old code in case something goes wrong
                        extraPlugins: 'interactivegraphs,ltieditorv1,ltieditorv2,html2PDF,mathjax,dialog,xml,templates,widget,lineutils,widgetselection,clipboard',
                        allowedContent: true,
                        fullPage: false,
                        mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG',
            --}}
                }
            );
            
            editor.on('instanceReady', function(){
                var writer = editor.dataProcessor.writer;
                writer.indentationChars = '';
                writer.lineBreakChars = '';
                editor.dataProcessor.writer.setRules( 'p',
                {
                    indent : false,
                    breakBeforeOpen : false,
                    breakAfterOpen : false, 
                    breakBeforeClose : false,
                    breakAfterClose : false
                });
            });
            
            editor.Height = '100%';

            {{--CKEDITOR.document.appendStyleSheet("{{URL::asset('/vendor/ckeditorpluginv2/css/custom-contents.css')}}");--}}


            $(document).on("click", "#btnsbmit", function(event){

                var data = editor.getData();
                
                $('#data').val(data);

                console.log(data);

                $('#save').submit();

                //console.log(data);
            });

        });

        CKEDITOR.on('instanceReady', function() { 
            var textEditHeight      = $(".cktextarea").height();
            var ckTopHeight         = $("#cke_1_top").height();
            var ckContentsHeight    = $("#cke_1_contents").height();
            var ckBottomHeight      = $("#cke_1_bottom").height();

            $("#cke_1_contents").height( (textEditHeight - ckTopHeight - ckBottomHeight - 77) + "px");

        });

        // resize the editor(s) while resizing the browser
        $(window).resize(function(){
            var textEditHeight      = $(".cktextarea").height();
            var ckTopHeight         = $("#cke_1_top").height();
            var ckContentsHeight    = $("#cke_1_contents").height();
            var ckBottomHeight      = $("#cke_1_bottom").height();

            $("#cke_1_contents").height( (textEditHeight - ckTopHeight - ckBottomHeight - 77) + "px");

        });

    </script>
@endsection

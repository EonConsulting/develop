@extends('layouts.app')

@section('custom-styles')
{{--<link href="{{ URL::asset('vendor/ckeditorpluginv2/css/select2.min.css') }}" type="text/css" rel="stylesheet" />--}}
    <style>

        .cke_button__LTIButton_icon { display:none !important;  }
        .cke_button__LtiTools_label { display: inline !important }

        body {font-family:arial; background: transparent !important;}
        .h5, h5 {  font-size: 1.2rem !important;  color:#002a80; }
        p {  margin-top: 0;  margin-bottom: 1rem;  font-size: 13px;  }
        .ltickplugin {background: transparent;}

        /* Backgrounds */
        .unisa-grey     {background: #777777 !important}

        /* Buttons Active */

        .unisa-blue-btn     {background: #172652 !important; border-color: #172652; color:#fff;}
        .unisa-red-btn      {background: #930010 !important; border-color: #930010; color:#fff;}
        .unisa-black-btn    {background: #222222 !important; border-color: #222222; color:#fff;}
        .unisa-orange-btn   {background: #F7931D !important; border-color: #F7931D; color:#fff;}
        .unisa-grey-btn     {background: #777777 !important; border-color: #777777; color:#fff;}

        /* Borders and Shadows */
        .unisabdr           {border:1px solid #222222}

        .unisa-blue-btn:hover     {background: #172652 !important; border-color: #172652; color:#fff;}
        .unisa-red-btn:hover      {background:red;color:#cccccc;}
        .unisa-black-btn:hover    {background: #222222 !important; border-color: #222222; color:#fff;}
        .unisa-orange-btn:hover   {background: #F7931D !important; border-color: #F7931D; color:#fff;}
        .unisa-grey-btn:hover     {background: #777777 !important; border-color: #777777; color:#fff;}

        /* Apps Css */
        .container{width:100%}
        .col-xs-3 {width:25%; float:left; position:relative}
        #app-container {width:100%;}
        .app-item {padding:10px;}
        #app-container .app-item .app-contents {background:#fff; border:1px solid #e0e0e0; padding:0px; position: relative;}
        #app-container .app-item .app-contents .app-logo {padding:10px; border-bottom: 1px dashed #cccccc}
        #app-container .app-item .app-contents .app-logo img {width:140px; height:70px; border: 0; padding: 0; vertical-align: middle}
        .img-thumbnail {max-width:100%; display: inline-block; border-radius:0; line-height:1.428571429;}
        #app-container .app-item .app-contents .app-details{padding:5px 10px;}
        #app-container .app-item .app-contents .app-details h4 {color:#222222; margin:0; padding:0 0 5px 0; font-size: 12px; text-align:center; border-bottom:1px dashed #cccccc; height:20px;}
        #app-container .app-item .app-contents .app-details p.app-description {font-size:10px; color: #2e383c; height:38px; overflow: hidden; padding:10px 0}

        .ckeditor {height: 100%;}
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <form id="save" method="POST" action="/lecturer/content/builder">
                    {{--Production URL--}}
                {{--<form id="save" method="POST" action="/lecturer/content/builder">--}}

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

                    <div class="input-group">
                        <input type="text" class="form-control" name="file_name" placeholder="Content Title" value=""/>
                        <span class="input-group-addon" id="basic-addon2">.html</span>

                    </div>

                    <br />
                    <textarea id="ltieditorv2inst" class="ckeditor" name="editor">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>
                    <input type="hidden" id="data" name="data" />
                    <br />
                    <button type="button" id="btnsbmit" class="btn btn-primary btn-sm">Save Content</button>
                    <button type="button" id="btnsbmit" class="btn btn-warning btn-sm">Move to trash</button>
                    {{ csrf_field() }}
                </form>
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
                        extraPlugins: 'interactivegraphs,ltieditorv1,ltieditorv2,html2PDF,mathjax,dialog,xml,templates,widget,lineutils,widgetselection,clipboard',
                        allowedContent: true,
                        fullPage: true,
                        mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG',
                        height: 280,
                    on : {
                        // maximize the editor on startup
                        'instanceReady' : function( evt ) {
                            this.document.appendStyleSheet('{{url("/vendor/storyline/core/components/css/composite-asset.css")}}');
                            this.document.appendStyleSheet('{{url("/vendor/storyline/core/components/css/composite-asset-print.css")}}');
                            this.document.appendStyleSheet('{{url("/vendor/storyline/core/components/css/materialize.css")}}' );
                            this.document.appendStyleSheet('{{url("/vendor/storyline/core/components/css/economics.css")}}');
                            this.document.appendStyleSheet( 'https://fonts.googleapis.com/icon?family=Material+Icons');
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

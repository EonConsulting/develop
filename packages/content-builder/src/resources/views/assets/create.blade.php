@extends('layouts.app')

@section('page-title')
    Create Asset
@endsection

@section('custom-styles')
    <link href="{{url('/vendor/appstore/css/radio-checkbox.css')}}" rel="stylesheet" />

    <style>
        .asset-form {
            margin: 0px 15px 0px 15px;
        }

        textarea { resize:vertical; }

    </style>
@endsection


@section('content')

    <div class="asset-form">

        <form action="#">


            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="Enter a title">
            </div>        
        
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="2" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="content">Content Block</label>

                <textarea id="ltieditorv2inst" class="ckeditor cktextarea" name="content" data-toggle="popover" data-placement="left" data-content=""></textarea>
            </div>   

            <div class="form-group">
                <label for="file">Upload a file</label>
                <input type="file" name="file" id="fileToUpload">
            </div>

            <div class="form-group">
                <label for="title">Tags (comma seperated)</label>
                <input class="form-control" type="text" name="title" placeholder="Enter tags">
            </div> 

            <div class="form-group">
                <input class="btn btn-info" type="submit" value="Save">
            </div>
        
        </form>


    </div>

    
    
    
@endsection


@section('exterior-content')   
        
@endsection


@section('custom-scripts')            
    <script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>


    <script>
    
    var config = {
        extraPlugins: 'dialog',
        toolbar: [[ 'LTIButton' ]]
    };
    
    var editor = {};

    $(function(){

        editor = CKEDITOR.replace('ltieditorv2inst', {
                extraPlugins: 'interactivegraphs,ltieditorv1,ltieditorv2,html2PDF,mathjax,dialog,xml,templates,widget,lineutils,widgetselection,clipboard',
                allowedContent: true,
                fullPage: false,
                mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG'
            }
        );

        editor.on('instanceReady', function()
        {
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

    });


    </script>
    
@endsection

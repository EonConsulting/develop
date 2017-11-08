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

        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="Enter a title">
        </div>        
    
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="2" name="description" id="description" ></textarea>
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
            <input class="form-control" type="text" name="tags" id="tags" placeholder="Enter tags">
        </div> 

        <div class="form-group">
            <a href="#" class="btn btn-info" id="submit" value="Save">Save</a>
        </div>

    </div>

{{ csrf_field() }}
@endsection


@section('exterior-content')   
        
@endsection


@section('custom-scripts')            
    <script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>


    <script>
    
    $("#submit").on("click", function(){
        save_asset();
    });


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

    function form_data(){

        var data = {
            "title": $('#title').val(),
            "description": $('#description').val(),
            "content": $('#content').val(),
            "fileToUpload": $('#fileToUpload').files[0],
            "tags": $('#tags').val()
        };

        return data;
    }

    function save_asset(){

        actionUrl = base_url + "/content/assets";

        $data = form_data();

        $.ajax({
            method: "POST",
            url: "{{ url('content/assets') }}",
            data: JSON.stringify($data),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            statusCode: {
                200: function (data) { //success
                    $("#create_name").val("");
                    $("#create_tags").val("");
                    refreshTable();
                },
                400: function () { //bad request

                },
                500: function () { //server kakked

                }
            }
        }).error(function (data) {
            console.log("Edit AJAX Broke");
        });

    }

    </script>
    
@endsection

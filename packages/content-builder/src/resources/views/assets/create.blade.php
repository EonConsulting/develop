@extends('layouts.app')

@section('page-title')
    Create Asset
@endsection

@section('custom-styles')
    <!--<link href="{{url('/vendor/appstore/css/radio-checkbox.css')}}" rel="stylesheet" />-->

    <style>
        .asset-form {
            margin: 0 15px 0 15px;
        }

        .category_checkbox {
            margin-right: 50px;
            float: left;
        }

        .checkbox {
            margin-top: 0;
        }

        textarea { resize:vertical; }

    </style>
@endsection


@section('content')

    <div class="asset-form">
        <form action="{{ url('/content/assets') }}" method="post" enctype='multipart/form-data'>

            {{ csrf_field() }}

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Enter a title" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Tags (comma seperated)</label>
                        <input class="form-control" type="text" name="tags" id="tags" placeholder="Enter tags" required>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="2" name="description" id="description" required></textarea>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">Content Block</label>
                        <textarea id="ltieditorv2inst" class="ckeditor cktextarea" name="content" data-toggle="popover" data-placement="left" data-content=""></textarea>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="assetFile">
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <label for="categories">Categories</label>
                </div>

                <div class="col-md-12">
                    <?php foreach($categories as $category): ?>
                    <div class="category_checkbox">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="categories[]" value="<?php echo $category['id']; ?>" required> <?php echo $category['name']; ?>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </div>
            </div>

        </form>
    </div>


@endsection


@section('exterior-content')   
        
@endsection


@section('custom-scripts')            
    <script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>
    <script src="{{url('/js/plupload/plupload.full.min.js')}}"></script>
    
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
            "fileToUpload": $('#fileToUpload').get().files[0],
            "tags": $('#tags').val()
        };

        return data;
    }

    function save_asset(){

        actionUrl = "/content/assets";

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

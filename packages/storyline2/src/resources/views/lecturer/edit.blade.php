@extends('layouts.app')

@section('page-title')
Storyline Student Single
@endsection


@section('custom-styles')
<link rel="stylesheet" href="{{ url('vendor/jstree-themes/bootstrap/style.css') }}" />

<style>

    .jstree-rename-input{
        color: #000 !important; 
    }

    .jstree-proton .jstree-themeicon-custom {
        width: 0px;
    }

    /*.jstree-anchor {
        color: #FFF !important;
    }*/

    .jstree-wholerow-hovered {
        background: #FB7217 !important;
    }

    .jstree-wholerow-clicked {
        background: #FB7217 !important;
    }

    /*.jstree-icon:empty {
        width: 0px;
    }*/


    /**
     *----------------------------------------------------------------------
     * Page Layout Flex Boxes
     *----------------------------------------------------------------------
     */

    .page-container {
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
        margin-top: -15px;
    }

    .page-container-tree {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 0 1 auto;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        min-width: 250px !important;
        width: 250px;
        overflow-y: auto;
        overflow-x: auto;
    }

    .page-container-editor {
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


    /**
     *----------------------------------------------------------------------
     * Edit side flex boxes
     *----------------------------------------------------------------------
     */


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
        background: #FFF;
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


    .form-title {

        border-width: 0px 0px 1px 0px;
        border-style: solid;
        border-color: #FFF;

        padding: 5px;
        margin: 5px;

        background: none;
        width: 100%;

    }

    .form-title:focus {
        border-width: 0px 0px 1px 0px;
        border-style: solid;
        border-color: #FB7217;
        outline: none;
        color: #FB7217;

    }

    .form-title::placeholder {

        color: #c3c3c3;
        font-style: italic;

    }

    .title-bar-button {
        height: 43px;
        float: right;
        background: $666;
        color: #FFF;
        border: none;
        padding: 0px 15px 0px 15px;
    }

    .title-bar-button-save {
        background: #00a65a;
    }

    .title-bar-button-save:hover {
        background: #008347;
    }

    .title-bar-button-import {
        background: #00c0ef;
    }

    .title-bar-button-import:hover {
        background: #0098bd;
    }

    .content-entry {
        width: 250px;
        height: 150px;
        margin-right: 15px;
        margin-bottom: 15px;
        float: left;
        padding: 10px;
        position: relative;
    }


    .content-entry h3 {
        font-size: 16px;
        margin-top: 0px;
        margin-bottom: 5px;
        font-weight: 700;
        color: #FB7217;
    }

    .content-entry p {
        font-size: 10px;
    }

    .content-entry button {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 12px;
    }

</style>
@endsection


@section('content')
<div>
    <div class="page-container">

        <div class="page-container-tree">

            <div id="tree">

            </div>

        </div><!--End col-md-3 -->

        <div class="page-container-editor">
            <div class="content-container">

                <div class="content-info">

                        <div class="info-bar-container">

                            <div class="info-bar-name">
                                <div>
                                    <input id="content-title" type="text" class="form-title" name="title" placeholder="Content Title" value=""/>
                                </div>
                            </div>

                            <div class="info-bar-buttons" style="text-align: right;">
                                <!-- Trigger the modal with a button -->
                                <button type="button" class="title-bar-button title-bar-button-save" data-toggle="modal" data-target="#saveModal">
                                    <i class="fa fa-save"></i>
                                    <span class="hidden-xs"> Save</span>
                                </button>

                                <button type="button" class="title-bar-button title-bar-button-import" data-toggle="modal" data-target="#importModal">
                                    <i class="fa fa-save"></i>
                                    <span class="hidden-xs"> Import</span>
                                </button>

                            </div>

                        </div> <!-- row end -->

                </div>
            

                <div class="content-editor">
                    <div class="contentBoxHeight">
                        <textarea id="ltieditorv2inst" class="ckeditor cktextarea" name="editor">
                            
                        </textarea>

                        <input type="hidden" id="data" name="data" />
                    </div>
                </div>
        
            </div>
        </div><!--End col-md-9 -->

    </div><!--End row -->

</div><!--End container-fluid -->

{{ csrf_field() }}

@endsection

@section('exterior-content')
<!-- Modal -->
<div id="saveModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Save Content</h4>
            </div>

            <div class="modal-body">
                <p>We need a bit more information from you before we can save this content</p>

                <input type="hidden" id="item-id" value="">
                <input type="hidden" id="content-id" value="">

                <div class="form-group">
                    <label for="description">Description</label>
                    <input id="content-description" type="text" class="form-control" name="description" value="">
                </div>

                <div class="form-group" id="categories">
                    <div>
                        <label for="categories[]">Categories</label>
                    </div>

                    <?php foreach($categories as $category): ?>

                    <div>
                        <label style="font-weight: 400;">
                            <input type="checkbox" name="categories[]" class="cat_check" id="cat<?php echo $category->id; ?>" value="<?php echo $category->id; ?>" >
                            <?php echo $category->name; ?>
                        </label>
                    </div>

                    <?php endforeach; ?>
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input id="content-tags" type="text" name="tags" class="form-control" id="tags" placeholder="Tags" value="">
                </div>

                <div class="validation alert alert-warning" role="alert" id="validation">

                </div>

            
            </div>

            <div class="modal-footer">
                <button id="btnsbmit" class="btn btn-primary"><i class="fa fa-save"></i><span> Save</span></button>
            </div>
        </div>

    </div>
</div>     
    

<div id="importModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Import Content</h4>
            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">

                <?php foreach($contents as $content): ?>

                    <div class="content-entry shadow">
                        <h3><?php echo $content->title; ?></h3>
                        <p><?php echo $content->description; ?></p>
                        <button class="content-import-btn" data-content-id="<?php echo $content->id; ?>">Import</button>
                    </div>


                <?php endforeach; ?>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i><span> Cancel</span></button>
            </div>
        </div>

    </div>
</div>     
@endsection

@section('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>
<script src="https://use.fontawesome.com/5154cf88f4.js"></script>

<script>
var base_url = "{{{ url('') }}}";
var url = base_url + "/storyline2/show_items/{{ $storyline_id }}";
</script>

<script src="{{ url('vendor/storyline2/editable-tree.js')}}"></script>

    
<script>
    //Dialogue Insertion Point -->

    var config = {
        extraPlugins: 'dialog',
        toolbar: [[ 'LTIButton' ]]
    };
</script>

<script>
    // resize the editor(s) while the instance is ready
    var editor = {};

    $(function(){

        editor = CKEDITOR.replace('ltieditorv2inst', {
                    extraPlugins: 'interactivegraphs,ltieditorv1,ltieditorv2,html2PDF,mathjax,dialog,xml,templates,widget,lineutils,widgetselection,clipboard',
                    allowedContent: true,
                    fullPage: false,
                    mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG',
                    
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

        {{--CKEDITOR.document.appendStyleSheet("{{URL::asset('/vendor/ckeditorpluginv2/css/custom-contents.css')}}");--}}


    });

    CKEDITOR.on('instanceReady', function() { 
        var textEditHeight      = $(".cktextarea").height();
        var ckTopHeight         = $("#cke_1_top").height();
        var ckContentsHeight    = $("#cke_1_contents").height();
        var ckBottomHeight      = $("#cke_1_bottom").height();

        $("#cke_1_contents").height( (textEditHeight - ckTopHeight - ckBottomHeight - 47) + "px");

    });

    // resize the editor(s) while resizing the browser
    $(window).resize(function(){
        var textEditHeight      = $(".cktextarea").height();
        var ckTopHeight         = $("#cke_1_top").height();
        var ckContentsHeight    = $("#cke_1_contents").height();
        var ckBottomHeight      = $("#cke_1_bottom").height();

        $("#cke_1_contents").height( (textEditHeight - ckTopHeight - ckBottomHeight - 47) + "px");

    });

</script>

<script>

    $( document ).ready(function(){

        $("#validation").hide();

        $("#btnsbmit").on("click", function(){
            console.log("Save Clicked");
            save_content_to_item();
        });

        $(".content-import-btn").on("click", function(){


        });

    });


    function import_content(){
        

    }
    
    function save_content_to_item(){

        $("#validation").hide();

        var body = editor.getData();

        var cats = $("#categories input:checkbox:checked").map(function(){
            return $(this).val();
        }).get();

        var item_id = $("#item-id").val();
        console.log(item_id);

        var data = {
            "title": $("#content-title").val(),
            "description": $("#content-description").val(),
            "body": body,
            "categories": cats,
            "tags": $("#content-tags").val(),
            "id": $("#content-id").val()
        };
    
        var validate = true;
        var invalid = {};

        for (var k in data) {
            if(k!= "id" && data[k].length < 1){
                validate = false;
                invalid[k] = data[k];
            }
        }

        
        if(validate == true) {

            actionUrl = base_url + "/storyline2/save-item-content/" + item_id;

            $.ajax({
                method: "POST",
                url: actionUrl,
                contentType: 'json',
                data: JSON.stringify(data),
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success
                        $('#saveModal').modal('hide');
                    },
                    400: function () { //bad request
        
                    },
                    500: function () { //server kakked
        
                    }
                }
            }).error(function (req, status, error) {
                alert(error);
            });

        } else {
            
            var error = "The following field are required: "

            for (var k in invalid) {
                
                error = error + "<strong>" + k + "</strong>, "
                console.log(k + " not filled");

            }   

            error = error + "please fill them in and try again."

            $("#validation").html(error);

            $("#validation").show();

        }


        


    }


</script>

@endsection

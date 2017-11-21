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

    .title-bar-button-assets {
        background: #fb7217;
    }

    .title-bar-button-assets:hover {
        background: #7c380b;
    }

    .content-entry {
        width: 250px;
        height: 150px;
        margin-right: 15px;
        margin-bottom: 15px;
        float: left;
        padding: 10px;
        position: relative;
        background: #FFF;
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
        font-size: 12px;
    }

    .content-link-btn {
        right: 10px;
    }

    .content-copy-btn {
        left: 10px;
    }

    .import-list {
        max-height: 500px;
        overflow-y: auto;
        background: #F9FAF7;
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

                        <div class="info-bar-container" id="info-bar">

                            <div class="info-bar-name">
                                <div>
                                    <input id="content-title" type="text" class="form-title" name="content-title" placeholder="Content Title" value="" data-toggle="popover" data-placement="bottom" data-content=""/>
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

                                <button class="title-bar-button title-bar-button-assets" data-toggle="modal" data-target="#assetsModal">
                                    <i class="fa fa-cube"></i>
                                    <span class="hidden-xs"> Assets</span>
                                </button>

                            </div>

                        </div> <!-- row end -->

                </div>
            

                <div class="content-editor">
                    <div class="contentBoxHeight">
                        <textarea id="ltieditorv2inst" class="ckeditor cktextarea" name="editor" data-toggle="popover" data-placement="left" data-content="">
                            
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
                    <input id="content-description" type="text" class="form-control" name="description" value="" data-toggle="popover" data-placement="left" data-content="">
                </div>

                <div class="form-group" id="categories" data-toggle="popover" data-placement="left" data-content="">
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
                    <input id="content-tags" type="text" name="tags" class="form-control" id="tags" placeholder="Tags" value="" data-toggle="popover" data-placement="left" data-content="">
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

            <div class="modal-body import-list">

                <?php foreach($contents as $content): ?>

                    <div class="content-entry shadow">
                        <h3><?php echo $content->title; ?></h3>
                        <p><?php echo $content->description; ?></p>

                        <button class="content-link-btn content-action" data-action="link" data-content-id="<?php echo $content->id; ?>">Link</button>
                        <button class="content-copy-btn content-action" data-action="copy" data-content-id="<?php echo $content->id; ?>">Copy</button>
                    </div>


                <?php endforeach; ?>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i><span> Cancel</span></button>
            </div>
        </div>

    </div>
</div>

<div id="assetsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Import Asset</h4>
            </div>

            <div class="modal-body import-list">

                <?php foreach($assets as $asset): ?>

                <div class="content-entry shadow">
                    <h3><?php echo $asset->title; ?></h3>
                    <p><?php echo $asset->description; ?></p>

                    <button class="content-copy-btn import-asset" data-asset-id="<?php echo $asset->id; ?>">Import</button>
                </div>


                <?php endforeach; ?>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-toggle="modal" data-target="#assetsModal"><i class="fa fa-save"></i><span> Cancel</span></button>
            </div>
        </div>

    </div>
</div>
@endsection

@section('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>
<script src="https://use.fontawesome.com/5154cf88f4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>

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
                contentsCss : '{{ url($course->template->file_path) }}',
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

    CKEDITOR.on('instanceReady', function() { 
        var textEditHeight      = $("#content-area").height() - $("#info-bar").height();
        var ckTopHeight         = $("#cke_1_top").height();
        var ckContentsHeight    = $("#cke_1_contents").height();
        var ckBottomHeight      = $("#cke_1_bottom").height();

        $("#cke_1_contents").height( (textEditHeight - ckTopHeight - ckBottomHeight - 11) + "px");

    });

    // resize the editor(s) while resizing the browser
    $(window).resize(function(){
        var textEditHeight      = $("#content-area").height() - $("#info-bar").height();
        var ckTopHeight         = $("#cke_1_top").height();
        var ckContentsHeight    = $("#cke_1_contents").height();
        var ckBottomHeight      = $("#cke_1_bottom").height();

        $("#cke_1_contents").height( (textEditHeight - ckTopHeight - ckBottomHeight - 11) + "px");

    });

</script>

<script>

    $( document ).ready(function(){

        $("#validation").hide();

        $("#btnsbmit").on("click", function(){
            save_content_to_item();
        });

        $(".content-action").on("click", function(){

            $content_id = $(this).data("content-id");
            $item_id = $("#item-id").attr('value');
            $action = $(this).data("action");

            import_content($content_id,$item_id,$action);
        });

        $(".import-asset").on("click", function () {

            $asset_id = $(this).data("asset-id");

            importAsset($asset_id);
        });

    });

    function importAsset(asset){

        actionUrl = base_url + "/content/assets/" + asset;

        $.ajax({
            method: "GET",
            url: actionUrl,
            contentType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            statusCode: {
                200: function (data) { //success
                    if(data['content'] !== null){
                        CKEDITOR.instances['ltieditorv2inst'].insertHtml('<p>' + data['content'] + '</p>');
                    }
                    var html = data['html'];
                    CKEDITOR.instances['ltieditorv2inst'].insertHtml(html);

                    $('#assetsModal').modal('hide');

                },
                400: function () { //bad request

                },
                500: function () { //server kakked

                }
            }
        }).error(function (req, status, error) {
            alert(error);
        });

    }

    var valid = {
        "title_length": false,
        "title_unique": false,
        "description": false,
        "tags": false,
        "content": false,
        "categories": false
    };

    //Delete Node Action
    $(tree_id).on("delete_node.jstree", function (e, data) {
        console.log(data.node.id);
        deleteNode(data.node.id);
    });

    //Rename Node Action
    $(tree_id).on("rename_node.jstree", function (e, data) {
        var ref = data.node;
        renameNode(ref);
    });

    //Move Node Action
    $(tree_id).on("move_node.jstree", function (e, data) {
        console.log(data);
        var ref = {
            node: data.node,
            position: data.position,
            old_position: data.old_position
        };
        console.log(ref);
        moveNode(ref);
    });

    //Create Node Action
    $(tree_id).on("create_node.jstree", function (e, data) {
        var ref =  data.node;
        createNode(ref);
    });

    //Select Node Action
    $(tree_id).on("changed.jstree", function (e, data) {
        $("#item-id").val(data.node.id);

        $(".cat_check").prop('checked', false);
        $("#content-id").val("");
        $("#content-title").val("");
        $("#content-description").val("");
        $("#content-tags").val("");

        var body = editor.setData("");

        var ref = data.node;
        getContent(ref);

        for (var item in valid){
            item = false;
        }

        $("#content-title").popover("hide");
        $("#content-body").popover("hide");
        $("#content-description").popover("hide");
        $("#categories").popover("hide");
        $("#content-tags").popover("hide");

    });

    //--form validation----------------------------------------------------

    //update events
    $("#content-title").change(function(){
        validate_title();
    });

    $("#content-description").change(function(){
        validate_description();
    });

    $("#ltieditorv2inst").change(function(){
        validate_content();
    });

    $("#categories input:checkbox").change(function(){
        validate_categories();
    });

    $("#content-tags").change(function(){
        validate_tags();
    });


    function validate_all(){
        validate_title();
        validate_description();
        validate_categories();
        validate_body();
        validate_tags();
    }


    //check title is at least 4 characters long and unique
    function validate_title(){

        var element = $("#content-title");
        var title = element.val();

        if(title.length < 4){

            console.log("Title not long enough.")
            valid["title_length"] = false;
            show_error(element,"This title isn't long enough. Please enter a title that is at least 4 characters long.");

        } else {

            valid["title_length"] = true;

            var actionUrl = base_url + "/content/content-title-exists";

            $.ajax({
                method: "POST",
                url: actionUrl,
                contentType: 'json',
                data: JSON.stringify({"title": title}),
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success
                        
                        if(data && data.exists === true){
                            valid["title_unique"] = false;
                            console.log("Title not unique.");
                            show_error(element,"This title already exists. Please enter a unique title.");
                        } else {
                            valid["title_unique"] = true;
                            console.log("name doesn't exist");
                            element.popover("hide");
                        }

                    },
                    400: function () { //bad request
        
                    },
                    500: function () { //server kakked
        
                    }
                }
            }).error(function (req, status, error) {
                alert(error);
            });

        }
        
    }

    //check that at least one category has been chosen
    function validate_categories(){

        var element = $('#categories');
        var cats = $("#categories input:checkbox:checked").map(function(){
            return $(this).val();
        }).get();

        if(cats.length < 1){
            valid["categories"] = false;
            show_error(element,"Please select at least one category.");
        } else {
            valid["categories"] = true;
            element.popover("hide");
        }

    }

    //check if body is the same as any other
    function validate_body(){

        var element = $('#ltieditorv2inst');
        var body = editor.getData();

        if(body.length < 4){
            valid["content"] = false;
            show_error(element,"You have not added enough content. You need to add at least 4 characters.");
        } else {
            valid["content"] = true;
            element.popover("hide");
        }

    }

    //check if description is longer than 4 characters
    function validate_description(){

        var element = $("#content-description");
        var description = element.val()

        if(description.length < 4){
            valid["description"] = false;
            show_error(element,"You have not added enough content. You need to add at least 4 characters.");
        } else {
            valid["description"] = true;
            element.popover("hide");
        }

    }

    //check if tags has been filled in
    function validate_tags(){

        var element = $("#content-tags");
        var tags = element.val()

        if(tags.length < 4){
            valid["tags"] = false;
            show_error(element,"You have not added enough content. You need to add at least 4 characters.");
        } else {
            valid["tags"] = true;
            element.popover("hide");
        }

    }

    function check_for_id(){
        var id = $("#content-id").val();
        return id;
    }

    //pop up error
    function show_error(element,message){
        element.attr('data-content', message);
        element.popover("show");
    }

    //get content information from form
    function get_content_details(){

        var body = editor.getData();

        var cats = $("#categories input:checkbox:checked").map(function(){
            return $(this).val();
        }).get();
    
        var data = {
            "title": $("#content-title").val(),
            "description": $("#content-description").val(),
            "body": body,
            "categories": cats,
            "tags": $("#content-tags").val(),
            "id": $("#content-id").val()
        };

        var item_id = $("#item-id").val();

        return data;

    }

    function validation(){

        for(var item in valid){
            if(item === false){
                return false;
            }
        }

        return true;

    }


    function save_content_to_item(){

        $("#validation").hide();

        var data = get_content_details();
        var item_id = $("#item-id").attr('value');
        
        validate_all();

        if(validation() === true) {

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
            
            var error = "There are problems with the content you are trying to save. Please fix them and try again.";

            $("#validation").html(error);

            $("#validation").show();

        }

    }


</script>

@endsection

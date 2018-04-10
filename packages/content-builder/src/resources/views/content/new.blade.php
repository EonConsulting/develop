@extends('layouts.app')

@section('page-title')
Storyline Student Single
@endsection


@section('custom-styles')
<link rel="stylesheet" href="{{ url('vendor/jstree-themes/bootstrap/style.css') }}" />
<link rel="stylesheet" href="{{ url('css/content-templates/default.css') }}" />

<style>


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

    .content-copy-btn {
        left: 10px;
    }

    .import-list {
        max-height: 500px;
        overflow-y: auto;
        background: #F9FAF7;
    }

    .tools {
        margin: -15px 0 0 0;
        background: #FFF;
        border-width: 0px 0px 1px 0px;
        border-color: #d3d3d3;
        border-style: solid;
        padding: 5px;
        min-height: 35px;
    }

    .tools .sp {
        height: 18px;
        border-width: 0px 1px 0px 0px;
        border-color: #d3d3d3;
        border-style: solid;
        width: 15px;
        margin-right: 15px;
        display: inline-block;
    }

    .tools .btn {
        border-radius: 0;
        border: none;
        color: #fb7217;

    }

    .tools-divider {
        display: inline-block;
        height: 25px;
        width: 10px;
        border-width: 0 1px 0 0;
        border-color: #e0e0e0;
        border-style: solid;
        margin: 5px 10px 0 0;
    }

    #save-status {
        padding-top: 6px;
        margin-right: 12px;
        font-style: italic;
    }

</style>
@endsection


@section('content')

<div class="tools" id="tools">

    <span><a class="btn btn-default previewModal"><i class="fa fa-eye"></i> Preview</a></span>

    <span class="pull-right"><a class="btn btn-default" href="javascript:void();" data-toggle="modal" data-target="#saveModal"><i class="fa fa-save"></i> Save</a></span>
    <span class="pull-right" id="save-status"></span>
    <span class="tools-divider pull-right"></span>
    <span class="pull-right"><a class="btn btn-default" href="javascript:void();" data-toggle="modal" data-target="#importModal"><i class="fa fa-list"></i> Import Content</a></span>
    <span class="pull-right"><a class="btn btn-default" href="javascript:void();" data-toggle="modal" data-target="#assetsModal"><i class="fa fa-cube"></i> Import Asset</a></span>
</div>

<div class="page-container">

    <div class="page-container-editor">
        <div class="content-container">

            <div class="content-info">

                    <div class="info-bar-container" id="info-bar">

                        <div class="info-bar-name">
                            <div>
                                <input id="content-title" type="text" class="form-title" name="content-title" placeholder="Content Title" value="" data-toggle="popover" data-placement="bottom" data-content=""/>
                            </div>
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

<div id="previewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content content-body">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Preview Content</h4>
            </div>

            <div class="modal-body content-preview" id="content-preview">

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-toggle="modal" data-target="#previewModal"><i class="fa fa-save"></i><span> Close</span></button>
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

                        <button class="content-copy-btn content-action" data-content-id="<?php echo $content->id; ?>">Copy</button>
                    </div>


                <?php endforeach; ?>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-toggle="modal" data-target="#importModal"><i class="fa fa-save"></i><span> Cancel</span></button>
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
<script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('/js/ckeditor-pages-common.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS-MML_SVG"></script>

<script>
var base_url = "{{{ url('') }}}";
</script>

    
<script>
    //Dialogue Insertion Point -->
    var config = {
        extraPlugins: 'dialog',
        toolbar: [[ 'LTIButton' ]]       
    };
</script>


<script>

    // resize the editor(s) while resizing the browser
    $(window).resize(function(){
        resize();
    });

    function resize(){
        var areaHeight = $("#content-area").height();
        var toolsHeight = $("#tools").height();
        var textEditHeight      = areaHeight - toolsHeight - $("#info-bar").height();
        var ckTopHeight         = $("#cke_1_top").height();
        var ckBottomHeight      = $("#cke_1_bottom").height();

        $("#cke_1_contents").height( (textEditHeight - ckTopHeight - ckBottomHeight - 21) + "px");
        $(".content-container").height(areaHeight - toolsHeight - 11);
    }

</script>

<script>

    var saved = true;
    var content_id = "{{ $content_id }}";

    $(document).ready(function(){

        $("#validation").hide();

        $("#btnsbmit").on("click", function(){
            validate_all(true);
        });

        $(".content-action").on("click", function(){
            $cont_id = $(this).data("content-id");
            getContent($cont_id);
        });

        $(".import-asset").on("click", function () {
            $asset_id = $(this).data("asset-id");
            importAsset($asset_id);
        });

        if(content_id !== "new"){
            getContent(parseInt(content_id));
        }
        
        check_save();
        
       $(".previewModal").on("click",function(){
          $("#previewModal").modal();
            $.ajax({
                   url: "{{ url('/content/preview') }}"+"/{{$courseId}}",
                   type: "GET",
                   beforeSend: function () {
                   $('.content-preview').text("Loading.....");
                   },
                   success: function (data, textStatus, jqXHR) {
                   $(".content-preview").html(data);
                   },
                   error: function (jqXHR, textStatus, errorThrown) {
                                     
                  }
           });
       }); 
    });

    window.onbeforeunload = function(evt) {
        if(!saved){
            return true;
        }
    }

    var editor = init_editor('ltieditorv2inst');

    editor.on('instanceReady', function()
    {
        body = editor.document.getBody();
        body.setAttribute( 'class', 'content-body');

        resize();
    });

    editor.on('change', function() {
        saved = false;
        check_save();
    });

    function check_save(){
        if(saved === true){
            $("#save-status").html('All changes saved.');
        }else{
            $("#save-status").html('Changes not saved.');
        }
    }

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

    function populateContentForm(data) {

        console.log("populateContentForm called");

        var course_data = data;

        $("#content-id").val(course_data.id);
        $("#content-title").val(course_data.title);
        $("#content-description").val(course_data.description);
        $("#content-tags").val(course_data.tags);

        console.log(course_data.body);
        editor.setData(course_data.body);

        $('div#saveModal input[class="cat_check"]').each(function(index)
        {
            $(this).prop('checked', false);
        });

        for (index = 0; index < course_data.categories.length; ++index) {
            cat_id = "#cat" + course_data.categories[index].id;
            console.log(cat_id);
            $(cat_id).prop('checked', true);
        }

    }

    //Get Content
    function getContent(content) {

        //console.log("getContent called");
        //console.log(item_id);

        actionUrl = base_url + "/content/show/" + content;

        $.ajax({
            method: "GET",
            url: actionUrl,
            contentType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            statusCode: {
                200: function (data) { //success
                    populateContentForm(data);
                    $('#importModal').modal('hide');
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

    //--form validation----------------------------------------------------

    //update events
    //TODO: change to $(document).on('click')... style

    $(document).on('change', '#content-title', function(){
        saved = false;
        check_save();
        //validate_title();
    });
    

    $(document).on('change', "#content-description", function(){
        validate_description();
        saved = false;
        check_save();
    });

    $(document).on('change', "#ltieditorv2inst", function(){
        validate_content();
        saved = false;
        check_save();
    });

    $(document).on('change', "#categories input:checkbox", function(){
        validate_categories();
        saved = false;
        check_save();
    });

    $(document).on('change', "#content-tags", function(){
        validate_tags();
        saved = false;
        check_save();
    });


    function validate_all(save = false){
        validate_title_first(save);
    }

    function then_validate_others(save = false){
        validate_description();
        validate_categories();
        validate_body();
        validate_tags();

        if(save){
            save_content();
        }
    }


    //check title is at least 4 characters long and unique
    function validate_title_first(save = false){

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

                        if(data.id === content_id){
                            valid["title_unique"] = true;
                            console.log("name doesn't exist");
                            element.popover("hide");
                        }else{
                            valid["title_unique"] = false;
                            console.log("Title not unique.");
                            show_error(element,"This title already exists. Please enter a unique title.");
                        }

                        then_validate_others(save);

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



    function save_content(){

        //var data = get_content_details();
        var form_data = get_content_details();
        
        if(validation() === true) {

            actionUrl = base_url + "/content/store";

            $.ajax({
                method: "POST",
                url: actionUrl,
                data: form_data,

                //contentType: 'json',
                //data: JSON.stringify(data),
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                    200: function (data) { //success

                        $("#content-id").val(data.id);
                        content_id = data.id;

                        saved = true;
                        check_save();

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

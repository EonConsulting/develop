@extends('layouts.app')

@section('page-title')
Storyline Student Single
@endsection


@section('custom-styles')
<link rel="stylesheet" href="{{ url('vendor/jstree-themes/bootstrap/style.css') }}" />
<link rel="stylesheet" href="{{ url('js/resizer/resizer.css') }}" />

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

    .flex-container {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
    }

    .flex-menu {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        overflow-y: auto;
        max-width: 350px;

    }

    .flex-content {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        width: 70%;
        overflow-y: auto;
        overflow-x: auto;

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
        flex: 1;
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


    .search-container {
        margin: 0 auto 0 auto;
    }

    .form-title {

        border-width: 0px 0px 1px 0px;
        border-style: solid;
        border-color: #FFF;

        padding: 5px;

        background: none;

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
        background: #666;
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

    .highlighted{
        font-weight: bold;   
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

    .disabled {
        color: #999;
    }
    
    .dropdown {
        display: inline-block;
    }

    {!! array_get($course, 'template.css', '') !!}
    
    /* inject any additional custom_css */
    {!! array_get($course, 'template.custom_css', '') !!}

</style>
@endsection


@section('content')

<div class="tools" id="tools">
    
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa fa-file-text"></i><span class="hidden-xs hidden-md"> File</span>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="javascript:void();" data-toggle="modal" data-target="#saveModal"><i class="fa fa-save"></i> Save</a></li>
            <li><a href="#" id="d-pdf"><i class="fa fa-file-pdf-o"></i> Download PDF</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" data-toggle="modal" data-target="#previewModal"><i class="fa fa-eye"></i> Preview</a></li>
        </ul>
    </div>

    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa fa-download"></i><span class="hidden-xs hidden-md"> Import</span>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <li><a href="javascript:void();" data-toggle="modal" data-target="#importModal"><i class="fa fa-list"></i> Import Content</a></li>
            <li><a href="javascript:void();" data-toggle="modal" data-target="#assetsModal"><i class="fa fa-cube"></i> Import Asset</a></li>
        </ul>
    </div>

    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa fa-wrench"></i><span class="hidden-xs hidden-md"> Tools</span>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <li><a href="javascript:void();" id="auditing-index"><i class="fa fa-history"></i> Audit Log</a></li>
            <li><a class="p-check" href="javascript:void();"><i class="fa fa-low-vision"></i> Plagiarism Checker</a></li>
            <li><a class="white-b" href="javascript:void();"><i class="fa fa-external-link"></i> Whiteboard</a></li>
        </ul>
    </div>

    <span class="search-container pull-right">
        <input id="q" type="text" class="form-title" name="s" placeholder="Search" value="" data-toggle="popover" data-placement="bottom" data-content=""/>
        <a href="#" class="btn btn-default" id="search"><i class="fa fa-search"></i></a>
        <a href="#" class="btn btn-default disabled" id="prev-result"><i class="fa fa-caret-left"></i></a>
        <span id="search_numbers">0 / 0</span>
        <a href="#" class="btn btn-default disabled" id="next-result"><i class="fa fa-caret-right"></i></a>
    </span>

    
</div>

<div class="flex-container resizer">

    <div class="flex-menu">
        <div class="info-bar-name">
            <div>
                                                
            </div>
        </div>

        <div id="tree">

        </div>

    </div><!--End flex-menu -->

    <div class="flex-content">
        <div class="content-container">

                <div class="content-info">

                    <div class="alert alert-danger" role="alert" style="border-radius:0px;margin-bottom:0; display:none;" id="pdf-generation-alert">

                        <p class="text-area"></p>

                        <a href="#" data-toggle="modal" data-id="" data-target="#pdf-generation-modal">More Info</a>

                    </div>

                    <div class="info-bar-container" id="info-bar">

                        <div class="info-bar-name">
                            <div>
                                <input id="content-title" style="width: 100%;" type="text" class="form-title" name="content-title" placeholder="Content Title" value="" data-toggle="popover" data-placement="bottom" data-content=""/>
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

    </div><!--End flex-content -->

</div><!--End flexbox-container -->

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

                <p>Student Progression</p>
                <div class="form-group">
                    <label for="selectNode">Set page prerequisite:</label>
                    <select id="selectNode" class="form-control">
                        <option value="">--Choose One--</option>
                    </select>  
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

<div id="msgModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      <div class="msg-info"></div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="whiteModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" >    
            <!--<div style="width: 500px;height: 500px" id="aww-wrapper"></div>-->    
        <!-- <iframe width="100%" height="600px" frameBorder="0" src="https://app.learn-cube.com/clases/dev5/demo/"></iframe> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>    
</div>

<div id="unsavedModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
        
            <div class="modal-body" >    
                You have unsaved changes!
            </div>
            <div class="modal-footer">
                <a href="#" id="discard_changes" class="btn btn-info">Discard Changes</a>
                <a href="#" data-toggle="modal" data-target="#unsavedModal" class="btn btn-info">Go Back</a>
            </div>
        </div>
    </div>    
</div>

@endsection

@include('auditing::popup')
@include('exports::storyline-export-problems')
@include('exports::lecturer-storyline-pdf-download')
@include('eon.content-builder::ajax-search.assets-modal')
@include('eon.content-builder::ajax-search.content-modal')

@section('custom-scripts')

<script src="{{ url('js/resizer/resizer.js') }}"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src="{{url('/vendor/ckeditorpluginv2/ckeditor/ckeditor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS-MML_SVG"></script>

<script src="{{url('/js/ckeditor-pages-common.js')}}"></script>
<script>
    var course_id = "{{ $course_id }}";
    var storyline_id = "{{ $storyline_id }}";
    var base_url = "{{ url('') }}";
    var css = "{{ $course['template']['css'] }}";
    var copyleak_url = "{{ url('student/copyleaks') }}";
    var csrf_token = "{{ csrf_token() }}";
</script>
<script src="{{ url('js/storyline.js')}}"></script>

@endsection
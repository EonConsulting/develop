@extends('layouts.app')

<!-- ============================================================================= -->

@section('page-title')
    Template Designer
@endsection

<!-- ============================================================================= -->

@section('custom-styles')

    <link rel="stylesheet" href="{{ url('css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <style id="preview-styles">

    </style>

    <style>
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
            margin: -15px 0 0 0;
        }
        
        .preview-pane {
            -webkit-order: 0;
            -ms-flex-order: 0;
            order: 0;
            -webkit-flex: 1 1 auto;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            -webkit-align-self: stretch;
            -ms-flex-item-align: stretch;
            align-self: stretch;
            background: #f9f9f9;
            padding: 15px;
            overflow-y: auto;
        }
        
        .design-pane {
            width: 350pt;
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
            padding: 15px;
        }

        .design-pane-item {
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
            padding-bottom: 10px;
            margin-bottom: 10px;

            border-bottom: 1px solid #efefef;
        }

        .form-control {
            font-size: 12px;
        }
        
        .design-pane-item-title {
            -webkit-order: 0;
            -ms-flex-order: 0;
            order: 0;
            -webkit-flex: 0 1 auto;
            -ms-flex: 0 1 auto;
            flex: 0 1 auto;
            -webkit-align-self: stretch;
            -ms-flex-item-align: stretch;
            align-self: stretch;
            width: 60pt;
            font-weight: bold;
        }
        
        .design-pane-item-settings {
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

        .colorpicker-component {
            width: 100pt;
            float: left;
            margin: 0 5px 0 0;
            /*display: inline-block;*/
        }

        /*----Spinner Styles-------*/

        .spinner {
            width: 60px;
            margin: 0 5px 0 0;
            float: left;
            /*display: inline-block;*/
        }
        .spinner input {
            text-align: right;
        }
        .input-group-btn-vertical {
            position: relative;
            white-space: nowrap;
            width: 1%;
            vertical-align: middle;
            display: table-cell;
        }
        .input-group-btn-vertical > .btn {
            display: block;
            float: none;
            width: 100%;
            max-width: 100%;
            padding: 8px;
            margin-left: -1px;
            position: relative;
            border-radius: 0;
        }
        .input-group-btn-vertical > .btn:first-child {
            border-top-right-radius: 4px;
        }
        .input-group-btn-vertical > .btn:last-child {
            margin-top: -2px;
            border-bottom-right-radius: 4px;
        }
        .input-group-btn-vertical i{
            position: absolute;
            top: 0;
            left: 4px;
        }

        .btn-setting-toggle {
            width: 36px;
        }

        .btn-setting-group {
            /*display: inline-block;*/
        }

        .settings-line {
            overflow-y: auto;
            margin-bottom: 5px;
        }

        .spinner-container {
            overflow-y: auto;
            float: left;
        }

        .spinner-container .spinner {
            float: none;
        }

        .spinner-label {
            font-size: 12px;
            margin: 0 0 0 10px;
        }

        .settings-dropdown {
            float: left;
            margin: 0 5px 0 0;
        }

        .settings-line-label {
            float: left;
            margin: 8px 0 0 0;
            width: 50px;
            font-size: 12px;
            text-align: right;
            padding: 0 5px 0 0;
        }

        .preview-item {
            margin-bottom: 15px;
            padding: 5px;
            border: 1px solid #f9f9f9;
        }

        .preview-item:hover {
            border: 1px solid #ededed;
            background: #f2f2f2;
            cursor: pointer;
        }

        .active {
            background: #efefef;
            border: 1px solid #e0e0e0;
        }

        .preview-item-name {
            font-weight: 700;
            padding: 15px 0 0 15px;
        }

        .preview-item-preview {
            padding: 15px;
            background: #fff;
        }


    </style>

@endsection

<!-- ============================================================================= -->

@section('content')

    <div class="page-container" id="page">

        <div class="preview-pane">
            
            <div class="content-body">

                <div class="preview-item active" data-element=".title">
                    <div class="preview-item-name">
                        Title
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="title">Title Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".subtitle">
                    <div class="preview-item-name">
                        Sub Title
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="subtitle">Subtitle Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element="h1">
                    <div class="preview-item-name">
                        Heading 1
                    </div>
                    <div class="preview-item-preview shadow">
                        <h1>Heading 1 Example</h1>
                    </div>
                </div>

                <div class="preview-item" data-element="h2">
                    <div class="preview-item-name">
                        Heading 2
                    </div>
                    <div class="preview-item-preview shadow">
                        <h2>Heading 2 Example</h2>    
                    </div>
                </div>

                <div class="preview-item" data-element="h3">
                    <div class="preview-item-name">
                        Heading 3
                    </div>
                    <div class="preview-item-preview shadow">
                        <h3>Heading 3 Example</h3>
                    </div>
                </div>

                <div class="preview-item" data-element="h4">
                    <div class="preview-item-name">
                        Heading 4
                    </div>
                    <div class="preview-item-preview shadow">
                        <h4>Heading 4 Example</h4>
                    </div>
                </div>

                <div class="preview-item" data-element="p">
                    <div class="preview-item-name">
                        Paragraph
                    </div>
                    <div class="preview-item-preview shadow">
                        <p>Text example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".quote">
                    <div class="preview-item-name">
                        Quote
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="quote">Quote Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".self_assessment">
                    <div class="preview-item-name">
                        Self Assessment
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="self_assessment">Self Assessment Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".video">
                    <div class="preview-item-name">
                        Video
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="video">Video Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".graph">
                    <div class="preview-item-name">
                        Graph
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="graph">Graph Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".text">
                    <div class="preview-item-name">
                        Text
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="text">Text Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".equation">
                    <div class="preview-item-name">
                        Equation
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="equation">Equation Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".activity">
                    <div class="preview-item-name">
                        Activity
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="activity">Activity Example</p>
                    </div>
                </div>

                <div class="preview-item" data-element=".image">
                    <div class="preview-item-name">
                        Image
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="image">Image</p>
                    </div>
                </div>
                
                <div class="preview-item" data-element=".final_assessment">
                    <div class="preview-item-name">
                        Final Assessment
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="final_assessment">Final Assessment Example</p>
                    </div>
                </div>
                
                <div class="preview-item" data-element=".chain">
                    <div class="preview-item-name">
                        Chain
                    </div>
                    <div class="preview-item-preview shadow">
                        <p class="chain">Chain Example</p>
                    </div>
                </div>
                
            </div>


        </div>

        <div class="design-pane">
            <h3>Settings</h3>

            <form action="#" class="form-inline"></form>

            <input type="hidden" name="element" id="current-element" value="h1">

            <div class="design-pane-item">
                <div class="design-pane-item-title">
                    Text
                </div>
                <div class="design-pane-item-settings">
                    
                    <div class="settings-line">

                        <div id="text-color" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" name="color" width="8"/>
                        </div>

                        <div class="input-group spinner spinner-font-size">
                            <input type="text" class="form-control" value="16" id="font-size" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <span class="btn-group btn-setting-group" data-toggle="buttons">
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="checkbox" name="bold" autocomplete="off"><b>B</b>
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="checkbox" name="italic" autocomplete="off"><i>I</i>
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="checkbox" name="underline" autocomplete="off"><u>U</u>
                            </label>
                        </span>

                    </div>

                    <div class="settings-line">

                        <span class="btn-group btn-setting-group" data-toggle="buttons">
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" name="transform" value="sentence" autocomplete="off">Tt
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" name="transform" value="allcaps" autocomplete="off">TT
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" name="transform" value="smallcaps" autocomplete="off">T<small>T</small>
                            </label>
                        </span>

                        <span class="btn-group btn-setting-group" data-toggle="buttons">
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" name="align" value="left" autocomplete="off"><i class="fa fa-align-left"></i>
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" name="align" value="center" autocomplete="off"><i class="fa fa-align-center"></i>
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" name="align" value="right" autocomplete="off"><i class="fa fa-align-right"></i>
                            </label>
                        </span>

                    </div>

                </div>

            </div>

            <div class="design-pane-item">
                <div class="design-pane-item-title">
                    Highlight
                </div>
                <div class="design-pane-item-settings">
                    <div class="settings-line">

                        <div id="background" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" name="background" width="8"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="design-pane-item">
                <div class="design-pane-item-title">
                    Padding
                </div>
                <div class="design-pane-item-settings">

                    <div class="spinner-container">
                        <span class="spinner-label">Top</span>
                        <div class="input-group spinner">
                            <input type="text" class="form-control padding" value="16" name="padding-top">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="spinner-container">
                        <span class="spinner-label">Right</span>
                        <div class="input-group spinner">
                            <input type="text" class="form-control padding" value="16" name="padding-right">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="spinner-container">
                        <span class="spinner-label">Bottom</span>
                        <div class="input-group spinner">
                            <input type="text" class="form-control padding" value="16" name="padding-bottom">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="spinner-container">
                        <span class="spinner-label">Left</span>
                        <div class="input-group spinner">
                            <input type="text" class="form-control padding" value="16" name="padding-left">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="design-pane-item">
                <div class="design-pane-item-title">
                    Border
                </div>
                <div class="design-pane-item-settings">

                    <div class="settings-line">

                        <span class="settings-line-label">Top</span>

                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="0" name="border-top-width">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <div class="settings-dropdown">
                            <select class="form-control dropdown" name="border-top-style">
                                <option value="none">None</option>
                                <option value="dotted">Dotted</option>
                                <option value="dashed">Dashed</option>
                                <option value="solid">Solid</option>
                                <option value="double">Double</option>
                                <option value="groove">Groove</option>
                                <option value="ridge">Ridge</option>
                                <option value="inset">Inset</option>
                                <option value="outset">Outset</option>
                            </select>
                        </div>

                        <div id="border-top-color" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" name="border-top-color" width="8"/>
                        </div>

                    </div>

                    <div class="settings-line">

                        <span class="settings-line-label">Right</span>

                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="0" name="border-right-width">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <div class="settings-dropdown">
                            <select class="form-control dropdown" name="border-right-style">
                                <option value="none">None</option>
                                <option value="dotted">Dotted</option>
                                <option value="dashed">Dashed</option>
                                <option value="solid">Solid</option>
                                <option value="double">Double</option>
                                <option value="groove">Groove</option>
                                <option value="ridge">Ridge</option>
                                <option value="inset">Inset</option>
                                <option value="outset">Outset</option>
                            </select>
                        </div>

                        <div id="border-right-color" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" name="border-right-color" width="8"/>
                        </div>

                    </div>

                    <div class="settings-line">

                        <span class="settings-line-label">Bottom</span>

                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="0" name="border-bottom-width">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <div class="settings-dropdown">
                            <select class="form-control dropdown" name="border-bottom-style">
                                <option value="none">None</option>
                                <option value="dotted">Dotted</option>
                                <option value="dashed">Dashed</option>
                                <option value="solid">Solid</option>
                                <option value="double">Double</option>
                                <option value="groove">Groove</option>
                                <option value="ridge">Ridge</option>
                                <option value="inset">Inset</option>
                                <option value="outset">Outset</option>
                            </select>
                        </div>

                        <div id="border-bottom-color" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" name="border-bottom-color" width="8"/>
                        </div>

                    </div>

                    <div class="settings-line">

                        <span class="settings-line-label">Left</span>

                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="0" name="border-left-width">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <div class="settings-dropdown">
                            <select class="form-control dropdown" name="border-left-style">
                                <option value="none">None</option>
                                <option value="dotted">Dotted</option>
                                <option value="dashed">Dashed</option>
                                <option value="solid">Solid</option>
                                <option value="double">Double</option>
                                <option value="groove">Groove</option>
                                <option value="ridge">Ridge</option>
                                <option value="inset">Inset</option>
                                <option value="outset">Outset</option>
                            </select>
                        </div>

                        <div id="border-left-color" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" name="border-left-color" width="8"/>
                        </div>

                    </div>
                </div>

            </div>

            <button class="btn btn-info pull-right" data-toggle="modal" data-target="#saveModal">Save</button>

            {{ Form::close() }}

        </div>

    </div>

@endsection

<!-- ============================================================================= -->

@section('exterior-content')

<div id="saveModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Save Template</h4>
            </div>

            <div class="modal-body import-list">

                <div class="form-group">
                    <label for="name">Template Name</label>
                    <input class="form-control" type="text" name="name" value="{{ $template['name'] or '' }}">
                </div>
                

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" id="btn-save"><i class="fa fa-save"></i><span> Save</span></button>
            </div>
        </div>

    </div>
</div>


@endsection

<!-- ============================================================================= -->

@section('custom-scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ url('js/bootstrap-colorpicker.min.js') }}"> </script>
    <script>

        $default = {
            ".title": {
                "color": "#4d4d4d",
                "font-size": "32px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "uppercase",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "0",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "0",
                "border-left-style": "none",
                "border-left-color": "none"
            },
            ".subtitle": {
                "color": "#949494",
                "font-size": "24px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "uppercase",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "0",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "0",
                "border-left-style": "none",
                "border-left-color": "none"
            },
            "h1": {
                "color": "#002f66",
                "font-size": "28px",
                "font-weight": "bold",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "uppercase",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "0",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "1",
                "border-bottom-style": "solid",
                "border-bottom-color": "#002f66",
                "border-left-width": "0",
                "border-left-style": "none",
                "border-left-color": "none"
            },
            "h2": {
                "color": "#f6921e",
                "font-size": "24px",
                "font-weight": "bold",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "uppercase",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "0",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "o",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "0",
                "border-left-style": "none",
                "border-left-color": "none"
            },
            "h3": {
                "color": "#a80f14",
                "font-size": "20px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "uppercase",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "0",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "0",
                "border-left-style": "none",
                "border-left-color": "none"
            },
            "h4": {
                "color": "#4d4d4d",
                "font-size": "18px",
                "font-weight": "bold",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "uppercase",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "0",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "0",
                "border-left-style": "none",
                "border-left-color": "none"
            },
            "p": {
                "color": "#000000",
                "font-size": "14px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "0",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "0",
                "border-left-style": "none",
                "border-left-color": "none"
            },
            ".quote": {
                "color": "#666",
                "font-size": "14px",
                "font-weight": "normal",
                "font-style": "italic",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "0",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "0",
                "border-left-style": "none",
                "border-left-color": "none"
            },
            ".self_assessment": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#71bf49"
            },
            ".video": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#0077c7"
            },
            ".graph": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#da7a1d"
            },
            ".text": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#cbac6f"
            },
            ".equation": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#664139"
            },
            ".activity": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#009576"
            },
            ".image": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#b82c2d"
            },
            ".final_assessment": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#172652"
            },
            ".chain": {
                "color": "#000000",
                "font-size": "16px",
                "font-weight": "normal",
                "font-style": "normal",
                "text-decoration": "none",
                "text-transform": "none",
                "font-variant": "normal",
                "text-align": "left",
                "background": "none",
                "padding-top": "0",
                "padding-right": "0",
                "padding-bottom": "0",
                "padding-left": "15px",
                "border-top-width": "0",
                "border-top-style": "none",
                "border-top-color": "none",
                "border-right-width": "0",
                "border-right-style": "none",
                "border-right-color": "none",
                "border-bottom-width": "0",
                "border-bottom-style": "none",
                "border-bottom-color": "none",
                "border-left-width": "3px",
                "border-left-style": "solid",
                "border-left-color": "#777777"
            }
        };

        $styles = {};

        function resizeArea(){
            var areaHeight = $("#content-area").height();
            var toolsHeight = $("#tools").height();
            $("#page").height(areaHeight - toolsHeight);
        }

        function update_styles(){

            $style_string = '';

            $.each($styles, function(element,styles){

                $style_string += '.preview-item-preview ' + element + ' {';

                $.each(styles, function(style,value){
                    $style_string += style + ': ' + value + ';';
                });

                $style_string += '}';

            });

            //console.log($style_string);

            $('#preview-styles').html($style_string);

        }

        function edit_style_from_input(element,style,value){
            $styles[element][style] = value;
            update_styles();
        }

        function reset_to_default_styles(){
            $styles = $default;
            update_styles();
        }

        $(document).ready(function(){
            resizeArea();
            $('#text_color,#highlight_color,#border_top_color,#border_right_color,#border_bottom_color,#border_left_color').colorpicker({
                format: "hex"
            });


            var edit_styles = '{{ $template['styles'] or ''}}';
            
            if(edit_styles === ""){
                $styles = $default;
            }else{
                edit_styles = edit_styles.replace(/&quot;/g, '\"')
                $styles = JSON.parse(edit_styles);
            }
            
            update_styles();
            load_element_style_values();

        });


        /**
         * -----------------------------------------------------
         * Input Functions
         * -----------------------------------------------------
         */

        function load_element_style_values(){
            $element = $("input[name=element]").val();

            $('input[name=font-size]').val($styles[$element]['font-size']);
            $('#text-color').colorpicker('setValue', $styles[$element]['color']);

            if($styles[$element]['font-weight'] === 'normal'){
                $('input[name=bold]').prop('checked', false);
                $('input[name=bold]').parent().removeClass('active');
            }else{
                $('input[name=bold]').prop('checked', true);
                $('input[name=bold]').parent().addClass('active');
            }

            if($styles[$element]['font-style'] === 'normal'){
                $('input[name=italic]').prop('checked', false);
                $('input[name=italic]').parent().removeClass('active');
            }else{
                $('input[name=italic]').prop('checked', true);
                $('input[name=italic]').parent().addClass('active');
            }

            if($styles[$element]['text-decoration'] === 'none'){
                $('input[name=underline]').prop('checked', false);
                $('input[name=underline]').parent().removeClass('active');
            }else{
                $('input[name=underline]').prop('checked', true);
                $('input[name=underline]').parent().addClass('active');
            }

            if($styles[$element]['text-transform'] === "uppercase" && $styles[$element]['font-variant'] === "normal"){
                $('input[name=transform][value=smallcaps]').prop('checked', false);
                $('input[name=transform][value=smallcaps]').parent().removeClass('active');
                $('input[name=transform][value=sentence]').prop('checked', false);
                $('input[name=transform][value=sentence]').parent().removeClass('active');
                
                $('input[name=transform][value=allcaps]').prop('checked', true);
                $('input[name=transform][value=allcaps]').parent().addClass('active');
            }else if($styles[$element]['text-transform'] === "none" && $styles[$element]['font-variant'] === "small-caps"){
                $('input[name=transform][value=allcaps]').prop('checked', false);
                $('input[name=transform][value=allcaps]').parent().removeClass('active');
                $('input[name=transform][value=sentence]').prop('checked', false);
                $('input[name=transform][value=sentence]').parent().removeClass('active');
                
                $('input[name=transform][value=smallcaps]').prop('checked', true);
                $('input[name=transform][value=smallcaps]').parent().addClass('active');
            }else{
                $('input[name=transform][value=smallcaps]').prop('checked', false);
                $('input[name=transform][value=smallcaps]').parent().removeClass('active');
                $('input[name=transform][value=allcaps]').prop('checked', false);
                $('input[name=transform][value=allcaps]').parent().removeClass('active');

                $('input[name=transform][value=sentence]').prop('checked', true);
                $('input[name=transform][value=sentence]').parent().addClass('active');
            }

            $('input[name=align]').prop('checked', false);
            $('input[name=align]').parent().removeClass('active');
            $('input[name=align][value=' + $styles[$element]['text-align'] + ']').prop('checked', true);
            $('input[name=align][value=' + $styles[$element]['text-align'] + ']').parent().addClass('active');

            var colors = [
                'background',
                'border-top-color',
                'border-right-color',
                'border-bottom-color',
                'border-left-color'
            ];

            colors.forEach(function(color){
                if($styles[$element][color] === 'none'){
                    $('#'+color).colorpicker('setValue', '#FFFFFF');
                }else{
                    $('#'+color).colorpicker('setValue', $styles[$element][color]);
                }
            });

            $('input[name=padding-top]').val($styles[$element]['padding-top']);
            $('input[name=padding-right]').val($styles[$element]['padding-right']);
            $('input[name=padding-bottom]').val($styles[$element]['padding-bottom']);
            $('input[name=padding-left]').val($styles[$element]['padding-left']);

            $('input[name=border-top-width]').val($styles[$element]['border-top-width']);
            $('input[name=border-right-width]').val($styles[$element]['border-right-width']);
            $('input[name=border-bottom-width]').val($styles[$element]['border-bottom-width']);
            $('input[name=border-left-width]').val($styles[$element]['border-left-width']);

            var dropdowns = [
                'border-top-style',
                'border-right-style',
                'border-bottom-style',
                'border-left-style'
            ];

            dropdowns.forEach(function(dropdown){
                $('select[name='+dropdown+']').val($styles[$element][dropdown]);
            });

        }

        function change_styles(new_styles){
            console.log(new_styles);

            $element = $("input[name=element]").val();

            $.each(new_styles, function(style,value){
                $styles[$element][style] = "" + value;
            });

            console.log($styles);

            $('.focus').removeClass('focus');
            update_styles();
        }

        /**
         * -----------------------------------------------------
         * Events
         * -----------------------------------------------------
         */


        //spinners
        $(document).on('click', '.spinner .btn:first-of-type', function(){

            $input = $(this).parent().parent().find('input');
            $edit_style = $input.attr('name');
            $val = parseInt($input.val()) + 1;

            switch($edit_style) {
                case 'font-size':
                    if(parseInt($input.val()) < 72){
                        $input.val($val);
                    }
                    break;
                default:
                    if(parseInt($input.val()) < 100){
                        $input.val($val);
                    }
                    break;
            }

            $data = {};
            $data[$edit_style] = $val + 'px';

            change_styles($data);
        });

        $(document).on('click', '.spinner .btn:last-of-type', function(){

            $input = $(this).parent().parent().find('input');
            $edit_style = $input.attr('name');
            $val = parseInt($input.val()) - 1;

            switch($edit_style) {
                case 'font-size':
                    if(parseInt($input.val()) > 8){
                        $input.val($val);
                    }
                    break;
                default:
                    if(parseInt($input.val()) > 0){
                        $input.val($val);
                    }
                    break;
            }

            $data = {};
            $data[$edit_style] = $val + 'px';

            change_styles($data);
        });

        $(document).on('blur', '#font-size', function(){
            $input = $(this);

            if(parseInt($input.val()) > 72){
                $input.val(72);
            }

            if(parseInt($input.val()) < 8){
                $input.val(8);
            }

            $val = parseInt($input.val());
            change_styles({'font-size': $val + 'px'});
        });

        $(document).on('blur', '.padding', function(){

            $val = $(this).val();
            $name = $(this).attr("name");

            console.log('Name: ' + $name + " | Value: " + $val);

            $data = {};
            $data[$name] = $val + 'px';

            change_styles($data);
        });

        
        //items
        $(document).on('click', '.preview-item', function(){
            $('.preview-item').removeClass('active');
            $(this).addClass('active');

            $("input[name=element]").val($(this).data('element'));
            load_element_style_values()
        });

        //colours
        $('.colorpicker-component').colorpicker().on('colorpickerChange', function(e){
            $val = e.color.toString(e.color.format);
            $input = $(this).find('input');
            $edit_style = $input.attr('name');

            $data = {};
            $data[$edit_style] = $val;

            change_styles($data);
        });

        /*$('#highlight-color').colorpicker().on('colorpickerChange', function(e){
            $val = e.color.toString(e.color.format);
            change_styles({'background': $val});
        });*/
        
        //checkboxes
        $(document).on('change', 'input[name=bold]', function(){
            $val = ($(this).is(':checked')) ? 'bold' : 'normal';
            change_styles({'font-weight': $val});
        });

        $(document).on('change', 'input[name=italic]', function(){
            $val = ($(this).is(':checked')) ? 'italic' : 'normal';
            change_styles({'font-style': $val});
        });

        $(document).on('change', 'input[name=underline]', function(){
            $val = ($(this).is(':checked')) ? 'underline' : 'normal';
            change_styles({'text-decoration': $val});
        });

        $(document).on('change', '.dropdown', function(){

            $name = $(this).attr('name');
            $val = $(this).val();

            $data = {};
            $data[$name] = $val;

            change_styles($data);

        });
        
        $(document).on('change', 'input[name=transform]', function(){

            if($(this).val() === "allcaps"){
                change_styles({
                    'text-transform': 'uppercase',
                    'font-variant': 'normal'
                });
            }

            if($(this).val() === "smallcaps"){
                change_styles({
                    'text-transform': 'none',
                    'font-variant': 'small-caps'
                });
            }

            if($(this).val() === "sentence"){
                change_styles({
                    'text-transform': 'none',
                    'font-variant': 'normal'
                });
            }

        });

        $(document).on('change', 'input[name=align]', function(){
            change_styles({
                'text-align': $(this).val()
            });
        });

        $(document).on('click', '#btn-save', function(){

            var data = {
                "name" : $('input[name=name]').val(),
                "styles" : JSON.stringify($styles)
            }

            console.log(data);

            @if($edit)
            var actionUrl = "{{ url('storyline2/templates/').'/'.$template['id'] }}";
            var method = "PUT"
            @else
            var actionUrl = "{{ url('storyline2/templates') }}";
            var method = "POST"
            @endif

            $.ajax({
                method: method,
                url: actionUrl,
                data: JSON.stringify(data),
                contentType: 'json',
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
            
        });


    </script>

@endsection
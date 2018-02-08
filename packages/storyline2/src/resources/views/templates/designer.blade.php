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


    </style>

@endsection

<!-- ============================================================================= -->

@section('content')

    <div class="page-container" id="page">

        <div class="preview-pane">
            
            <div class="content-body">
                <p class="subtitle">Title Example</p>
                <p class="subtitle">Subtitle Example</p>
                <h1>Heading 1 Example</h1>
                <h2>Heading 2 Example</h2>
                <h3>Heading 3 Example</h3>
                <h4>Heading 4 Example</h4>
                <p>Text example</p>
                <p class="quote">Quote Example</p>

                <p class="self_assessment">Self Assessment Example</p>
                <p class="video">Video Example</p>
                <p class="graph">Graph Example</p>
                <p class="text">Text Example</p>
                <p class="equation">Equation Example</p>
                <p class="activity">Activity Example</p>
                <p class="image">Image</p>
                <p class="final_assessment">Final Assessment Example</p>
                <p class="chain">Chain Example</p>

            </div>


        </div>

        <div class="design-pane">
            <h3>Settings</h3>

            <form action="#" class="form-inline"></form>

            <div class="design-pane-item">
                <div class="design-pane-item-title">
                    Text
                </div>
                <div class="design-pane-item-settings">
                    
                    <div class="settings-line">

                        <div id="mycp1" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" width="8"/>
                        </div>

                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="16" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <span class="btn-group btn-setting-group" data-toggle="buttons">
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="checkbox" autocomplete="off"><b>B</b>
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="checkbox" autocomplete="off"><i>I</i>
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="checkbox" autocomplete="off"><u>U</u>
                            </label>
                        </span>

                    </div>

                    <div class="settings-line">

                        <span class="btn-group btn-setting-group" data-toggle="buttons">
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" autocomplete="off">TT
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" autocomplete="off">Tt
                            </label>
                        </span>

                        <span class="btn-group btn-setting-group" data-toggle="buttons">
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" autocomplete="off"><i class="fa fa-align-left"></i>
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" autocomplete="off"><i class="fa fa-align-center"></i>
                            </label>
                            <label class="btn btn-default btn-setting-toggle">
                                <input type="radio" autocomplete="off"><i class="fa fa-align-right"></i>
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

                        <div id="mycp2" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" width="8"/>
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
                            <input type="text" class="form-control" value="16" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="spinner-container">
                        <span class="spinner-label">Right</span>
                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="16" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="spinner-container">
                        <span class="spinner-label">Bottom</span>
                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="16" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="spinner-container">
                        <span class="spinner-label">Left</span>
                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="16" name="font-size">
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
                            <input type="text" class="form-control" value="16" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <div class="settings-dropdown">
                            <select class="form-control">
                                <option value="solid">Solid</option>
                                <option value="dotted">Dotted</option>
                            </select>
                        </div>

                        <div id="mycp4" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" width="8"/>
                        </div>

                    </div>

                    <div class="settings-line">

                        <span class="settings-line-label">Right</span>

                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="16" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <div class="settings-dropdown">
                            <select class="form-control">
                                <option value="solid">Solid</option>
                                <option value="dotted">Dotted</option>
                            </select>
                        </div>

                        <div id="mycp5" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" width="8"/>
                        </div>

                    </div>

                    <div class="settings-line">

                        <span class="settings-line-label">Bottom</span>

                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="16" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <div class="settings-dropdown">
                            <select class="form-control">
                                <option value="solid">Solid</option>
                                <option value="dotted">Dotted</option>
                            </select>
                        </div>

                        <div id="mycp6" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" width="8"/>
                        </div>

                    </div>

                    <div class="settings-line">

                        <span class="settings-line-label">Left</span>

                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="16" name="font-size">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>

                        <div class="settings-dropdown">
                            <select class="form-control">
                                <option value="solid">Solid</option>
                                <option value="dotted">Dotted</option>
                            </select>
                        </div>

                        <div id="mycp7" class="input-group colorpicker-component" title="Using input value">
                            <span class="input-group-addon"><i></i></span>
                            <input type="text" class="form-control" value="#DD0F20" width="8"/>
                        </div>

                    </div>

                </div>

            </div>

            {{ Form::close() }}

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
                "text-transform": "uppercase";
                "text-align": "left",
                "background": "none",
                "padding-top": "5px",
                "padding-right": "0",
                "padding-bottom": "5px",
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
                "text-transform": "uppercase";
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
            }
        };

        function resizeArea(){
            var areaHeight = $("#content-area").height();
            var toolsHeight = $("#tools").height();
            $("#page").height(areaHeight - toolsHeight);
        }

        function update_styles($styles){

            $style_string = '';

            $.each($styles, function(element,styles){

                $style_string =+ element + ' {';

                $.each(value, function(style,value){

                    $style_string =+ style + ': ' + value + ';';

                });

                $style_string =+ element + '}';

            });

            console.log($style_string);

        }

        $(document).ready(function(){
            resizeArea();
            $('#mycp1,#mycp2,#mycp3,#mycp4,#mycp5,#mycp6,#mycp7').colorpicker({
                format: "hex"
            });

            update_styles($default);
/*

            $('#mycp2').colorpicker({
                format: "hex"
            });

            $('#mycp3').colorpicker({
                format: "hex"
            });
*/

            //var spinner = $( "#spinner" ).spinner();
        });

        $(document).on('click', '.spinner .btn:first-of-type', function(){
            $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
        });

        $(document).on('click', '.spinner .btn:last-of-type', function(){
            $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
        });
        
        
        



    </script>

@endsection
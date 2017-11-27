@extends('layouts.app')

@section('page-title')
Storyline Student Single
@endsection


@section('custom-styles')

<link rel="stylesheet" href="{{ url('js/resizer/resizer.css') }}" />

<style>

    .flex-container {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        /*-webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-justify-content: flex-start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-align-content: stretch;
        -ms-flex-line-pack: stretch;
        align-content: stretch;*/

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
        /*width: 250px;*/

        /*overflow-x: hidden;*/
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
        padding: 15px;
    }


    .flex-menu h4 {
        font-size: 20px;
        color: #919191;
        margin: 15px 15px 5px 15px;
    }

    .item-tree a:focus {
        color: #fb7217;
        text-decoration: none;
    }

    .item-tree li {
        display: block;
        padding-top: 8px;
    }

    .item-tree ul {
        padding-left: 0px;
    }

    .item-tree ul li {
        padding-left: 15px;
    }

    .toggle-expand {
        width: 18px;
        min-height: 10px;
        color: #b7b7b7;
        text-align: center;
        font-size: 18px;
        margin-top: -4px;
    }

    .active-menu {
        font-weight: 700;
    }


    /*
     * 
     * Content Navbar
     *
     */

    .content-navbar {
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

        max-width: 1120px;
        margin: 15px 0px 15px 0px;
    }

    .content-navbar-back {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 0 1 auto;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        width: 20px;
    }

    .content-navbar-bread {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        padding-left: 15px;
    }

    .content-navbar-next {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 0 1 auto;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        width: 20px;
    }

    .bread-seperator {
        color: #b7b7b7;
    }

    .arrow-btn {
        display: none;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }


    .tools {
        margin: -15px 0 0 0;
        background: #FFF;
        border-width: 0px 0px 1px 0px;
        border-color: #d3d3d3;
        border-style: solid;
        padding: 5px;
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
    .in-active{
        //pointer-events: none;
        cursor: default;
        color: #636B6F;
    }

    .tip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .menu-btn-disabled {
        color: #b2b2b2;
    }

    .menu-btn-disabled:hover {
        color: #b2b2b2;
        cursor: not-allowed;
    }

    .menu-btn-disabled:focus {
        color: #b2b2b2;
        outline: none;
    }

</style>


<link rel="stylesheet" href="{{ url($course->template->file_path) }}" />
@endsection


@section('content')

<div class="tools" id="tools">

    <div class="dropdown" style="display: inline-block;">
        <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-default btn-dropdown" data-target="#" href="/page.html">
            {{ $course['title'] }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
            @each('eon.storyline2::partials.dropdown', $items, 'item', 'eon.storyline2::partials.none')
        </ul>
    </div>

    <span class="pull-right"><a class="btn btn-default" href="javascript:void();" id="convert-html-to-pdf"><i class="fa fa-file-pdf-o"></i> Print PDF </a></span>
</div>

<div class="flex-container resizer">

    <div class="flex-menu">

        <div class="item-tree" id="content_tree">

            {{-- {!! $items !!} --}}
            <ul>
            @each('eon.storyline2::partials.items', $items, 'item', 'eon.storyline2::partials.none')
            </ul>

        </div>

    </div><!--End col-md-3 -->

    <div class="flex-content">

        <div class="content-navbar">

            <div class="content-navbar-back">
                <a href="#" id="prev-btn" class="arrow-btn prev-btn" data-item-id="">
                    <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i>
                </a>
            </div>

            <div class="content-navbar-bread">
                <span class="content-navbar-title"></span>
            </div>

            <div class="content-navbar-next">
                <a href="#" id="next-btn" class="arrow-btn next-btn" data-item-id="">
                    <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>
                </a>
            </div>

        </div>

        <div class="content-page shadow">

            <div style="text-align: right; padding-right: 10px;">

            </div>

            <div class="content-body" id="body"></div>

        </div>

            <div class="content-navbar">

                <div class="content-navbar-back">
                    <a href="#" id="prev-btn" class="arrow-btn prev-btn" data-item-id="">
                        <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i>
                    </a>
                </div>

                <div class="content-navbar-bread">
                    <span class="content-navbar-title"></span>
                </div>

                <div class="content-navbar-next">
                    <a href="#" id="next-btn2" class="arrow-btn next-btn" data-item-id="">
                        <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>
                    </a>
                </div>

            </div>

    </div><!--End col-md-9 -->

</div><!--End flexbox-container -->


@endsection


@section('exterior-content')

<div id="errorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Topic Progress Alert</h4>
            </div>

            <div class="modal-body">
                <div class="error-message">
                    Please complete current learning objective before moving to the next one. You will now be taken to your furthest progress.
                </div>
            </div>

            <div class="modal-footer">
                <!--<button class="btn btn-primary" data-toggle="modal" data-target="#errorModal"><i class="fa fa-mail-reply"></i><span> Okay</span></button>-->                 
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="noContentMessage" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Topic Progress Alert</h4>
            </div>

            <div class="modal-body">
                <div class="error-message">
                    The item you are trying to access does not have any content associated with it. If you are the author of this content, please add content to this item.
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection


@section('custom-scripts')
    <script src="{{ url("js/resizer/resizer.js") }}"> </script>

<script src="{{url('js/analytics/tincan.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS-MML_SVG"></script>

<script>


    const selector = '.resizer';

    let resizer = new Resizer(selector);

    function saveProgress() {
        var id = $('#content_tree').find('ul:first').children('li:first').find('a:first').data('item-id');
        var courseId = '{{ $course->id }}';
        var storyline = '{{ $storylineId }}';
        var student = '{{auth()->user()->id}}';
        $.ajax({
            url: '{{url('')}}/student/progression',
            type: "POST",
            data: {course: courseId, id: id, storyline: storyline,student: student, _token: "{{ csrf_token() }}"},
            success: function (data, textStatus, jqXHR) {
                if (data.msg === 'true') {
                    //$('#idIframe').attr('src','{{ url("")."/"}}'+data.story);
                    //window.location.href = "/lti/courses/{{$course->id}}/lectures/" + data.story;
                } else {
                    //window.location.href = "/lti/courses/{{$course->id}}/lectures/" + data.story;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
                // location.reload();
            }
        });
    }
    
    function progress_error(){
        $("#errorModal").modal("show");
    }

    function progress_error(){
        $("#errorModal").modal("show");
    }

    $(document).ready(function(){
        resizeArea();
        $(document).on("click", ".menu-btn", function() {
            var req = $(this).attr('req');
            var button = $(this);
            var item_id = $(this).data("item-id");  
            loadContent(item_id,button);
            
        });
        
        $(document).on("click", ".bread-btn", function() {
            var req = $(this).attr('req');
            var button = $('#' + $(this).data('item-id'));
            var item_id = $(this).data("item-id");
            loadContent(item_id,button);
        });
        
        $(document).on("click", ".arrow-btn", function() {           
            var button = $('#' + $(this).data('item-id'));
            var item_id = $(this).data("item-id");
            loadContent(item_id,button);

        });

        $(document).on("click", ".dropdown-btn", function() {
            var req = $(this).attr('req');
            var button = $('#' + $(this).data('item-id'));
            var item_id = $(this).data("item-id");
            loadContent(item_id,button);
        });

        //$('.arrow-btn').hide();
        //hide all subtrees
        $('#content_tree').find('a').parent().parent().children('ul').toggle();
        //load first page
        var first = $('#content_tree').find('ul:first').children('li:first').find('a:first');
        var item_id = first.data("item-id");
        getContent(item_id, first);
        //expand or collapse on caret click
        $(document).on('click','.toggle-expand', function(e){
            $(this).parent().children('ul').toggle();
            $(this).children('i').toggleClass('fa-caret-down');
            $(this).children('i').toggleClass('fa-caret-right');
        });       
    });
        
    $(window).resize(function(){
    resizeArea();
    });
        
        
    function resizeArea(){
        var areaHeight = $("#content-area").height();

        var toolsHeight = $("#tools").height();
        $(".flex-container").height(areaHeight - toolsHeight - 11);
    }
    
        
    function refresh_items(data,item_id){    
        var courseId = '{{ $course->id }}';
        $.ajax({
            url: "{{ url("") }}/storyline2/item-refresh" +'/'+courseId+'/'+item_id,
            type: "GET",
            async: true,
            beforeSend: function () {
            //$('.csv-view').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
            },
            success: function (data, textStatus, jqXHR) {
            $("#content_tree").html(data); 
                //pupulateContent(data, button);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
                    // location.reload();
            }
        });  
    }
       
    // update XAPI analytics
    function logXAPITopicEvent(course_id, storyline_id, storyline_item_id) {
        //Log search
        var lrs;

        try {
            lrs = new TinCan.LRS(
                    {
                        endpoint: "{!! url('analytics/log') !!}",
                        username: "{{ auth()->user()->name }}",
                        password: null,
                        allowFail: false
                    }
            );
        } catch (ex) {
            console.log("Failed to setup LRS XAPI object: ", ex);
        }

        var statement = new TinCan.Statement(
                {
                    actor: {
                        mbox: "{{ auth()->user()->email }}"
                    },
                    verb: {
                        id: "http://unisaonline.net/schema/1.0/topic"
                    },
                    target: {
                        id: "{!! url('') !!}"
                    },
                    context: {
                        extensions: {
                            course: course_id,
                            storyline: storyline_id,
                            storyline_item: storyline_item_id
                        }
                    }
                }
        );

        lrs.saveStatement(
                statement,
                {
                    callback: function (err, xhr) {
                        if (err !== null) {
                            if (xhr !== null) {
                                console.log("Failed to save statement: " + xhr.responseText + " (" + xhr.status + ")");
                                // TODO: do something with error, didn't save statement
                                return;
                            }

                            console.log("Failed to save statement: " + err);
                            // TODO: do something with error, didn't save statement
                            return;
                        }

                        console.log("Statement saved");
                        // TOOO: do something with success (possibly ignore)
                    }
                }
        );
    }
    

    function loadContent(item_id, button){
        var courseId = '{{ $course->id }}';
        var storyline = '{{ $storylineId }}';
        var student = '{{auth()->user()->id}}';
        var item = '{{auth()->user()->id}}';
        $.ajax({
            url: '{{ url('student/progression') }}',
            type: "POST",
            data: {item: item,course: courseId, id: item_id, storyline: storyline,student: student, _token: "{{ csrf_token() }}"},
            beforeSend: function () {
                $('.csv-view').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
            },
            success: function (data, textStatus, jqXHR) {
                getContent(item_id, button);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
                //ocation.reload();
            }
        });
    }

    //Get Content
    function getContent(item_id,button) {
        console.log("getContent called");
        actionUrl = "{{ url("") }}/storyline2/item-content/" + item_id;        
        $.ajax({
                type: "GET",
                url: actionUrl,
                contentType: 'json',
                headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                statusCode: {
                200: function (data) { //success
                    if(data["found"] === true){
                        refresh_items(data,item_id);
                        pupulateContent(data,button);                       
                        logXAPITopicEvent('{{ $course->id }}', '{{ $storylineId }}', item_id);
                    } else {
                        //$("#noContentMessage").modal("show");
                        
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

    function pupulateContent(data, button){
        //highlight clicked button       
        $(".menu-btn").removeClass('active-menu');
        button.addClass('active-menu');
        //create breadcrumbs
        var breadcrumb = button.html();
        if (button.data('parent-id') !== '#') {

            var current_node = button;
            while (current_node.data('parent-id') !== '#'){

                var current_node = $('#' + current_node.data('parent-id'));
                temp = '<a href="#" class="bread-btn" req="" data-parent-id="' + current_node.data('parent-id') + '" data-item-id="' + current_node.data('item-id') + '" >'
                temp = temp + current_node.html();
                temp = temp + '</a>';
                breadcrumb = temp + '<span class="bread-seperator"> <i class="fa fa-angle-double-right"></i> </span>' + breadcrumb;
            }
        }

        var prev = $('.prev-btn');
        console.log(button.data('prev-id'));
        if (button.data('prev-id') === '#'){
            prev.data('item-id', '');
            prev.hide();
        } else {
            prev.data('item-id', button.data('prev-id'));
            prev.show();
        }

        var next = $('.next-btn');
        if (button.data('next-id') === '#'){
            next.data('item-id', '');
            next.hide();
        } else {
            next.data('item-id', button.data('next-id'));
            next.show();
        }

        button.parent().parent().children('ul').show();
        button.parent().parent().children('.toggle-expand').children('i').removeClass('fa-caret-right');
        button.parent().parent().children('.toggle-expand').children('i').removeClass('fa-caret-down');
        button.parent().parent().children('.toggle-expand').children('i').addClass('fa-caret-down');
        //update breadcrumb GUI
        $(".content-navbar-title").html(breadcrumb);
        //var course_data = jQuery.parseJSON(data);
        $("#body").html(data.content.body);
        
        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
    }


    
</script>



@endsection

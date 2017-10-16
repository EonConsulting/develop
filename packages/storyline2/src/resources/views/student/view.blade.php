@extends('layouts.app')

@section('page-title')
    Storyline Student Single
@endsection


@section('custom-styles')

<style>

    .flex-container {
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

    .flex-menu {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 0 1 auto;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        width: 300px;
        overflow-y: auto;
        overflow-x: auto;
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
        margin-bottom: 15px;
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

    .content-page {
        margin-bottom: 15px;
    }

</style>
    
@endsection


@section('content')

<div class="flex-container" id="containter">

    <div class="flex-menu">
        
        <h4>Navigation Menu</h4>

        <div class="item-tree" id="content_tree">
            <?php echo $items; ?>
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
            
            <div id="body"></div>
    
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
                <a href="#" id="next-btn" class="arrow-btn next-btn" data-item-id="">
                    <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>
                </a>
            </div>

        </div>

    </div><!--End col-md-9 -->

</div><!--End flexbox-container -->


@endsection


@section('exterior-content')

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
                </div>
            </div>

        </div>
    </div>  

@endsection


@section('custom-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS-MML_SVG"></script>

<script>
  
    window.onload = function () {
       // $('a.active-menu').trigger('click');
        saveProgress();
    };
    
    function saveProgress() {
        var id = $('#content_tree').find('ul:first').children('li:first').find('a:first').data('item-id');
        var courseId = '{{ $course->id }}';
        var storyline = '{{ $storylineId }}';
        var student = '{{auth()->user()->id}}';
        $.ajax({
            url: '{{url('')}}/student/progression',
            type: "POST",
            data: {course: courseId, id: id, storyline: storyline,student: student, _token: "{{ csrf_token() }}"},
            beforeSend: function () {
                $('.csv-view').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
            },
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

    $(document).ready(function(){

        resizeArea();

        $(".menu-btn").on("click", function() {
            var button = $(this);
            var item_id = $(this).data("item-id");           
            var courseId = '{{ $course->id }}';
            var storyline = '{{ $storylineId }}';
            var student = '{{auth()->user()->id}}';
            
            $.ajax({
                url: '{{url('')}}/student/progression',
                type: "POST",
                data: {course: courseId, id: item_id, storyline: storyline,student: student, _token: "{{ csrf_token() }}"},
                beforeSend: function () {
                    $('.csv-view').html("<button class='btn btn-default btn-lg'><i class='fa fa-spinner fa-spin'></i> Loading</button>");
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.msg === 'true') {     
                        //window.location.href = "{{ url('/')}}"+"/lti/courses/{{$course->id}}/lectures/"+data.story;;
                         getContent(item_id, button);
                       } else if(data.msg === 'error'){
                        progress_error();
                        setTimeout(function () {
                            $("#errorModal").modal("toggle");
                            //getContent(item_id, button);
                        }, 3000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    // location.reload();
                }
            });
       
           
        });

        $(document).on("click", ".bread-btn", function() {
            var button = $('#'+$(this).data('item-id'));
            var item_id = $(this).data("item-id");
            getContent(item_id, button);
        });

        $(document).on("click", ".arrow-btn", function() {
            var button = $('#'+$(this).data('item-id'));
            var item_id = $(this).data("item-id");
            getContent(item_id, button);
        });

        //$('.arrow-btn').hide();

        //hide all subtrees
        $('#content_tree').find('a').parent().parent().children('ul').toggle(); 

        //load first page
        var first = $('#content_tree').find('ul:first').children('li:first').find('a:first');
        var item_id = first.data("item-id");
        getContent(item_id, first);

        //expand or collapse on caret click
        $('.toggle-expand').on('click', function(e){
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
        $("#containter").height(areaHeight);
    }

    function pupulateContent(data,button){

        //highlight clicked button
        $(".menu-btn").removeClass('active-menu');
        button.addClass('active-menu');

        //create breadcrumbs
        var breadcrumb = button.html();

        if(button.data('parent-id') !== '#') {

            var current_node = button;

            while(current_node.data('parent-id') !== '#'){
                
                var current_node = $('#' + current_node.data('parent-id'));

                temp = '<a href="#" class="bread-btn" data-parent-id="' + current_node.data('parent-id') + '" data-item-id="' + current_node.data('item-id') + '" >'
                temp = temp + current_node.html();
                temp = temp + '</a>';

                breadcrumb = temp + '<span class="bread-seperator"> <i class="fa fa-angle-double-right"></i> </span>' + breadcrumb;

            }
        }

        var prev = $('.prev-btn');
        if(button.data('prev-id') === '#'){
            prev.data('item-id','');
            prev.hide();
        } else {
            prev.data('item-id',button.data('prev-id'));
            prev.show();
        }

        var next = $('.next-btn');
        if(button.data('next-id') === '#'){
            next.data('item-id','');
            next.hide();
        } else {
            next.data('item-id',button.data('next-id'));
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
        MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
        
    }

    //Get Content
    function getContent(item_id,button) {

        console.log("getContent called");

        actionUrl = "{{ url("") }}/storyline2/item-content/" + item_id;

        $.ajax({
            method: "GET",
            url: actionUrl,
            contentType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            statusCode: {
                200: function (data) { //success
                    if(data["found"] === true){
                        pupulateContent(data,button);
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

    
    
</script>



@endsection

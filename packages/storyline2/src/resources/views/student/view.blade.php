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

    .item-tree {

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
    }

    .active-menu {
        font-weight: 700;
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

        <div class="content-page shadow">

            <!--
            <h3 id="title" style="margin: 0px;"></h3>

            <hr>-->
            
            <div id="body"></div>
    
        </div>

    </div><!--End col-md-9 -->

</div><!--End flexbox-container -->


@endsection



@section('exterior-content')

@endsection



@section('custom-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS-MML_SVG"></script>

<script>
    $( document ).ready(function(){

        resizeArea();

        $(".menu-btn").on("click", function() {

            console.log("clicked");

            $(".menu-btn").removeClass('active-menu');
            $(this).addClass('active-menu');

            var item_id = $(this).data("item-id");
            getContent(item_id);

        });

        $('#content_tree').find('a').parent().parent().children('ul').toggle();

        var item_id = $('#content_tree').find('ul:first').children('li:first').find('a:first').data("item-id");
        $('#content_tree').find('ul:first').children('li:first').find('a:first').addClass('active-menu');
        getContent(item_id);

        $('.toggle-expand').on('click', function(e){
            $(this).parent().children('ul').toggle();
            $(this).children('i').toggleClass('fa-chevron-down');
            $(this).children('i').toggleClass('fa-chevron-right');
        });

    });



    $(window).resize(function(){
        resizeArea();
    });

    function resizeArea(){
        var areaHeight = $("#content-area").height();
        $("#containter").height(areaHeight);
    }

    function pupulateContent(data){

        var course_data = jQuery.parseJSON(data);

        //$("#title").html(course_data.content.title);
        $("#body").html(course_data.content.body);

        MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
 
    }

    //Get Content
    function getContent(item_id) {

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
                    pupulateContent(data);
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

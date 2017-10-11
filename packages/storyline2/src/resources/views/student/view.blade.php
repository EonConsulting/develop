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
        width: 250px;
        overflow-y: scroll;
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
        padding-left: 50px;
    }
    



    .item-tree {


    }

    .item-tree a {



    }

    .item-tree ul {
        list-style-type: none;


    }

    .item-tree ul li {



    }


</style>
    
@endsection


@section('content')

<div class="flex-container">

    <div class="flex-menu">
        
        <div class="item-tree">
            <?php echo $items; ?>
        </div>

    </div><!--End col-md-3 -->

    <div class="flex-content">

        <div class="content-page shadow">

            <h3 id="title" style="margin: 0px;"></h3>

            <hr>
            
            <div id="body"></div>
    
        </div>

    </div><!--End col-md-9 -->

</div><!--End flexbox-container -->


@endsection



@section('exterior-content')

@endsection



@section('custom-scripts')

<script>
    $( document ).ready(function(){

        $(".menu-btn").on("click", function() {

            console.log("clicked");

            var item_id = $(this).data("item-id");
            getContent(item_id);

        });

    });

    function pupulateContent(data){

        var course_data = jQuery.parseJSON(data);

        $("#title").html(course_data.content.title);
        $("#body").html(course_data.content.body);
 
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

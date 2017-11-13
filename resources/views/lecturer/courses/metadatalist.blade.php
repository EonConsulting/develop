@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('custom-styles')
    <link href="{{url('/vendor/appstore/css/radio-checkbox.css')}}" rel="stylesheet" />

<style>
    #tab .btn {
        margin-bottom: 5px;
    }

    .container-fluid {
        margin: 0px 15px 0px 15px;
    }

    .meta-entry-container {
        margin: 30px 0px 30px 0px;
        overflow-y: auto;
    }

    .meta-entry {
        background: #FFF;
        width: 300px;
        /*height: 100px;*/
        float: left;
        padding: 15px;
        margin: 0px 15px 15px 0px;
    }

    .meta-entry input[type=text] {
        width: 100%;
    }

    .meta-checkbox {
        float: left;
        width: 20px;
    }

    .meta-description {
        margin-left: 20px;
        height: 50px;
    }

    .meta-value {

    }


</style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="span12">
            <a href="{{ route('storyline2.lecturer.edit', $course) }}" class="btn btn-default pull-right" style="margin-right:50px">Skip <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            <p class="lead">Metadata Type List</p> <br>
            <div class="msg-info"></div>
            <div id="tab" data-toggle="buttons-radio">
                @foreach($MetadataStore as $key=>$resource)
                <a href="#{{$resource->id}}" id="{{$resource->id}}" course="{{$course}}" class="btn btn-large btn-default metatype" data-toggle="tab">{{$resource->name}}</a>
                @endforeach

            </div> 
            <form method="POST" id="metafrm" action="{{ route('courses.create') }}"> 
                {{ Form::hidden('course_id', $course) }}
            <div class="tab-content metadata-content">


            </div>
            </form>    
        </div>
    </div> 
</div>

@section('exterior-content')
<div id="metadataModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        
            <div class="modal-content">
                
            </div>
    </div>
</div>   
<!-- Modal -->
<div id="msgModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body modal-info">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@endsection
@endsection

@section('custom-scripts')
<!-- lodash -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>-->
<!--<script src="{{url('/js/app.js')}}"></script>-->
<script>

    $(document).ready(function () {
        var onload = $(".metatype").attr('id');
        var course = $(".metatype").attr('course');
        getdata(onload,course);

        $(".metatype").click(function () {
            var id = $(this).attr('id');
            var course = $(this).attr('course');
            $('.metatype').removeClass('active', 1000);
            $(this).addClass('active', 1000);

            getdata(id,course);
        });

        $(document).on('submit', '#metafrm', function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var url = '{{ route("courses.storemetadata") }}';
            $.ajax({
                url: url,
                type: "POST",
                asyn: false,
                data: formData,
                beforeSend: function () {
                    $('.btnSubmit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.success) {
                        $(".msg-info").html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success! </strong>" + data.success + "</div>");
                        $('.meta-footer').html("<a href='{{ route('courses') }}' class='btn btn-default'>OK</a>");
                    } else if(data.error){
                        $(".msg-info").html("<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error! </strong>" + data.error + "</div>");
                        $('.btnSubmit').text("Submit");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
            });
        });

        function getdata(id,course) {
            var url = '{{ route("courses.viewmetadata",["id","course"]) }}';           
            url = url.replace('id/course',id+'/'+course);
            $.ajax({
                url: url,
                type: "GET",
                asyn: false,
                beforeSend: function () {
                    $('.btnSubmit').text("Saving.....");
                },
                success: function (data, textStatus, jqXHR) {
                    $(".metadata-content").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                    location.reload();
                }
            });
        }
    });
</script>

@endsection

@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('custom-styles')

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
            <a href="{{ route('storyline2.lecturer.edit', $course) }}" class="btn btn-default pull-right" style="margin-right:50px">Skip to storyline <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            <p class="lead">Metadata Type List</p> <br>
            @if (session('success'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{ session('success') }} <a href="{{ route('storyline2.lecturer.edit', $course) }}" class="alert-link">Skip to storyline <i class="fa fa-long-arrow-right"></i></a>
            </div>
            @elseif (session('error'))
            <div class="alert alert-warning">
             <strong>Warning!</strong>   {{ session('error') }}
            </div>
            @endif
            <div id="tab" data-toggle="buttons-radio">
                @foreach($MetadataStore as $key=>$resource)
                <a href="#{{$resource->id}}" id="{{$resource->id}}" class="btn btn-large btn-default metatype" data-toggle="tab">{{$resource->name}}</a>
                @endforeach
            </div>
            <form id="c-metadata" action="{{ route('courses.storemetadata') }}" method="post"> 
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
        getdata(onload);

        $(".metatype").click(function () {
            var id = $(this).attr('id');

            $('.metatype').removeClass('active', 1000);
            $(this).addClass('active', 1000);

            getdata(id);
        });

        $('div.alert').delay(8000).slideUp(300);

        function getdata(id) {
            var url = '{{ route("courses.viewmetadata",":id") }}';
            url = url.replace(':id', id);
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

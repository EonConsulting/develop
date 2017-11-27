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
            <a href="{{ route('storyline2.lecturer.edit', $course) }}" class="btn btn-default pull-right" style="margin-right:50px">Skip <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            <p class="lead">Metadata Type List</p> <br>
            
            <div class="msg-info"></div>
            <div id="tab" data-toggle="buttons-radio">
                @foreach($MetadataStore as $key=>$resource)
                <a href="#{{$resource->id}}" id="{{$resource->id}}" class="btn btn-large btn-default metatype" data-toggle="tab">{{$resource->name}}</a>
                @endforeach
                <input name="course_id" type="hidden" value="{{ $course }}"/>
            </div>
            
            <div class="tab-content metadata-content">
                
            </div>
        </div>
    </div> 
</div>

@section('exterior-content')


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
        
        $(document).on("click",".save-meta",function (event) {
                event.preventDefault();
                var courseId = $("input[name=course_id]").val();
                var typeId = $("input[name=metadata_type_id]").val();
                var storeId = $("input[name='metadata_store_id[]']").map(function(){return $(this).val();}).get();
                var value = $("input[name='value[]'").map(function(){return $(this).val();}).get();
                var url = '{{ route("courses.storemetadata") }}';
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {course_id:courseId, type_id:typeId, store_id:storeId, value:value},
                    beforeSend: function () {
                        $('.btnSubmit').text("Saving.....");
                    },
                    success: function (data, textStatus, jqXHR) {
                              if(data.success){
                                $(".msg-info").html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong>"+data.success+"</div>");
                              }else{
                                $(".msg-info").html("<div class='alert alert-danget alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong>"+data.error+"</div>");                            
                              }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                        //location.reload();
                    }
                });
            });

       function getdata(id){
            var url = "{{ route('courses.viewmetadata',[':id',':course']) }}";
            url = url.replace(':id/:course', id+'/'+'{{ $course }}');
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
                    //location.reload();
                }
            });
       }
    });
</script>

@endsection

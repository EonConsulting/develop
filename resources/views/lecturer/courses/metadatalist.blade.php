@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('custom-styles')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row" style="margin-left:20px">
        <div class="span12">
            <a href="{{ route('storyline2.lecturer.edit', $course) }}" class="btn btn-default pull-right" style="margin-right:50px">Skip <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
</a>
            <p class="lead">Metadata Type List</p> <br>
            <div id="tab" class="btn-group" data-toggle="buttons-radio">
                @foreach($MetadataStore as $key=>$resource)
                <a href="#{{$resource->id}}" id="{{$resource->id}}" class="btn btn-large btn-info active metatype" data-toggle="tab">{{$resource->name}}</a>
                @endforeach

            </div>
            
            <div class="tab-content metadata-content">
                
            </div>
        </div>
    </div> 
</div>
<!--<div class="row">
    <div class="col-md-12">
        <div class="dashboard-card shadow">
            <div class="dashboard-card-heading">
                <label>Meta Information</label>
            </div>
            <div class="container-fluid">	
                <div class="col-md-4">
                    <p>Please choose metadata items</p>
                    <div class="form-group">
                        <select id="metadata_store_list" size="15" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <div id="metadata_forms"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>-->
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
             getdata(id);
        });

       function getdata(id){
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

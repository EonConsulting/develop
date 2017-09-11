@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('custom-styles')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <form method="POST" class="form-horizontal">
            <div class="col-md-12">
                <div class="dashboard-card shadow">
                    <div class="dashboard-card-heading">
                        <label>Course Information</label>
                    </div>
                    <div class="container-fluid">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Module Title</label>
                                <input type="text" class="form-control" placeholder="Module Title" name="title" v-model="course_title" @keyup="make_course_slug">
                            </div>
                            <div class="col-md-4">
                                <label>Module Slug</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon3">modules/</span>
                                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled v-model="course_slug">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Module Summary</label>
                                <textarea class="form-control" name="description" placeholder="Module Summary" v-model="course_summary" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Tags <small>(Separate by a comma)</small></label>
                                <input type="text" class="form-control tags"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Featured Image</label>
                                <!--<upload-form></upload-form>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-card shadow">
                <div class="dashboard-card-heading">
                    <label>Meta Information</label>
                </div>
                <div class="container-fluid">	
                    <p>Please choose metadata items</p>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Metadata Store</label>
                            <select>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Metadata Item</label>
                            <input class="form-control" id="meta_store_value"></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-scripts')
<script src="{{url('/js/app.js')}}"></script>
<script>
$(document).ready(function () {
    $('#login-token').val(window.Laravel.csrfToken);
});
</script>
<script>
    $(document).ready(function () {
        $(function () {
            $('#metadata_store').jstree();
        });
    });
</script>
@endsection

@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <form method="POST" class="form-horizontal">
        
        <div class="col-md-6">
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

        <div class="col-md-6">
            <div class="dashboard-card shadow">
                <div class="dashboard-card-heading">
                    <label>Meta Information</label>
                </div>
                <div id="meta-tabs" class="container-fluid">	
                    <ul  class="nav nav-pills">
                        <li class="active">
                            <a href="#tab-general" data-toggle="tab">General</a>
                        </li>
                        <li>
                            <a href="#tab-location" data-toggle="tab">Location</a>
                        </li>
                    </ul>

                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="tab-general">
                            <div class="form-group">
                                <label>Qualification Type</label>
                                <select class="form-control" name="qualification_type" id="qualification_type">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Course Difficulty</label>
                                <select class="form-control" name="content_difficulty_type" id="content_difficulty_type">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Pedagogical Type</label>
                                <select class="form-control" name="pedagogical_type" id="pedagogical_type">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Discipline Type</label>
                                <select class="form-control" name="discipline_type" id="discipline_type">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Duration Type</label>
                                <select class="form-control" name="duration_type" id="duration_type">
                                </select>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab-location">
                            <div class="form-group">
                                <label>College</label>
                                <select class="form-control" name="college_type" id="college_type">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>School</label>
                                <select class="form-control" name="school_type" id="school_type">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department_type" id="department_type">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Centre</label>
                                <select class="form-control" name="centre_type" id="centre_type">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Institute</label>
                                <select class="form-control" name="institute_type" id="institute_type">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pull-right">
                    <button class="btn btn-primary btn-block" type="submit">Save</button>
                </div>
            </div>
        </div>
        
        </form>
    </div>
</div>

@endsection

@section('custom-scripts')
<script src="{{url('/js/app.js')}}"></script>
<!--<script src="{{url('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>-->
<script>
    $(document).ready(function(){
        $('#login-token').val(window.Laravel.csrfToken);
    });
</script>
@endsection

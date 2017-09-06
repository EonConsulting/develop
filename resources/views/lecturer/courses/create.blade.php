@extends('layouts.app')

@section('page-title')
Create a Course
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="dashboard-card shadow">
                <div class="dashboard-card-heading">
                    <label>Course Information</label>
                </div>
                <div class="container-fluid">
                    <form method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" id="login-token"/>
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
                            <div class="col-md-3 pull-right">
                                <button class="btn btn-primary btn-block" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
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
                            <a href="#tab-required" data-toggle="tab">Required</a>
                        </li>
                        <li>
                            <a href="#tab-material" data-toggle="tab">Material</a>
                        </li>
                        <li>
                            <a href="#3a" data-toggle="tab">Functionality</a>
                        </li>
                        <li>
                            <a href="#4a" data-toggle="tab">Location</a>
                        </li>
                    </ul>

                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="tab-required">
                            <div class="form-group">
                                <label>Option 1</label>
                                <select class="form-control">
                                    <option>1</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Option 2</label>
                                <select class="form-control">
                                    <option>1</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Option 3</label>
                                <select class="form-control">
                                    <option>1</option>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-material">
                            <div class="form-group">
                                <label>Option 4</label>
                                <select class="form-control">
                                    <option>1</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Option 5</label>
                                <select class="form-control">
                                    <option>1</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Option 6</label>
                                <select class="form-control">
                                    <option>1</option>
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane" id="3a">
                            content to go here
                        </div>
                        <div class="tab-pane" id="4a">
                            content to go here
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
<!--<script src="{{url('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>-->
<script>
/*export default {
    mounted() {
        console.log('Component ready.', window.Laravel.csrfToken);
        $('#login-token').val(window.Laravel.csrfToken);
    },
    data() {
        return {
            course_title: '',
            course_slug: '',
            course_summary: '',
            token: ''
        }
    },
    methods: {
        slug(str) {
            return str
                    .toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
        },
        make_course_slug() {
            this.course_slug = this.slug(this.course_title);
        }
    }
}*/
</script>
@endsection

<template>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
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
                        <div class="col-md-1 pull-right">
                            <button class="btn btn-primary btn-block" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
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
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-');
            },
            make_course_slug() {
                this.course_slug = this.slug(this.course_title);
            }
        }
    }
</script>

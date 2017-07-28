<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" class="form-horizontal" id="email-form">
                    <input type="hidden" name="_token" id="tok"/>
                    <input type="hidden" name="emails" id="emails"/>
                </form>

                <div class="panel panel-default">
                    <div class="panel-heading">Enter email addresses to notify about this module <button @click="submit" type="button" class="btn btn-primary btn-xs pull-right">Save & Notify</button></div>
                    <div class="panel-body">
                        <div class="input-group">
                            <input type="text" class="form-control" @keyup.enter.prevent="add_email" placeholder="Enter email here" v-model="current_email">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" @click="add_email"><span v-show="!in_edit">Add</span><span v-show="in_edit">Update</span></button>
                                <button v-show="in_edit" class="btn btn-danger" type="button" @click="stop_edit">Stop Edit</button>
                            </span>
                        </div><!-- /input-group -->
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <td class="col-md-10">Email</td>
                                    <td class="col-md-1">Edit</td>
                                    <td class="col-md-1">Remove</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="email, index in emails">
                                    <td>{{ email }}</td>
                                    <td><button @click.prevent="edit_email(index, email)" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></button></td>
                                    <td><button @click.prevent="remove_email(index)" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default {
        mounted() {

            $('#tok').val(window.Laravel.csrfToken);
            var url = '/develop/public/lecturer/courses/{course}/notify/users';
            url = url.replace('{course}', this.courseid);
            var self = this;

            this.$http.get(url).then(response => {
                console.log(response.body);
                self.emails = response.body;
            });

            $('#email-form').on('submit', function() {
                if(this.emails.length == 0) {
                    return false;
                }
            });
        },
        data() {
            return {
                emails: [],
                current_email: '',
                current_index: false,
                in_edit: false
            }
        },
        props: ['courseid'],
        methods: {
            add_email() {
                if(this.current_email != '') {
                    if(!this.in_edit) {
                        this.emails.push(this.current_email);
                    } else {
                        this.emails[this.current_index] = this.current_email;
                    }
                }

                this.stop_edit();
            },
            edit_email(index, email) {
                this.current_index = index;
                this.current_email = email;
                this.in_edit = true;
            },
            remove_email(index) {
                this.emails.splice(index, 1);
                this.stop_edit();
            },
            stop_edit() {
                this.current_email = '';
                this.current_index = false;
                this.in_edit = false;
            },
            submit() {
                $('#emails').val(JSON.stringify(this.emails));
                $('#email-form').submit();
            }
        }
    }
</script>

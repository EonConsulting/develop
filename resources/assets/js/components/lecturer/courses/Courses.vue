<template>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Modules <div class="col-md-6 pull-right"><input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Modules.."></div><div class="clearfix"></div></div>
                <table class="panel-body table table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-5">Title</th>
                        <th class="col-md-2">Instructor</th>
                        <th class="col-md-2">Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="clickable-row">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default {
        ready() {
            console.log('Component ready.');
        },
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>

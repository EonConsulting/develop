<template>
    <div class="main container-fluid">
        <form method="POST" id="page-form">
            <input type="hidden" name="_token" id="tok"/>
            <input type="hidden" name="parts" id="parts"/>
            <div class="col-md-2" style="position: relative;">
                <div class="panel panel-default" style="position: absolute; left: 0; right: 0;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Toolbox</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <draggable :list="toolbox" :options="{group:{ name:'tools',  pull:'clone', put:false}, handle: '.handle' }">
                                <div class="media" v-for="tool in toolbox" @dragstart="current_item(tool)" @dragend="remove_tool(tool)">
                                    <div class="media-left">
                                        <span class="media-object">
                                            <span :class="tool.icon"></span>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ tool.name }} <i class="fa fa-arrows-alt pull-right handle"></i></h4>
                                    </div>
                                </div>
                            </draggable>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-primary btn-block" @click="save">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-10"
                 @drop="dropped"
                 @dragover.prevent="enter"
                 @dragenter.prevent="enter"
                 @dragleave.prevent="leave"
                 @dragend.prevent="leave"
                 :class="{ 'dragndrop--dragged': draggingOver }">
                <groups :parts="parts" :current_tool="current_tool" :cg="current_group" @update="upd" @updateGroups="updg"></groups>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
</template>

<style>
    .main {
        --dragndrop-min-height: 400px;
        width: 100%;
        height: 100%;
        min-height: var(--dragndrop-min-height);
        position: relative;
    }
    .dragndrop--dragged {
        border-color: #404040 !important;
    }
    .bottom_20 {
        margin-bottom: 20px;
    }
    .affix {
        top: 20px;
    }
</style>

<script>
    import draggable from 'vuedraggable'
    import groups from './partials/groups'

    export default {
        components: {
            draggable,
            groups
        },
        props: ['group', 'courseid'],
        mounted() {
            console.log('Component ready.');
            $('#tok').val(window.Laravel.csrfToken);

            var url = '/develop/public/lecturer/courses/{course}/storyline/feed';
            url = url.replace('{course}', this.courseid);
            var self = this;

            this.$http.get(url).then(response => {
                console.log(response.body);
                self.parts = response.body.parts;
            });

        },
        data() {
            return {
                parts:[],
                toolbox: [
                    {name: "Content", id: 2, icon: 'fa fa-file-o', type: 'content'},
                    {name: "Group", id: 1, icon: 'fa fa-object-group', type: 'group'}
                ],
                current_tool: false,
                current_group: false,
                dropping: false,
                draggingOver: false
            }
        },
        methods: {
            enter() {
                this.draggingOver = true;
            },
            leave() {
                this.draggingOver = false;
            },
            current_item(tool) {
                this.current_tool = tool;
            },
            remove_tool() {
                this.current_tool = false;
            },
            dropped(e) {
                if(!this.dropping) {
                    this.updg();
                } else {
                    this.dropping = false;
                }

                this.leave();
            },
            upd(e) {
                if(e.type != 'dragover') {
                    this.current_group = e;
                }
            },
            updg() {
                this.dropping = true;
                if(this.current_tool) {
                    var obj = this.clone(this.current_tool);
                    obj.id = Math.random();

                    if(!this.current_group) {
                        this.parts.push(obj);
                    }
                }
                this.current_group = false;
            },
            clone(obj){
                var self = this;
                if(obj == null || typeof(obj) != 'object')
                    return obj;

                var temp = new obj.constructor();
                for(var key in obj)
                    temp[key] = self.clone(obj[key]);

                return temp;
            },
            save() {
                console.log('parts', this.parts);

                $('#parts').val(JSON.stringify(this.parts));
                $('#page-form').submit();

            }
        }
    }
</script>

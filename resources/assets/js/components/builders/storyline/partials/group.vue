<template>
    <div class="group" v-show="group != false">
        <div>
            <div v-show="group.type=='group'">
                <div class="col-md-11">
                    <input type="text" class="form-control" v-model="group.name"/>
                </div>
                <div class="col-md-1">
                    <button type="button" class="pull-right btn btn-xs btn-default"><span class="glyphicon glyphicon-cog handle" :data-groupid="group.id"></span></button>
                </div>
                <div class="clearfix"></div>
                <br />
                <div class="col-md-12">
                    <div class="droppable group"
                         @dragover.prevent="enter(group)"
                         @dragenter.prevent="enter(group)"
                         @dragleave.prevent="leave(group)"
                         @dragend.prevent="leave(group)"
                         @drop.prevent="dropped"
                         :class="{ 'dragndrop--dragged': isDraggedOverGroup }"
                         data-type="group"
                         :data-groupid="group.id">

                        <draggable :list="group.children" :options="{group:{ name:'groups' }}">
                            <div v-for="p, index in group.children" :class="{'bottom_20' : group.children.length > 1 && index != group.children.length-1}"
                                 @dragover.prevent="enter(p)"
                                 @dragenter.prevent="enter(p)"
                                 @dragleave.prevent="leave(p)"
                                 @dragend.prevent="leave(p)"
                                 @drop.prevent.stop="dropped">
                                <group :group="p" :ct="ct" @groupUpdated="updateGroup" @updateDrag="updateDrag"></group>
                            </div>
                        </draggable>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div v-show="group.type=='content'">
                <div class="col-md-11">
                    <label>Title: </label>
                    <input type="text" class="form-control" v-model="group.name"/><br />
                    <label>File:</label>
                    <p></p>
                    <div v-for="file, index in group.files">
                        <p>{{ file.name }} <span @click="remove_file(file)" class="glyphicon glyphicon-remove"></span></p>
                    </div>
                    <button type="button" class="btn btn-xs btn-primary" @click="openfinder">Select file</button>
                </div>
                <div class="col-md-1">
                    <button type="button" class="pull-right btn btn-xs btn-default"><span class="glyphicon glyphicon-cog handle" :data-groupid="group.id"></span></button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>

<style>
    .droppable {
        padding: 20px 0px;
        width: 100%;
        border: 2px dashed #ccc;
        min-height: 50px;
        background: #efefef;
    }

    /*.group {*/
        /*border: 2px dashed #ccc;*/
        /*min-height: 50px;*/
        /*background: #efefef;*/
        /*padding: 20px;*/
        /*width: 100%;*/
    /*}*/
</style>

<script>
    import draggable from 'vuedraggable'
    import group from './group'

    export default {
        components: {
            draggable,
            group
        },
        props: ['group', 'cg', 'ct'],
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                isDraggedOverGroup: false,
                current_group: false,
                dropping: false,
                files: false//JSON.stringify(this.group)
            }
        },
        methods: {
            startdrag(e) {
                console.log(e);
            },
            enter(e) {
                this.isDraggedOverGroup = true;
                this.current_group = e;
            },
            leave() {
                this.isDraggedOverGroup = false;
                this.current_group = false;
            },
            dropped(e) {
                e.stopImmediatePropagation();
                if(this.current_group && !this.dropping) {
                    this.dropping = true;

                    if(!this.current_group.hasOwnProperty('children')) {
                        this.current_group.children = [];
                    }

                    var obj = this.clone(this.ct);
                    obj.id = Math.random();

                    this.current_group.children.push(obj);
                    this.leave();

                    this.$emit('updateDrag');
                }

                this.dropping = false;
                this.leave();
            },
            updateGroup(e) {

            },
            updateDrag() {
                this.isDraggedOverGroup = false;
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
            openfinder(e) {
                var self = this;
                CKFinder.popup({
                    chooseFiles: true,
                    onInit: function( finder ) {
                        finder.on( 'files:choose', function( evt ) {
                            var files = evt.data.files;
                            var chosenFiles = [];

                            files.forEach( function( file, i ) {
                                chosenFiles.push({url: file.get('url'), name: file.get('name')});
                            });

                            if(!self.group.hasOwnProperty('files'))
                                self.group.files = [];

                            self.group.files = chosenFiles;
                            self.$forceUpdate();
                        });
                        finder.on( 'file:choose:resizedImage', function( evt ) {
                            console.log('evt', evt);
                            console.log(evt.data.resizedUrl);
                        });
                    }
                });
            },
            remove_file: function(file) {
                for(var index in this.group.files) {
                    if(this.group.files[index].url == file.url && this.group.files[index].name == file.name) {
                        this.group.files.splice(index, 1);
                        this.$forceUpdate();
                        break;
                    }
                }
            }
        }
    }
</script>

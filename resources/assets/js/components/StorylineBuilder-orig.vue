<template>
    <div class="main">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Toolbox</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <draggable :list="toolbox" :options="{group:{ name:'tools',  pull:'clone', put:false}, handle: '.handle' }">
                            <div class="media" v-for="tool in toolbox">
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
            </div>
        </div>
        <div class="col-md-10">
            <div class="main-page"
                 @dragover.prevent="enter"
                 @dragenter.prevent="enter"
                 @dragleave.prevent="leave"
                 @dragend.prevent="leave"
                 @drop.prevent="drop"
                 v-bind:class="{ 'dragndrop--dragged': isDraggedOver }">
                <draggable :list="parts" :options="{group:'tools'}">
                    <div class="part" :class="{'part-no-style' : part.id == -1}" v-for="part in parts" v-show="showSingle(part)">
                            <div
                                v-show="part.type=='group'"
                                class="dragndrop"
                                @dragover.prevent="enterGroup"
                                @dragenter.prevent="enterGroup"
                                @dragleave.prevent="leaveGroup"
                                @dragend.prevent="leaveGroup"
                                @drop.prevent="dropGroup"
                                v-bind:class="{ 'dragndrop--dragged': isDraggedOverGroup }">

                                <draggable :options="{group:'tools'}" >
                                    <div v-show="part.type=='content'">
                                        <block></block>
                                    </div>
                                </draggable>
                            </div>

                            <div v-show="part.type=='content'">
                                <p>{{ part.name }}</p>
                            </div>
                    </div>
                </draggable>
            </div>
        </div>
        <div class="clearfix"></div>
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

    .main-page {
        border: 3px dashed rgba(0, 0, 0, .2);
        background-color: #f8f8f8;
        min-height: var(--dragndrop-min-height);
    }

    .part {
        width: 100%;
        min-height: 50px;
        padding: 50px;
    }

    .part:odd {
        background-color: #e7e7e7;
    }

    .part:even {
        background-color: #f7f7f7;
    }

    .part-no-style {
        background-color: #f8f8f8;
    }

    .dragndrop {
        --dragndrop-min-height: 50px;
        width: 100%;
        min-height: var(--dragndrop-min-height);
        background-color: #f8f8f8;
        position: relative;
        border: 3px dashed rgba(0, 0, 0, .2);
    }

    .dragndrop--dragged {
        border-color: #333;
    }

    .dragndrop__input {
        display: none !important;
    }

    .dragndrop__header {
        display: block;
        font-size: 1.1em;
        color: #555;
        vertical-align: middle;
        text-align: center;
        margin: calc(var(--dragndrop-min-height) / 2) 20px;
    }

    .dragndrop__header:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    .dragndrop__header--compact {
        margin: calc(var(--dragndrop-min-height) / 4) 20px;
    }
</style>

<script>
    import draggable from 'vuedraggable'
    import Ckeditor from './ckeditor'

    export default {
        components: {
            draggable,
            ckeditor: Ckeditor
        },
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                parts:[{name: "", id: -1, icon: ''}],
                toolbox: [
                    {name: "Group", id: 1, icon: 'fa fa-object-group', type: 'group'},
                    {name: "Content", id: 2, icon: 'fa fa-file-o', type: 'content'}
                ],
                content: [],
                isDraggedOver: false,
                isDraggedOverGroup: false,
                files: []
            }
        },
        methods: {
            enter () {
                this.isDraggedOver = true
            },
            leave () {
                this.isDraggedOver = false
            },
            drop (e) {
                this.leave();
                console.log('e', e);
//                CKEDITOR.disableAutoInline = true;
//
//                $('.ckeditor').each(function () {
//                    CKEDITOR.inline($(this).id);
//                });
            },
            enterGroup () {
                this.isDraggedOverGroup = true
            },
            leaveGroup () {
                this.isDraggedOverGroup = false
            },
            dropGroup (e) {
                this.leaveGroup();
                console.log('e', e);
            },
            select (e) {
                this.addFiles(this.$refs.input.files)
            },
            addFiles (files) {
                var i, file;

                for (i = 0; i < files.length; i++) {
                    file = files[i]
                }
            },
            upload (fileObject) {
                var form = new FormData()

                form.append('file', fileObject.file)
                form.append('id', fileObject.id)
            },
            storeMeta (file) {

            },
            generateFileObject (file) {
                var fileObjectIndex = this.files.push({
                        id: null,
                        file: file,
                        progress: 0,
                        failed: false,
                        loadedBytes: 0,
                        totalBytes: 0,
                        timeStarted: (new Date).getTime(),
                        secondsRemaining: 0,
                        finished: false,
                        cancelled: false,
                        xhr: null
                    }) - 1

                return this.files[fileObjectIndex]
            },
            showSingle(part) {
                if(part.id == -1 && this.parts.length > 1) {
                    return false;
                }
                return true;
            }
        }
    }
</script>

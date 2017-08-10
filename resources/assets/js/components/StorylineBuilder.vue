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
            </div>
        </div>
        <div class="col-md-10" @drop="dropped">
            <groups :parts="parts" :current_tool="current_tool" :current_group="current_group" @updated="changeGroup"></groups>
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
    import item from './partials/item'
    import group from './partials/group'
    import groups from './partials/groups'

    export default {
        components: {
            draggable,
            item,
            group,
            groups
        },
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                parts:[],
                toolbox: [
                    {name: "Group", id: 1, icon: 'fa fa-object-group', type: 'group'},
                    {name: "Content", id: 2, icon: 'fa fa-file-o', type: 'content'}
                ],
                content: [],
                isDraggedOver: false,
                isDraggedOverGroup: false,
                dropped_in_droppable: false,
                current_tool: false,
                current_group: false,
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
            showSingle(part) {
                if(part.id == -1 && this.parts.length > 1) {
                    return false;
                }
                return true;
            },
            current_item(tool) {
                console.log(tool);
                this.current_tool = tool;
            },
            remove_tool(tool) {
                this.dropped_in_droppable = false;
                this.current_tool = false;
            },
            dropped(e) {
                console.log('this.current_tool', this.current_tool);
                console.log('e', e.target);

                if(!$(e.target).hasClass('group')) {
                    this.parts.push(this.clone(this.current_tool));
                } else {
                    console.log('this.current_group', this.current_group);
                    if(this.current_group) {
                        if(!this.current_group.hasOwnProperty('children')) {
                            this.current_group.children = [];
                        }
                        var obj = this.clone(this.current_tool);
                        obj.id = Math.random();
                        this.current_group.children.push(obj);
                    }

                    this.current_group = false;
                }
                this.dropped_in_droppable = true;
            },
            changeGroup(e) {
                console.log('cabc e', e);
                this.current_group = e;
            },
            clone(obj){
                var self = this;
                if(obj == null || typeof(obj) != 'object')
                    return obj;

                var temp = new obj.constructor();
                for(var key in obj)
                    temp[key] = self.clone(obj[key]);

                return temp;
            }
        }
    }
</script>

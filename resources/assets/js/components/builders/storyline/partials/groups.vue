<template>
    <div
        class="droppable groups"
        @dragover.prevent="enter"
        @dragenter.prevent="enter"
        @dragleave.prevent="leave"
        @dragend.prevent="leave"
        @drop="dropped"
        :class="{ 'dragndrop--dragged': isDraggedOver }"
        data-type="groups">

        <draggable :list="parts" :options="{group:{ name:'groups'}}">
            <div v-for="part, index in parts" class="in-group" :class="{'bottom_20' : parts.length > 1 && index != parts.length-1}">
                <group :group="parts[index]" :ct="current_tool" :cg="current_group" @changeGroup="changeGroup" @updateGroups="updateGroups" @updateDrag="updateDrag"></group>
            </div>
        </draggable>

    </div>
</template>

<style>
    .droppable {
        padding: 20px;
        width: 100%;
        border: 2px dashed #ccc;
        min-height: 50px;
        background: #f9f9f9;
    }

    /*.group {*/
        /*border: 2px dashed #ccc;*/
        /*min-height: 50px;*/
        /*background: #efefef;*/
        /*padding: 20px;*/
        /*width: 100%;*/
    /*}*/

    .bottom_20 {
        margin-bottom: 20px;
    }

    .dragndrop--dragged {
        border-color: #bbbbbb;
    }
</style>

<script>
    import draggable from 'vuedraggable'
    import group from './group'

    export default {
        components: {
            draggable,
            group
        },
        props: ['parts', 'current_tool', 'cg'],
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                isDraggedOver: false,
                current_group: this.cg
            }
        },
        methods: {
            enter(e) {
                this.current_group = e;
                this.isDraggedOver = true;
            },
            leave(e) {
                this.current_group = false;
                this.isDraggedOver = false;
            },
            dropped(e) {
                this.leave();
            },
            changeGroup(e) {
                this.current_group = e;
                this.$emit('update', e);
            },
            updateGroups() {
                this.$emit('updateGroups');
            },
            updateDrag() {
                this.leave();
            }
        }
    }
</script>

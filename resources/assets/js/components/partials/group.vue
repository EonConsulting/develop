<template>
    <div>
        <div class="group" v-show="group != false">
            <div>
                <p>{{ group.name }}</p>

                <div class="droppable group"
                     @dragover.prevent="enterGroup(group)"
                     @dragenter.prevent="enterGroup(group)"
                     @dragleave.prevent="leaveGroup(group)"
                     @dragend.prevent="leaveGroup(group)"
                     @drop.prevent="droppedInGroup(group)"
                     :class="{ 'dragndrop--dragged': isDraggedOverGroup }"
                     data-type="group"
                     :data-groupid="group.id">

                    <draggable :list="group.children" :options="{group:{ name:'groups'}}">
                        <div v-for="p, index in group.children" class="bottom_20"
                             @dragover.prevent="enterGroup(p)"
                             @dragenter.prevent="enterGroup(p)"
                             @dragleave.prevent="leaveGroup(p)"
                             @dragend.prevent="leaveGroup(p)"
                             @drop.prevent="droppedInGroup(p)">
                            <group :group="p" @groupUpdated="updateGroup"></group>
                        </div>
                    </draggable>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .droppable {
        padding: 20px;
        width: 100%;
        border: 2px dashed #ccc;
        min-height: 50px;
        background: #efefef;
    }

    .group {
        border: 2px dashed #ccc;
        min-height: 50px;
        background: #efefef;
        padding: 20px;
        width: 100%;
    }

    .bottom_20 {
        margin-bottom: 20px;
    }
</style>

<script>
    import draggable from 'vuedraggable'
    import item from './item'

    export default {
        components: {
            draggable,
            item
        },
        props: ['group'],
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                isDraggedOverGroup: false,
                current_group: false
            }
        },
        methods: {
            enter(e) {
                this.isDraggedOverGroup = true;
                this.current_group = e;
                console.log('e enter', e);
            },
            leave(e) {
                this.isDraggedOverGroup = false;
                this.current_group = e;
                console.log('e leave', e);
            },
            drop(e) {
                this.leave();
                console.log('e drop', e);
                this.current_group = e;
                this.$emit('groupUpdated', this.current_group);
            },
            enterGroup(e) {
                this.isDraggedOverGroup = true;
                this.current_group = e;
//                this.$emit('groupUpdated', e);
            },
            leaveGroup() {
                this.isDraggedOverGroup = false;
//                this.$emit('groupUpdated', false);
                this.current_group = false;
            },
            droppedInGroup(e) {
                this.leaveGroup();
                console.log('e abc', this.current_group);
                this.$emit('groupUpdated', this.current_group);
//                if(!this.group.hasOwnProperty('children')) {
//                    this.group.children = [];
//                }
//
//                this.group.children.push(gr);
            },
            updateGroup(e) {
                this.current_group = e;
                this.$emit('groupUpdated', e);
            }
        }
    }
</script>

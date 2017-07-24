<template>
    <div>
        <div class="part" :class="{'part-no-style' : part.id == -1}" v-for="part in parts" v-show="showSingle(part)">
            <div
                v-show="part.type=='group'"
                class="dragndrop"
                @dragover.prevent="enter"
                @dragenter.prevent="enter"
                @dragleave.prevent="leave"
                @dragend.prevent="leave"
                @drop.prevent="drop"
                v-bind:class="{ 'dragndrop--dragged': isDraggedOver }">

                <draggable :options="{group:'tools'}" >

                </draggable>
            </div>
        </div>
    </div>
</template>

<style>

</style>

<script>
    import draggable from 'vuedraggable'
    import item from './item'

    export default {
        components: {
            draggable,
            item
        },
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                parts:[{name: "", id: -1, icon: '', children: []}],
                isDraggedOver: false
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
            }
        }
    }
</script>

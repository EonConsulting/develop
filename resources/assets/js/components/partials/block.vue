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
                    <div v-show="part.type=='content'">
                        <p>{{ part.name }}</p>
                    </div>
                </draggable>
            </div>
        </div>
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
    import block from './block'

    export default {
        components: {
            draggable,
            block
        },
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                parts:[{name: "", id: -1, icon: ''}],
                children: [],
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
//                CKEDITOR.disableAutoInline = true;
//
//                $('.ckeditor').each(function () {
//                    CKEDITOR.inline($(this).id);
//                });
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

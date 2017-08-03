<template>
    <div class="dragndrop__file">
        <div class="progress">
            <div class="progress__label">
                {{ file.file.name }}
                <span v-if="!file.failed && !file.finished && !file.cancelled">({{ file.secondsRemaining }} seconds remaining)</span>
            </div>

            <div
                    class="progress__fill"
                    v-bind:style="{ 'width': file.progress + '%' }"
                    v-bind:class="{ 'progress__fill--finished': file.finished, 'progress__fill--failed': file.failed || file.cancelled }"
            ></div>

            <div class="progress__percentage">
                <span v-if="file.failed">Failed</span>
                <span v-if="file.finished">Complete</span>
                <span v-if="file.cancelled">Cancelled</span>

                <span v-if="!file.finished && !file.failed && !file.cancelled">
          {{ file.progress }}%
        </span>
            </div>

            <a href="#" @click.prevent="cancel" v-if="!file.finished && !file.cancelled">Cancel</a>
        </div>
    </div>
</template>

<script>
    import eventHub from '../events.js'

    export default {
        props: [
            'file'
        ],
        methods: {
            cancel () {
                this.file.xhr.abort()
                this.file.cancelled = true
            },
            updateFileObjectProgress (fileObject, e) {
                if (!e.lengthComputable) {
                    return
                }

                fileObject.loadedBytes = e.loaded
                fileObject.totalBytes = e.total

                fileObject.progress = Math.ceil((e.loaded / e.total) * 100)
            }
        },
        mounted () {
            eventHub.$on('progress', (fileObject, e) => {
                this.updateFileObjectProgress(fileObject, e)
            })

            eventHub.$on('finished', (fileObject, e) => {
                if (fileObject.id === this.file.id) {
                    this.file.finished = true
                }
            })

            eventHub.$on('failed', (fileObject, e) => {
                if (fileObject.id === this.file.id) {
                    this.file.failed = true
                }
            })
        }
    }
</script>

<style>
    .dragndrop__file {
        margin: 20px;
        margin-top: 0;
        font-size: .9em;
        position: relative;
    }

    .progress {
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        border-radius: 3px;
        background-color: #f5f5f5;
        height: 35px;
    }

    .progress__label,
    .progress__percentage {
        position: absolute;
        color: #333;
        top: 50%;
        transform: translate(0, -50%);
        margin-left: 10px;
    }

    .progress__percentage {
        right: 0;
        margin-right: 10px;
    }

    .progress__fill {
        box-sizing: border-box;
        padding: 10px;
        border-radius: 3px;
        background-color: #42b983;
        height: 100%;
        box-shadow: inset 0 -1px rgba(0, 0, 0, .15);
        transition: width 500ms ease;
        opacity: .6;
    }

    .progress__fill--failed {
        transition: none;
        width: 100%!important;
        background-color: #f66;
    }

    .progress__fill--finished {
        opacity: 1;
    }
</style>




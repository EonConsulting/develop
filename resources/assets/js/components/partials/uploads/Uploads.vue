<template>
    <div>
        <div class="dragndrop__status" v-if="files.length">
            <ul class="list-inline">
                <li class="list-inline__item">Files: {{ files.length }}</li>
                <li class="list-inline__item">Percentage: {{ overallProgress }}%</li>
                <li class="list-inline__item list-inline__item--last">Time remaining: {{ timeRemaining }}</li>
            </ul>
        </div>
        <file v-for="file in files" :file="file"></file>
    </div>
</template>

<script>
    import File from './File'
    import eventHub from '../../../events.js'
    import timeremaining from '../../../helpers/timeremaining.js'
    import pad from '../../../helpers/pad.js'

    export default {
        data () {
            return {
                overallProgress: 0,
                interval: null,
                secondsRemaining: 0,
                timeRemaining: 'Calculating'
            }
        },
        props: [
            'files'
        ],
        components: {
            File
        },
        methods: {
            unfinishedFiles () {
                var i, files = []

                for (i = 0; i < this.files.length; i++) {
                    if (this.files[i].finished || this.files[i].cancelled) {
                        continue
                    }

                    files.push(this.files[i])
                }

                return files
            },
            updateOverallProgress () {
                var unfinishedFiles = this.unfinishedFiles(), totalProgress = 0

                unfinishedFiles.forEach((file) => {
                    totalProgress += file.progress
                })

                this.overallProgress = parseInt(totalProgress / unfinishedFiles.length || 0)
            },
            updateTimeRemaining () {
                var minutes, seconds

                this.secondsRemaining = 0

                this.unfinishedFiles().forEach((file) => {
                    file.secondsRemaining = timeremaining.calculate(
                        file.totalBytes,
                        file.loadedBytes,
                        file.timeStarted
                    );

                    this.secondsRemaining += file.secondsRemaining
                });

                minutes = Math.floor(this.secondsRemaining / 60)
                seconds = this.secondsRemaining - minutes * 60

                this.timeRemaining = pad.left('00', minutes) + ':' + pad.left('00', seconds)
            }
        },
        mounted () {
            eventHub.$on('progress', (fileObject, e) => {
                this.updateOverallProgress()
            })

            eventHub.$on('init', () => {
                if (!this.interval) {
                    this.interval = setInterval(() => {
                        if (this.unfinishedFiles().length === 0) {
                            this.updateOverallProgress()
                            clearInterval(this.interval)
                            this.interval = null
                        }

                        this.updateTimeRemaining()
                    }, 1000)
                }
            })
        }
    }
</script>

<style scoped>
    .dragndrop__status {
        text-align: center;
        padding: 20px;
    }
</style>

<template>
    <div>
        <div>
            <ul class="list-inline">
                <li class="list-inline-item" v-for="( _, index) in fileNames">
                    <button
                            class="btn btn-primary"
                            @click.prevent="createPreview(index)"
                    >
                        File {{index + 1}}
                    </button>
                </li>
            </ul>
            <div class="w-100 h-100">
                <div v-if="fileType === 'picture'">
                    <img class="img-fluid" :src="sourceFile" alt="File">
                </div>
                <div v-else-if="fileType === 'pdf'" class="h-100 w-100">
                    <iframe :src="sourceFile" width="100%" height="800px">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "FilesPreview",
        data() {
            return {
                files: [],
                fileNames: [],
                fileType: '',
                sourceFile: '',
            }
        },
        created() {
            this.loadFiles;
            this.createPreview(0);
        },
        computed: {
            loadFiles() {
                const files = this.$store.getters.getFiles;
                const fileNames = this.$store.getters.getFileNames;
                if (typeof files !== "undefined") {
                    this.files = files;
                }
                if (typeof fileNames !== "undefined") {
                    this.fileNames = fileNames;
                }
            }
        },
        methods: {
            createPreview(index) {
                this.sourceFile = this.files[index];
                if ((/\.(pdf)/.test(this.fileNames[index])))
                    this.fileType = 'pdf';
                else
                    this.fileType = 'picture';
            }
        }
    }
</script>

<style scoped>

</style>

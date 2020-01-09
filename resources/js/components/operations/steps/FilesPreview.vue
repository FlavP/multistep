<template>
<div>
    <h3>Preview</h3>
</div>
</template>

<script>
    export default {
        name: "FilesPreview",
        data() {
            return {
                files: [],
                fileNames: []
            }
        },
        created() {
            this.loadFiles;
        },
        computed: {
            loadFiles() {
                const files = this.$store.getters.getFiles;
                const fileNames = this.$store.getters.getFileNames;
                if(typeof files !== "undefined"){
                    this.files = files;
                }
                if(typeof fileNames !== "undefined"){
                    this.fileNames = fileNames;
                }
            }
        },
    }
</script>

<style scoped>

</style>

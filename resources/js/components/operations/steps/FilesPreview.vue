<template>
<div>
    <div>
        <ul class="list-inline" v-for="(_, index) in fileNames">
            <li>File {{index + 1}}</li>
        </ul>

    </div>
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
            console.log(this.fileNames);
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

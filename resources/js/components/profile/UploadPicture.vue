<template>
    <div class="card">
        <div class="card-header">
            <h3>Upload Picture</h3>
        </div>
        <form
            action="/change-picture"
            method="post"
            enctype="multipart/form-data"
            novalidate
        >
            <input type="hidden" :value="userid">
            <input
                type="file"
                :name="profilePicture"
                accept="image/*"
                :disabled="isUploading"
                class="profile-picture"
            >
            <p
                class="initial"
                v-if="isInitial"
            >404 Not Found</p>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['userid'],
        name: "UploadPicture",
        data() {
            return {
                isInitial : true,
                isUploading : false
            }
        }
    }
</script>

<style lang="sass" scoped>

</style>

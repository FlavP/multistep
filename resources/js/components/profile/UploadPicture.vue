<template>
    <div class="card">
        <div class="card-header">
            <h3>Upload Picture</h3>
        </div>
        <form
            action="/profile-picture"
            method="post"
            enctype="multipart/form-data"
            novalidate
        >
            <input
                type="file"
                name="profile_picture"
                id="profile_picture"
                accept="image/*"
                class="profile-picture"
                :disabled="isUploading"
            >
            <img
                alt="Profile picture"
                class="rounded-circle img-thumbnail"
                :src="picture"
            >
            <button type="submit" class="btn btn-outline-dark">
                Set Profile Picture
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['picture'],
        name: "UploadPicture",
        data() {
            return {
                isUploading: false
            }
        }
    }
</script>

<style lang="css" scoped>

    form {
        background-color: #f8fafc;
    }
</style>

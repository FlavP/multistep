<template>
    <div class="card">
        <div class="card-header">
            <h3>Upload Picture</h3>
        </div>
        <form
            @submit.prevent="onSubmit"
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
                ref="inputFile"
                @change="handleUpload"
                hidden
            >
            <div class="row">
                <div
                    class="col-md-2 offset-4"
                >
                    <img
                        alt="Profile picture"
                        class="rounded-circle img-thumbnail profile-image"
                        :src="picture"
                        @click="changePic"
                    >
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-3">
                    <button
                        type="submit"
                        class="btn btn-outline-dark"
                    >
                     Set Profile Picture
                    </button>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
    import {sendRequest} from "../services/webServices";

    export default {
        props: ['picture'],
        name: "UploadPicture",
        data() {
            return {
                file : '',
            }
        },
        methods: {
            changePic() {
                const input = this.$refs.inputFile;
                input.click();
            },
            onSubmit() {
                // Header pentru upload de fisiere
                const headers = {
                    'Content-Type': 'multipart/form-data'
                };
                // Creez un obiect de tip form data, la care fac append cu fisierul
                let formData = new FormData();
                // Daca nu avem variabila file setata, dau return
                if (this.file === '')
                    return;
                // Fac append cu cheia pe care trimit in backend
                formData.append('profile_picture', this.file);
                sendRequest('/profile-picture', formData, headers);
                this.$router.go(0);
            },
            handleUpload() {
                // la onChange, cand schimb fisierul, salvez fisierul in variabila file din componenta
                this.file = this.$refs.inputFile.files[0];
            }
        },
    }
</script>

<style lang="scss" scoped>

    $background-color: #f8fafc;

    form {
        background-color: $background-color;
    }

    .profile-image {
        max-width: 132px;

        &:hover {
            cursor: pointer;
        }
    }
</style>

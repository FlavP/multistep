<template>
    <div>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6">
            <div class="form-group input">
                <input type="email"
                       class="disabled"
                       name="confirmed"
                       id="confirmed"
                       v-model="email"
                       disabled
                       >
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6">
            <files-preview></files-preview>
        </div>
    </div>

    <div class="row">
                <div class="col-md-6">
                    <button
                        class="btn btn-primary"
                        @click.prevent="decrease"
                    >
                        Previous
                    </button>
                </div>
                <div class="col-md-6">
                    <a href="/operations" class="btn btn-primary">

                        Next
                    </a>
                </div>
            </div>
    </div>
</template>

<script>
    import FilesPreview from "./FilesPreview";
    export default {
        name: "Step2",
        components: {FilesPreview},
        props: ['step'],
        data() {
            return {
                email: ''
            }
        },
        created() {
            this.loadEmail;
        },
        computed: {
            loadEmail() {
                this.email = this.$store.getters.getEmail;
            }
        },
        methods: {
            decrease() {
                this.$emit('update-step', 1);
            }
        }
    }
</script>

<style scoped>

</style>

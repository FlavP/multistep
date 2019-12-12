<template>
    <div>
        <div class="row">
            <h2>Step 2</h2>
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
    export default {
        name: "Step2",
        props: ['step'],
        data() {
            return {
                email: ''
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

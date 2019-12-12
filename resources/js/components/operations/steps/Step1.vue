<template>
    <div class="row offset-5">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="form-group input">
                <input type="email"
                       name="email"
                       id="email"
                       placeholder="User Email"
                       v-model="email">
            </div>
            <div class="form-group">
                <a href="/operations" class="btn btn-primary">
                    Previous
                </a>
                <button
                    class="btn btn-primary"
                    @click.prevent="increase"
                >
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Step1",
        props: ['step'],
        data() {
            return {
                email: ''
            }
        },
        methods: {
            increase() {
                this.$emit('update-step', 2);
            }
        },
    }
</script>

<style scoped>

</style>

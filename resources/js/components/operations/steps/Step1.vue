<template>
    <div>
        <div class="row">
        <input  type="email"
                name="email"
                id="email"
                placeholder="User Email"
                v-model="email">
        </div>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary">
                    Previous
                </button>
            </div>
            <div class="col-md-6">
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
                let curStep = this.step;
                curStep++;
            }
        }
    }
</script>

<style scoped>

</style>

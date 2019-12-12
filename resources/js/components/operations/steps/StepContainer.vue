<template>
    <div>
        <form>
            <step1 :step="step" v-if="step === 1" @update-step="updateStep"></step1>
            <step2 :step="step" v-if="step === 2" @update-step="updateStep"></step2>
        </form>
    </div>
</template>

<script>
    import Step1 from "./Step1";
    import Step2 from "./Step2";
    export default {
        name: "StepContainer",
        components: {
            'step1': Step1,
            'step2': Step2
        },
        data() {
            return {
                step: 1,
            }
        },
        methods: {
            updateStep(step) {
                this.step = step;
            }
        }
    }
</script>

<style scoped>

</style>

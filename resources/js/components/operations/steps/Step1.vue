<template>
    <div class="row offset-5">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="form-group input">
                <input type="email"
                       name="email"
                       id="email"
                       placeholder="User Email"
                       @blur="$v.email.$touch()"
                       :class="{invalid: $v.email.$error}"
                       v-model="email">
            </div>
            <div v-if="$v.email.required && $v.email.email && $v.email.existingEmail">
                <div class="custom-file">
                    <input
                        type="file"
                        class="custom-file-input"
                        name="file1"
                        id="file1"
                        @change="fileChange"
                    >
                    <label class="custom-file-label" for="file1">Choose first file</label>
                </div>
            </div>
            <div class="form-group">
                <a href="/operations" class="btn btn-primary">
                    Previous
                </a>
                <button
                    class="btn btn-primary"
                    ref="nextButton"
                    :disabled="true"
                    @click.prevent="increase"
                >
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate';
    import {sendGetRequest, sendRequest} from "../../services/webServices";
    import {email, required} from "vuelidate/lib/validators";
    const typeValidator = (file) => {
        console.log((/\.(jpg|jpeg|png|pdf)/.test(file.name)));
        return (/\.(jpg|jpeg|png|pdf)/.test(file.name));
    };
    const sizeValidator = (file) => {
        return file.size < 100000;
    };
    export default {
        name: "Step1",
        props: ['step'],
        mixins: [validationMixin],
        data() {
            return {
                email: '',
                clickDisabled: true,
                files: []
            }
        },
        methods: {
            increase() {
                this.$emit('update-step', 2);
            },
            filesValid(file) {
                const next = this.$refs.nextButton;
                if(next.disabled)
                    next.disabled = false;
                return  sizeValidator(file) &&
                        typeValidator(file)
            },
            fileChange(e) {
                let files = e.target.files;
                if(!files.length)
                    return;
                this.buildFiles(files[0]);
            },
            buildFiles(file) {
                // https://medium.com/@jagadeshanh/image-upload-and-validation-using-laravel-and-vuejs-e71e0f094fbb
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    if(this.filesValid(file))
                        vm.files.push(e.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        validations() {
            return {
                email: {
                    required,
                    email,
                    existingEmail: function (value) {
                        let response = {};
                        response = sendGetRequest('check-email', value);
                        return response.then(result => {
                            return result.data.count == 0;
                        })
                            .catch(err => {
                                console.log(err);
                            });
                    }
                },
                file1: {
                    required,
                }
            }
        }
    }
</script>

<style scoped>
    .input.invalid input {
        border: 1px solid red;
        background-color: #ffc9aa;
    }

    .input.invalid label {
        color: red;
    }
</style>

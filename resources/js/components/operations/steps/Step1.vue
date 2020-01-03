<template>
    <div class="row offset-5">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="form-group input">
                <input type="email"
                       name="email"
                       id="email"
                       placeholder="User Email"
                       @blur="$v.email.$touch()"
                       :class="{invalid: $v.email.$error || this.fileTypeError}"
                       v-model="email">
            </div>
            <div class="input-group mb-3" v-if="$v.email.required && $v.email.email && $v.email.existingEmail">
                <div class="custom-file">
                    <input
                            type="file"
                            class="custom-file-input"
                            name="file1"
                            id="file1"
                            @change="fileChange"
                    >
                    <label v-if="typeof fileNames[0] === 'undefined'" class="custom-file-label" for="file1">Choose first file</label>
                    <label v-else class="custom-file-label" for="file1">{{this.fileNames[0]}}</label>
                </div>
                <div class="input-group-append">
                    <button
                            class="btn btn-primary"
                            v-if="typeof fileNames[0] !== 'undefined'"
                            @click.prevent="removeFile(0)"
                    ><i class="fas fa-times"></i>
                    </button>
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
        return (/\.(jpg|jpeg|png|pdf)/.test(file.name));
    };
    const sizeValidator = (file) => {
        return file.size < 1000000;
    };
    export default {
        name: "Step1",
        props: ['step'],
        mixins: [validationMixin],
        data() {
            return {
                email: '',
                clickDisabled: true,
                fileTypeError: '',
                files: [],
                fileNames: []
            }
        },
        methods: {
            increase() {
                this.$emit('update-step', 2);
            },
            filesValid(file) {
                const next = this.$refs.nextButton;
                if (next.disabled)
                    next.disabled = false;
                return sizeValidator(file) &&
                    typeValidator(file)
            },
            fileChange(e) {
                let files = e.target.files;
                if (!files.length)
                    return;
                this.buildFiles(files[0]);
            },
            buildFiles(file) {
                // https://medium.com/@jagadeshanh/image-upload-and-validation-using-laravel-and-vuejs-e71e0f094fbb
                // ce mizerie https://stackoverflow.com/questions/54124977/vuejs-input-file-selection-event-not-firing-upon-selecting-the-same-file
                let reader = reader || new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    if (vm.filesValid(file) && file.name !== '') {
                        vm.fileNames.push(file.name);
                        vm.files.push(e.target.result);
                        vm.fileTypeError = '';
                    } else
                        vm.fileTypeError = 'This format is not supported ';
                };
                reader.readAsDataURL(file);
            },
            removeFile(index) {
                let aux = this.fileNames;
                aux.splice(index);
                this.fileNames = [];
                this.fileNames = aux;
                this.files.splice(index);
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

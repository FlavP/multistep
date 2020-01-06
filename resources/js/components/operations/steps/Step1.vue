<template>
    <div class="row offset-5">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="form-group input">
                <input type="email"
                       name="email"
                       id="email"
                       placeholder="User Email"
                       @blur="$v.email.$touch()"
                       :class="{invalid: $v.email.$error || fileTypeError}"
                       v-model="email">
            </div>
            <div v-if="$v.email.required && $v.email.email && $v.email.existingEmail">
                <div class="input-group mb-3" v-for="i in [0,1,2,3,4]" >

                    <div class="custom-file">
                        <input
                                type="file"
                                class="custom-file-input"
                                :name="'file' + i"
                                :id="'file' + i"
                                :ref="'file' + i"
                                @change="fileChange($event, i)"
                        >
                        <label
                                v-if="typeof fileNames[i] === 'undefined' || fileNames[i] === null"
                                class="custom-file-label"
                                :for="'file' + i">Choose file {{ i + 1 }}
                        </label>
                        <label
                                v-else class="custom-file-label"
                                :for="'file' + i">{{fileNames[i]}}
                        </label>
                    </div>
                    <div class="input-group-append">
                        <button
                                class="btn btn-primary"
                                v-if="typeof fileNames[i] !== 'undefined' && fileNames[i] !== null"
                                @click.prevent="removeFile(i)"
                        ><i class="fas fa-times"></i>
                        </button>
                    </div>
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
        created() {
            this.loadEmail;
        },
        computed: {
            loadEmail() {
                this.email = this.$store.getters.getEmail;
            }
        },
        methods: {
            increase() {
                // Logica de set email in store:
                this.$store.dispatch('setEmail', {
                    email: this.email
                });
                this.$emit('update-step', 2);
            },
            filesValid(file) {
                const next = this.$refs.nextButton;
                if (next.disabled)
                    next.disabled = false;
                return sizeValidator(file) &&
                    typeValidator(file)
            },
            fileChange(e, index) {
                let files = e.target.files;
                if (!files.length)
                    return;
                this.buildFiles(files[0], index);
            },
            buildFiles(file, index) {
                // https://medium.com/@jagadeshanh/image-upload-and-validation-using-laravel-and-vuejs-e71e0f094fbb
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    if (vm.filesValid(file) && file.name !== '') {
                            // vm.fileNames[index] = file.name;
                            // vm.files[index] = e.target.result;
                            // Workaround pentru codul de mai sus
                            vm.$set(vm.fileNames, index, file.name);
                            vm.$set(vm.files, index, e.target.result);
                            vm.fileTypeError = '';
                    } else
                        vm.fileTypeError = 'This format is not supported ';
                };
                reader.readAsDataURL(file);
            },
            removeFile(index) {
                let vm = this;
                // delete vm.fileNames[index];
                // delete vm.files[index];
                vm.$set(vm.fileNames, index, null);
                vm.$set(vm.files, index, null);
                // ca sa pot urca din nou acelasi fisier
                let guiltyRef = 'file' + index;
                vm.$refs[guiltyRef][0].value = '';
            },
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
                file0: {
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

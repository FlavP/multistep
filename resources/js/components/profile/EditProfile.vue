<template>

    <div class="card">
        <div class="card-header">
            <h3>Edit Profile</h3>
        </div>
        <form
            @submit.prevent="onSubmit"
            method="post"
        >
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="form-group" :class="{invalid: $v.password.$error}">
                    <label for="password">Enter your current Password: </label>
                    <input type="password"
                           name="password"
                           id="password"
                           placeholder="Password"
                           @blur="$v.password.touch()"
                           v-model="password"
                    >
                </div>
                <div class="form-group" :class="{invalid: $v.newPassword.$error}">
                    <label for="password">Enter your new Password: </label>
                    <input type="password"
                           name="newpassword"
                           id="newpassword"
                           placeholder="New Password"
                           @blur="$v.newPassword.touch()"
                           v-model="newPassword"
                    >
                    <p v-if="!$v.newPassword.minLen">The new password must be at least {{ $v.newPassword.$params.minLen.min
                        }} characters long</p>
                </div>
                <div class="form-group" :class="{invalid: $v.confirmNew.$error}">
                    <label for="password">Confirm your new Password: </label>
                    <input type="password"
                           name="confirm"
                           id="confirm"
                           placeholder="Confirm Password"
                           @blur="$v.confirmNew.touch()"
                           v-model="confirmNew"
                    >
                </div>
                <div class="form-group">
                    <button
                        type="submit"
                        class="btn btn-outline-dark"
                        :disabled="$v.$invalid"
                    >Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
    import {validationMixin} from 'vuelidate';
    import {required, minLength, sameAs} from 'vuelidate/lib/validators';
    import {sendRequest} from "../services/webServices";


    export default {
        name: "EditProfile",
        mixins: [validationMixin],
        data() {
            return {
                password: '',
                newPassword: '',
                confirmNew: '',
            }
        },
        methods: {
            onSubmit() {
                const formData = {
                    password: this.password,
                    new: this.newPassword,
                    confirm: this.confirmNew,
                    edit: true
                };
                const editUser = sendRequest('/set-user', formData);
                editUser.then(response => {
                    if (response.success) {
                        alert(response.message);
                        this.resetValues();
                    } else
                        alert(response.message);
                });
            },
            resetValues() {
                this.password = '';
                this.newPassword = '';
                this.confirmNew = '';
            },
        },
        validations: {
            password: {
                required,
            },
            newPassword: {
                required,
                minLen:minLength(5)
            },
            confirmNew: {
                required,
                sameAsPassword: sameAs('newPassword')
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

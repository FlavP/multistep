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
                        <input type="hidden"
                               name="edit"
                               id="edit"
                               v-model="userData.edit">
                        <div class="form-group" :class="{invalid: $v.password.$error}">
                            <label for="password">Enter your current Password: </label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   placeholder="Password"
                                   @blur="$v.password.touch()"
                                   v-model="userData.password"
                            >
                        </div>
                        <div class="form-group" :class="{invalid: $v.newPassword.$error}">
                            <label for="password">Enter your new Password: </label>
                            <input type="password"
                                   name="newpassword"
                                   id="newpassword"
                                   placeholder="New Password"
                                   @blur="$v.newPassword.touch()"
                                   v-model="userData.newPassword"
                            >
                        </div>
                        <div class="form-group" :class="{invalid: $v.confirmNew.$error}">
                            <label for="password">Confirm your new Password: </label>
                            <input type="password"
                                   name="confirm"
                                   id="confirm"
                                   placeholder="Confirm Password"
                                   @blur="$v.confirmNew.touch()"
                                   v-model="userData.confirmNew"
                            >
                        </div>
                        <div class="form-group">
                            <button
                                type="submit"
                                class="btn btn-outline-dark"
                                :disabled="$v.$invalid"
                            >Submit</button>
                        </div>
                    </div>
                </form>
            </div>

</template>

<script>
    import { required, minLength, sameAs } from 'vuelidate/lib/validators';
    import {sendRequest} from "../services/webServices";


    export default {
        name: "EditProfile",
        data() {
            return {
                userData: {
                    password: '',
                    newPassword: '',
                    confirmNew: '',
                },
            }
        },
        methods: {
            onSubmit() {
                const formData = {
                    password: this.userData.password,
                    new: this.userData.newPassword,
                    confirm: this.userData.confirmNew,
                    edit: true
                };
                const editUser = sendRequest('/set-user', formData);
                editUser.then(response => {
                    if (response.success){
                        alert(response.message);
                        Object.keys(this.userData).forEach(key => {
                            if (!Array.isArray(this.userData[key])) {
                                this.userData[key] = '';
                            }
                        });
                        this.userData.isActive = true;
                    } else
                        alert(response.message);
                });
            }
        },
        validations: {
            password: {
                required,
            },
            newPassword: {
                required,
                minLength: 5
            },
            confirmNew: {
                required,
                sameAsPassword: sameAs('newPassword')
            }
        }
    }
</script>

<style scoped>

</style>

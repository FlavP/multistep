<template>

    <div class="card">
        <div class="card-header">
            <h3>Add User</h3>
        </div>
        <form
            @submit.prevent="onSubmit"
            method="post"
        >
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <input type="hidden"
                           name="edit"
                           id="edit"
                           v-model="userData.edit">
                    <div class="form-group" :class="{invalid: $v.username.$error}">
                        <label for="username">Add the name for the user: </label>
                        <input type="text"
                               name="username"
                               id="username"
                               placeholder="User Name"
                               @blur="$v.username.touch()"
                               v-model="userData.username"
                        >
                    </div>
                    <div class="form-group" :class="{invalid: $v.email.$error}">
                        <label for="email">Enter User Email: </label>
                        <input type="email"
                               name="email"
                               id="email"
                               placeholder="User Email"
                               @blur="$v.email.touch()"
                               v-model="userData.email"
                        >
                    </div>
                    <div class="form-group">
                        <label for="roles">Select User Role</label>
                        <select class="form-control" id="roles" v-model="userData.selected">
                            <option v-for="role in userData.role" v-bind:value="role.value">{{role.text}}</option>
                        </select>
                    </div>
                    <div class="form-group" :class="{invalid: $v.password.$error}">
                        <label for="password">Enter a Password: </label>
                        <input type="password"
                               name="password"
                               id="password"
                               placeholder="Password"
                               @blur="$v.password.touch()"
                               v-model="userData.password"
                        >
                    </div>
                    <div class="form-group" :class="{invalid: $v.confirmPassword.$error}">
                        <label for="confirm">Re-enter the password: </label>
                        <input type="password"
                               name="confirm"
                               id="confirm"
                               placeholder="Confirm Password"
                               @blur="$v.confirmPassword.touch()"
                               v-model="userData.confirmPassword"
                        >
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="active" id="active" value="true" v-model="userData.isActive" checked>
                            <label class="form-check-label" for="active">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="active" id="inactive" value="false" v-model="userData.isActive">
                            <label class="form-check-label" for="inactive">
                                Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button
                            type="submit"
                            class="btn btn-outline-dark"
                            :disabled="$v.$invalid"
                        >Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
    import { required, email, minLength, sameAs } from 'vuelidate/lib/validators';
    import {sendRequest} from "../services/webServices";

    export default {
        name: "UserAdd",
        data() {
            return {
                userData: {
                    username: '',
                    email: '',
                    selected: 'operator',
                    role: [
                        { text : 'operator', value: 'operator' },
                        { text : 'admin', value: 'admin' }
                    ],
                    isActive: true,
                    password: '',
                    confirmPassword: '',
                }
            }
        },
        methods: {
            onSubmit() {
                const formData = {
                    username: this.userData.username,
                    email: this.userData.email,
                    role: this.userData.map(role => role.value),
                    password: this.userData.password,
                    confirmPassword: this.userData.confirmPassword,
                    active: this.userData.isActive,
                    edit: false
                };
                const addUser = sendRequest('/set-user', formData);
                addUser.then(response => {
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
            username: {
                required,
                minLength: 4,
            },
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: 5
            },
            confirmPassword: {
                required,
                sameAsPassword: sameAs('password')
            }
        }
    }
</script>

<style scoped>

</style>

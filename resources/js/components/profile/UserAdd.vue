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
                    <div class="form-group input" :class="{invalid: $v.username.$error}">
                        <label for="username">Add the name for the user: </label>
                        <input type="text"
                               name="username"
                               id="username"
                               placeholder="User Name"
                               v-model="username"
                               @blur="$v.username.$touch()">
                        <p v-if="!$v.username.required">The user name is required</p>
                        <p v-if="!$v.username.minLen">The user name must be at least {{ $v.username.$params.minLen.min
                            }} characters long</p>
                    </div>
                    <div class="form-group" :class="{invalid: $v.email.$error}">
                        <label for="email">Enter User Email: </label>
                        <input type="email"
                               name="email"
                               id="email"
                               placeholder="User Email"
                               @blur="$v.email.$touch()"
                               v-model="email"
                        >
                    </div>
                    <div class="form-group">
                        <label for="roles">Select User Role</label>
                        <select class="form-control" id="roles" v-model="selectedRole">
                            <option v-for="role in roles">{{role}}</option>
                        </select>
                    </div>
                    <div class="form-group" :class="{invalid: $v.password.$error}">
                        <label for="password">Enter a Password: </label>
                        <input type="password"
                               name="password"
                               id="password"
                               placeholder="Password"
                               @blur="$v.password.$touch()"
                               v-model="password"
                        >
                    </div>
                    <div class="form-group" :class="{invalid: $v.confirmPassword.$error}">
                        <label for="confirm">Re-enter the password: </label>
                        <input type="password"
                               name="confirm"
                               id="confirm"
                               placeholder="Confirm Password"
                               @blur="$v.confirmPassword.$touch()"
                               v-model="confirmPassword"
                        >
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="active" id="active" value="true"
                                   v-model="isActive" checked>
                            <label class="form-check-label" for="active">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="active" id="inactive" value="false"
                                   v-model="isActive">
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
                        >Submit
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
    import {validationMixin} from 'vuelidate';
    import {required, email, minLength, sameAs} from 'vuelidate/lib/validators';
    import {sendRequest} from "../services/webServices";

    export default {
        name: "UserAdd",
        mixins: [validationMixin],
        data() {
            return {
                username: '',
                email: '',
                selectedRole: 'operator',
                roles: ['operator', 'admin'],
                isActive: true,
                password: '',
                confirmPassword: '',
            }
        },
        methods: {
            onSubmit() {
                const formData = {
                    username: this.username,
                    email: this.email,
                    role: this.selectedRole,
                    password: this.password,
                    confirmPassword: this.confirmPassword,
                    active: this.isActive,
                    edit: false
                };
                const addUser = sendRequest('/set-user', formData);
                addUser.then(response => {
                    if (response.success) {
                        alert(response.message);
                        this.resetValues();
                    } else
                        alert(response.message);
                });
            },
            resetValues() {
                this.username = '';
                this.password = '';
                this.confirmPassword = '';
                this.email = '';
                this.selectedRole = 'operator';
                this.isActive = true;
            },
        },
        validations() {
            return {
                username: {
                    required,
                    minLen: minLength(4),
                },
                email: {
                    required,
                    email
                },
                password: {
                    required,
                    minLen: minLength(5)
                },
                confirmPassword: {
                    required,
                    sameAsPassword: sameAs('password')
                }
            }
        }
    }
</script>

<style>
    .input.invalid input {
        border: 1px solid red;
        background-color: #ffc9aa;
    }

    .input.invalid label {
        color: red;
    }
</style>

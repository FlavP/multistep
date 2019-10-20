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
                            <div class="form-group">
                                <label for="username">Add the name for the user: </label>
                                <input type="text"
                                       name="username"
                                       id="username"
                                       placeholder="User Name"
                                       :value="userData.username"
                                >
                            </div>
                            <div class="form-group">
                                <label for="email">Enter User Email: </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       placeholder="User Email"
                                       :value="userData.email"
                                >
                            </div>
                            <div class="form-group">
<!--                           Aici vreau dropdown     -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>

</template>

<script>
    export default {
        name: "UserAdd",
        data() {
            return {
                userData : {
                    username: '',
                    email: '',
                    role: ['operator', 'admin'],
                    isActive: true,
                    password: '',
                    confirmPassword: ''
                }
            }
        }
    }
</script>

<style scoped>

</style>

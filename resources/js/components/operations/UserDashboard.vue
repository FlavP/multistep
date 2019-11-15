<template>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-11">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th v-for="name in clients.columns">
                            {{name.name}}
                            <span v-if="name.filterable"><i class="mr-5 fas fa-search"></i></span>
                            <span v-if="name.sortable"><i class="mr-5 fas fa-sort"></i></span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="client in clients.data">
                        <td>{{ client.name }}</td>
                        <td>{{ client.age }}</td>
                        <td>{{ client.email }}</td>
                        <td>{{ client.married }}</td>
                        <td>{{ client.partner }}</td>
                        <td>actions</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
                <i class="far fa-file-excel fa-2x"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['clients'],
        name: "UserDashboard"
    }
</script>

<style scoped>

</style>

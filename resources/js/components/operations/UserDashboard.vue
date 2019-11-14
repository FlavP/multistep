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
                    <tr>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>@fat</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
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

<template>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-11">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th v-for="name in columns">
                            {{name.name}}
                            <span v-if="name.filterable"><i class="mr-5 fas fa-search"></i></span>
                            <span v-if="name.sortable"><i class="mr-5 fas fa-sort"></i></span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="client in clients">
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
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    import {sendGetRequest} from "../services/webServices";

    export default {
        name: "UserDashboard",
        created() {
            this.getClients();
        },
        data() {
            return {
                columns: [
                    {name: 'Name', filterable: true},
                    {name: 'Age', sortable: true},
                    {name: 'Email', filterable: true},
                    {name: 'Married', filterable: true},
                    {name: 'Partner Name'},
                    {name: 'Actions'}
                ],
                clients: {},
                pagination: {},
            }
        },
        methods: {
            // Ca sa nu mai dau clientii prin props
            getClients(page_url) {
                let vm = this;
                let url = page_url || '/get-clients';
                let response = sendGetRequest(url);
                response.then(result => {
                    this.clients = result.data.data;
                    vm.paginate(result.data.meta, result.data.links);
                });
            },
            paginate(meta, links) {
                console.log(links);
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
            }
        }
    }
</script>

<style scoped>

</style>

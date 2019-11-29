<template>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2">
                <input class="form-control form-control-md"
                       v-model="searchString"
                       :class="{hidden: searchField}"
                       @input="searchClient"
                       type="text">
            </div>
            <div class="col-md-11">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th v-for="name in columns">
                            {{name.name}}
                            <a href="#"
                               class="text-decoration-none text-dark"
                               @click="toggleSearch(name.name)"
                               v-if="name.filterable"
                            >
                                <i class="ml-3 fas fa-search"></i>
                            </a>
                            <a href="#"
                               class="text-decoration-none text-dark"
                               v-if="name.sortable"
                               @click="toggleFilter(name.name)"
                            ><i class="ml-3 fas fa-sort"></i></a>
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
                <button @click="exportClients" class="btn btn-success">
                    <i class="far fa-file-excel fa-2x"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-5">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <li
                            v-bind:class="[{disabled: !pagination.prev_page_url}]"
                            class="page-item">
                            <a href="#"
                               class="page-link"
                               @click="getClients(pagination.prev_page_url)"
                            >Previous</a></li>
                        <li class="page-item disabled">
                            <a class="page-link text-dark" href="#">
                                Page {{ pagination.current_page }} of {{ pagination.last_page }}
                            </a>
                        </li>
                        <li
                            v-bind:class="[{disabled: !pagination.next_page_url}]"
                            class="page-item">
                            <a href="#"
                               class="page-link"
                               @click="getClients(pagination.next_page_url)"
                            >Next</a></li>
                        <li style="margin-right: -150px;" class="page-item">
                            <input
                                type="text"
                                ref="pageno"
                                id="pageno"
                                name="pageno"
                                class="form-control form-control-md w-25"
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="page-link"
                                @click="goToPage"
                            >Go to</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    import {sendRequest, sendGetRequest} from "../services/webServices";

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
                    {name: 'Married'},
                    {name: 'Partner Name', filterable: true},
                    {name: 'Actions'}
                ],
                filterColumn: '',
                filterOrder: '',
                searchColumn: '',
                searchField: true,
                searchString: '',
                clients: {},
                pagination: {},
                clientParams: {},
            }
        },
        methods: {
            // Ca sa nu mai dau clientii prin props
            getClients(page_url) {
                let url = page_url || '/get-clients';
                if (url !== '/get-clients')
                    delete this.clientParams.page;
                let vm = this;
                let response = {};
                response = sendGetRequest(url, vm.clientParams);
                response.then(result => {
                    this.clients = result.data.data;
                    vm.paginate(result.data.meta, result.data.links);
                });
            },
            paginate(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page: meta.current_page + 1,
                    prev_page: meta.current_page - 1,
                    prev_page_url: links.prev,
                    next_page_url: links.next,
                };
                this.pagination = pagination;
            },
            goToPage() {
                let pageNumber = this.$refs.pageno.value;
                if (typeof pageNumber === 'undefined' || pageNumber <= 0 || pageNumber > this.pagination.last_page)
                    return;
                else{
                    this.clientParams.page = pageNumber;
                    this.getClients('');
                }
            },
            searchClient() {
                if (this.searchString.length >= 3){
                    this.clientParams.search_column = this.searchColumn;
                    this.clientParams.match = this.searchString;
                    this.getClients('');
                }
                else{
                    this.resetFilters();
                    this.getClients('');
                }
            },
            toggleSearch(column) {
                this.searchField = !this.searchField;
                this.searchColumn = column.toLowerCase();
            },
            toggleFilter(column) {
                this.filterColumn = column.toLowerCase();
                this.filterOrder = (this.filterOrder === '' || this.filterOrder === 'desc') ? 'asc' : 'desc';
                this.showOrdered();
            },
            showOrdered() {
                this.clientParams.filter_column = this.filterColumn;
                this.clientParams.order = this.filterOrder;
                this.getClients('');
            },
            resetFilters() {
                this.clientParams = {};
            },
            exportClients() {
                const url = '/export-clients';
                sendRequest(url, {
                    clients: this.clients,
                    headings: this.columns
                });
            }
        }
    }
</script>

<style scoped>
    .hidden {
        display: none;
    }
</style>

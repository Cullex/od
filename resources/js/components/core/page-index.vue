<script>
    import Data from "../../core/data/Data";
    export default {
        name: "page-index",
        props : ['url', 'prefix' , 'name'],
        data(){
            return {
                data :  new Data({
                    url : this.url,
                    prefix : this.prefix
                })
            };
        },
        mounted() {
            this.data.fetch()
        }
    }
</script>

<template>
    <div class="row">
        <div class="col-lg-12">
            <form @submit.prevent="data.fetch()" class="card">
                <div class="card-body d-flex flex-wrap flex-fill">
                    <slot :filters="data.filters" name="filters"/>
                    <div class="flex-fill form-group mr-2">
                        <div class="app-search">
                            <div>
                                <div class="input-group">
                                    <input type="text" v-model="data.filters.search" placeholder="Search..." class="form-control">
                                    <span class="mdi mdi-magnify"></span>
                                    <div class="input-group-append">
                                        <button type="submit" @click.prevent="data.fetch()" :class="['btn btn-primary' , data.loading ? 'btn-loading' : '' ]">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button @click="data.fetch()" :class="['btn btn-primary' , data.loading ? 'btn-loading' : '' ]">
                            <i class="mdi mdi-autorenew"></i>
                        </button>
                        <slot name="actions"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex align-items-center p-3 flex-wrap">
                    <div class="h4 m-o">
                        {{ name }}
                    </div>
                    <div class="ml-auto mr-3 d-flex align-items-center">
                        <div class="mr-2">Showing</div>
                        <div class="form-group mb-0">
                            <select @change="data.fetch()" v-model="data.filters.size" class="custom-select">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="mr-3 d-flex align-items-center">
                        <div class="mr-2">Sort By</div>
                        <div class="form-group mb-0">
                            <select @change="data.fetch()" v-model="data.sort.field" class="custom-select">
                                <option value="id">ID</option>
                                <slot name="sort-fields"/>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="form-group mb-0">
                            <select @change="data.fetch()" v-model="data.sort.direction" class="custom-select">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th/>
                                <slot name="table-header"/>
                            <th/>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in data.content.data">
                            <td/>
                                <slot name="table-row" :row="row"/>
                            <td/>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body d-flex align-items-center border-top">
                    <div class="mr-auto font-weight-bolder">
                        Showing {{ data.content.data.length }} of {{ data.content.total }} Records
                    </div>
                    <div v-if="data.content.total !== data.content.to && data.content.data.length > 0" >
                        <button @click="data.append()" :class="['btn btn-primary' , data.loading ? 'btn-loading' : '' ]" >Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
    import Data from "../../core/data/Data";
    export default {
        name: "data-select",
        props: ['value' , 'name' , 'url' , 'prefix' ,'start'],
        mounted : function()
        {
            this.data.fetch();
        },
        data : function(){
            return {
                data : new Data({
                    url : this.url,
                    prefix : this.prefix,
                }),
                selected : '',
                selectedName :  '',
                dialog : false,
            };
        },
        watch : {
            start : function( n , o) {
                this.selectedName = n[ this.select ? this.select : 'select_name' ] ;
                this.selected = n.id;
            }
        },
        methods : {
            add : function (row){
                this.selected = row.id;
                this.selectedName = row.select_name;
                this.close();
                this.update();
            },

            close : function(){
                this.dialog = false;
            },

            open : function(){
                this.dialog = true;
            },
            remove : function (row)
            {
                this.selected = "";
                this.selectedName = "";
                this.update();
            },
            update : function () {
                this.$emit('input', this.selected);
            }
        }

    }
</script>
<template>
    <div class="data-container">
        <div @click="open" v-if="!selected" class="start mw-400 border">
            <div>
                Click to select {{ name }}
            </div>
            <button @click="open" style="margin-top: 3px" class="btn btn-white btn-icon border-0">
                <i class="mdi mdi-circle-edit-outline mdi-24px"></i>
            </button>
        </div>

        <div v-if="selected" class="result mw-400 border">
            <div>
                Selected : <strong><span class="text-primary">#</span> {{ selected }} - {{ selectedName }} </strong>
            </div>
            <button @click="open" style="margin-top: 3px" class="btn btn-white btn-icon btn-sm border-0">
                <i class="mdi mdi-circle-edit-outline mdi-24px"></i>
            </button>
        </div>
        <div v-if="dialog" class="select-container">
            <div class="container">
                <div class="row justify-content-center card">
                    <div v-if="selected" class="card-body bg-white col-lg-12 text-center border-bottom d-flex align-items-center justify-content-center">
                       <div><strong class="badge badge-light font-14 p-1 m-1"><span class="text-primary">#</span> {{ selected }}- {{ selectedName }} </strong></div>
                    </div>
                    <div class='dimmer col-lg-12 bg-white px-0 font-12'>
                        <div style="height:70vh;position: relative">
                            <div class="select-header card-body border-bottom d-flex align-items-center">
                                <form @submit.prevent="data.fetch()" class="d-flex align-items-center border-right mr-3 pr-3 font-12 mr-auto">
                                    <i class="mdi mdi-search-web" size="16"/>
                                    <input v-model="data.filters.search" type="text" class="form-control border-0" placeholder="Search..">
                                </form>
                                <button @click="close" type="button" class="btn btn-light btn-sm">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </div>
                            <div class="select-content">
                                <div v-if="data.content.total > 0" class="table-responsive">
                                    <table class="table border-bottom table-vcenter">
                                        <thead>
                                        <tr class="bg-light">
                                            <th width="10"/>
                                            <slot name="table-header"/>
                                            <th class="text-center"/>
                                            <th width="10"/>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <template v-for="row in data.content.data">
                                            <tr :key="row.id">
                                                <td/>
                                                <slot :row="row" name="table-row"/>
                                                <td class="text-center">
                                                    <button @click="add(row)" v-if="row.id !== selected" class="btn btn-white btn-sm">
                                                        <i class="mdi mdi-checkbox-marked-circle-outline mdi-24px"></i>
                                                    </button>
                                                    <button @click="remove(row)" v-if="row.id === selected" class="btn btn-icon btn-primary btn-sm shadow-none">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </td>
                                                <td/>
                                            </tr>
                                        </template>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body d-flex align-items-center pb-3">
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
                </div>
            </div>
        </div>
    </div>
</template>



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
            value :  function(n , o){
                if (n == "")
                {
                    this.selected = "";
                    this.selectedName = "";
                    this.update();
                }
            },
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
        <div v-if="!selected" class="start mw-400 border">
            <div>
                Click to select {{ name }}
            </div>
            <button @click.prevent="open" class="btn btn-white btn-icon border-0 mt-px-3">
                <i class="mdi mdi-circle-edit-outline mdi-24px"></i>
            </button>
        </div>
        <div v-if="selected" class="result mw-400 border">
            <div>
                <strong><span class="text-primary">#</span> {{ selected }} - {{ selectedName }} </strong>
            </div>
            <button @click="open" class="btn btn-white btn-icon btn-sm border-0 mt-px-3">
                <i class="mdi mdi-circle-edit-outline mdi-24px"></i>
            </button>
        </div>
        <div v-if="dialog"  @keydown.esc="dialog = false" class="select-container">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">
                                <div class="card-body py-2 border-bottom d-flex align-items-center justify-content-between">
                                   <h4 class="h4 my-0">{{ name }}</h4>
                                    <button @click="close" class="btn btn-white">
                                        <i class="mdi mdi-close mdi-24px text-primary pointer"></i>
                                    </button>
                                </div>
                                <div v-if="selected" class="card-body py-1 bg-white text-center border-bottom d-flex align-items-center justify-content-center">
                                    <div><strong class="badge badge-light font-13 p-1 m-1"><span class="text-primary">#</span> {{ selected }}- {{ selectedName }} </strong></div>
                                </div>
                                <form @submit.prevent="data.fetch()" class="d-flex align-items-center border-bottom px-3">
                                    <span class="pr-1">
                                        <i class="mdi  mdi-magnify mdi-24px text-muted"/>
                                    </span>
                                    <input v-model="data.filters.search" type="text" class="form-control border-0 py-3">
                                    <button @click.prevent="data.fetch()" :class="['btn btn-white' , data.loading  ? 'btn-loading' : '']">
                                        <i class="mdi  mdi-refresh mdi-24px text-primary pointer"/>
                                    </button>
                                </form>
                                <div v-if="data.content.total > 0" class="select-items-select-container">
                                    <div :key="row.id" v-for="row in data.content.data" class="border-bottom select-item">
                                        <div class="px-3 py-2 d-flex align-items-center">
                                            <slot :row="row" name="select"/>
                                            <div class="ml-auto pointer">
                                                <button @click="add(row)" v-if="row.id !== selected" class="btn btn-white btn-sm">
                                                    <i class="mdi mdi-checkbox-marked-circle-outline mdi-24px"></i>
                                                </button>
                                                <button @click="remove(row)" v-if="row.id === selected" class="btn btn-icon btn-primary btn-sm shadow-none">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="card-body text-muted text-center">
                                    No records found
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    <div class="text-muted font-13">
                                        Showing {{ data.content.data.length }} of {{ data.content.total }} Records
                                    </div>
                                    <div v-if="data.content.total !== data.content.to && data.content.data.length > 0" class="ml-auto text-primary pointer">
                                        <button @click="data.append()" :class="['btn btn-light' , data.loading ? 'btn-loading' : '']">
                                            <i :class="['mdi mdi-24px mdi-arrow-down']"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>




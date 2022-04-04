<script>
    import Data from "../../core/data/Data";

    export default {
        name: "gallery",
        props : ['id' , 'type'],
        data() {
            return {
                files : [] ,
                data : new Data({
                    url : `/images/${this.id}/${this.type}/list`,
                    prefix : 'images'
                })
            };
        },
        computed : {
            upload : function () {
                return this.files.length > 0 && !this.close;
            },
            close : function () {
                return this.files.length > 0 && this.files.filter(e => e.id === 1 || e.id === 2  ).length === this.files.length;
            },
            loading :  function () {
                return this.files.filter( e =>  e.id === 3 ).length > 0
            }
        },
        methods : {
            action : function(id , action){
                window.action(action , 'Image' , `${window.location.origin}/images/${id}/${action}`)
                    .then((response) => {
                        this.data.fetch();
                    }).bind(this);
            },
            handleFiles : function(){
                let uploadedFiles = this.$refs.files.files;
                for(let i = 0; i < uploadedFiles.length; i++)
                {
                    this.files.push({
                        id : 0,
                        content : uploadedFiles[i]
                    });
                }
                this.getImagePreviews();
            },
            reset : function(){
                this.files = [];
            },
            init()
            {
                this.data.fetch();
                this.data.filters.size = 100;
            },
            getImagePreviews : function()
            {
                for( let i = 0; i < this.files.length; i++ )
                {
                    if ( /\.(jpe?g|png|gif)$/i.test( this.files[i].content.name ) ) {
                        let reader = new FileReader();
                        reader.addEventListener("load", function(){
                            this.$refs['preview'+parseInt(i)][0].src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL( this.files[i].content );
                    } else {
                        this.$nextTick(function(){
                            this.$refs['preview'+parseInt(i)][0].src = '/img/generic.png';
                        });
                    }
                }
            },

            removeFile : function(key){
                this.files.splice( key, 1 );
                this.getImagePreviews()
            },
            submitFiles : function()
            {
                for( let i = 0; i < this.files.length; i++ )
                {
                    if(this.files[i].id > 0) {
                        continue;
                    }
                    let formData = new FormData();
                    formData.append('file', this.files[i].content);
                    this.files[i].id = 3;
                    window.axios.post(`/images/${this.id}/${this.type}/upload`,
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then((data) => {
                        this.files[i].id = 1;
                        this.files.splice(i, 1, this.files[i]);
                        this.data.fetch();
                    }).catch((data) => {
                        this.files[i].id = 2;
                    }).finally(() => {

                    });
                }
            },
        },

        mounted() {
            this.init();
        }
    }
</script>
<template>
    <div :class="['dimmer']">
        <div class="loader"></div>
        <div class="dimmer-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div :class="['mb-2' , files.length > 0 ? 'col-lg-4': 'col-lg-12']">
                                    <div class="filezone">
                                        <input type="file" id="files" ref="files" multiple @change="handleFiles()" accept="image/*"/>
                                        <p class="d-flex align-items-center justify-content-center">
                                            Drop your images here <br> or click to select
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-2" v-for="(file, key) in files"  :class="['dimmer' , file.id === 3  ? 'active' : '']">
                                    <div class="loader"></div>
                                    <div class="dimmer-content">
                                        <div  class="gallery-preview-container">
                                            <img class="gallery-preview-image" :ref="'preview'+parseInt(key)"/>
                                            <div  class="gallery-preview-image-top text-white text-center text-wrap d-flex align-items-center justify-content-center">
                                                <span>{{ file.content.name }}</span>
                                            </div>
                                            <a @click.prevent="removeFile(key)" href="#" class="gallery-preview-image-remove text-white text-center text-wrap d-flex align-items-center justify-content-center">
                                                <span>Remove</span>
                                            </a>
                                            <div v-if="file.id === 1" class="d-flex align-items-center justify-content-center text-white gallery-preview-image-success">
                                                <span class="font-24">Success</span>
                                            </div>
                                            <div v-if="file.id === 2" class="d-flex align-items-center justify-content-center text-white gallery-preview-image-error">
                                                <span class="font-24">Error</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="upload" class="col-lg-4">
                                    <div :class="['dimmer' , loading  ? 'active' : '']">
                                        <div class="loader"></div>
                                        <div class="dimmer-content">
                                            <a @click.prevent="submitFiles" href="#" class="d-flex align-items-center justify-content-center text-center border gallery-upload-button">
                                                <div class="">
                                                    <i class="mdi mdi-upload-multiple font-24"></i> <br>
                                                    <span class="font-24">Upload</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div  v-if="close" class="col-lg-4">
                                    <div :class="['dimmer' , loading  ? 'active' : '']">
                                        <div class="loader"></div>
                                        <div class="dimmer-content">
                                            <a @click.prevent="reset" href="#" class="d-flex align-items-center justify-content-center text-center border gallery-upload-button">
                                                <div class="">
                                                    <i class="mdi mdi-close font-24"></i> <br>
                                                    <span class="font-24">Close</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="data.content.data.length > 0 " class="col-lg-12">
                    <div :class="['dimmer']">
                        <div class="loader"></div>
                        <div class="dimmer-content">
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="m-o">
                                            <button @click="data.fetch()" :class="['btn btn-primary' , data.loading ? 'btn-loading' : '' ]">
                                                <i class="mdi mdi-autorenew mr-2"></i> Refresh
                                            </button>
                                        </div>
                                        <div class="ml-3 mx-0 h5">
                                            {{ data.content.data.length }} of {{ data.content.total }} Images
                                        </div>
                                        <div class="ml-auto mr-3 d-flex align-items-center">
                                            <div class="form-group mb-0">
                                                <select @change="data.fetch()" v-model="data.filters.confirmed" class="custom-select">
                                                    <option :value="undefined">Choose Confirmed</option>
                                                    <option value="confirmed">Confirmed</option>
                                                    <option value="null">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mr-3 d-flex align-items-center">
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
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 mb-3" :key="item.id" v-for="item in data.content.data">
                                            <div :class="['border' , item.cover ? 'border-primary' : '']">
                                                <div :class="['dimmer' , item.optimized ? '' : 'active' ]">
                                                    <div class="loader"></div>
                                                    <div class="dimmer-content">
                                                        <img v-if="item.optimized" class="gallery-show-image" :src="item.medium" alt="">
                                                        <img v-if="!item.optimized" class="gallery-show-image" :src="item.path" alt="">
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tx-11">
                                                        <div><strong>{{ item.name | string_limit }}</strong></div>
                                                        <div class="text-muted">{{ item.user.email }}  | <strong>  {{ item.user.name }} </strong></div>
                                                        <div class="text-muted">{{ item.created_at }}  | <strong>  {{ Math.round(item.size / 1024) }} kb </strong></div>
                                                    </div>
                                                    <div class="d-flex mt-3">
                                                        <a :href="`/images/${item.id}/download`" target="_blank" :class="['btn btn-light mr-2' , data.loading ? 'btn-loading' : '']">
                                                            <i class="mdi mdi-download"></i>
                                                        </a>
                                                        <a v-if="!item.cover" @click.prevent="action(item.id , 'favorite')" :class="['btn btn-light mr-2' , data.loading ? 'btn-loading' : '']">
                                                            <i class="mdi mdi-star"></i>
                                                        </a>
                                                        <a v-if="item.cover" @click.prevent="action(item.id , 'un-favorite')" :class="['btn btn-light mr-2' , data.loading ? 'btn-loading' : '']">
                                                            <i class="mdi mdi-star-off"></i>
                                                        </a>
                                                        <a v-if="!item.confirmed" @click.prevent="action(item.id , 'confirm')" :class="['btn btn-light mr-2' , data.loading ? 'btn-loading' : '']">
                                                            <i class="mdi mdi-check"></i>
                                                        </a>
                                                        <a v-if="item.confirmed" @click.prevent="action(item.id , 'remove')" :class="['btn btn-light mr-2' , data.loading ? 'btn-loading' : '']">
                                                            <i class="mdi mdi-close"></i>
                                                        </a>
                                                        <a v-if="!item.optimized" @click.prevent="action(item.id , 'optimize')" :class="['btn btn-light mr-2' , data.loading ? 'btn-loading' : '']">
                                                            <i class="mdi mdi-file-image-outline"></i>
                                                        </a>
                                                        <a @click.prevent="action(item.id , 'delete')" :class="['btn btn-light ml-auto' , data.loading ? 'btn-loading' : '']">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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


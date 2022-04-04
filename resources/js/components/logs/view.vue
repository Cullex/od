<script>
    export default {
        name: "user-view",
        data() {
            return {
                message: {},
                loading: true
            };
        },
        methods : {
            action(action){
                window.action(action , 'Messages' , `${window.location.origin}/messages/${this.$route.params.id}/${action}`).then((response) => {
                    this.message = response.data.body.model;
                });
            },
            init(){
                this.loading = true;
                window.axios.get(`${window.location.origin}/messages/${this.$route.params.id}/view`).then((response) => {
                    this.message = response.data.body.model;
                }).finally(() => {
                    this.loading = false;
                });
            }
        },
        mounted() {
            this.init();
        }
    }
</script>
<template>
    <div :class="['dimmer' , loading ? 'active' : '']">
        <div class="loader"></div>
        <div class="dimmer-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ribbon-box ">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3 flex-wrap">
                                <h4 class="header-title m-0 flex-fill">Personal Information</h4>
                                <div class="">
                                    <button v-if="message.status == 'open'" @click="action('close')" type="button" class="btn btn-light m-1">
                                        <i class="mdi  mdi-lightbulb-off-outline mr-1"></i> Close
                                    </button>
                                    <button v-if="message.status == 'closed'"  @click="action('open')"  type="button" class="btn btn-light m-1">
                                        <i class="mdi mdi-lightbulb-outline mr-1"></i> Open
                                    </button>
                                </div>
                            </div>
                            <div class="text-left">
                                <p>
                                    <strong class="mr-2">Status :</strong>
                                    <span>{{ message.status }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2">First Name :</strong>
                                    <span>{{ message.name }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2">Last Name :</strong>
                                    <span>{{ message.phone }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2"> Email :</strong>
                                    <span>{{ message.email }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2"> Message :</strong>
                                    <span>{{ message.message }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2">Created :</strong>
                                    <span>{{ message.created_at }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

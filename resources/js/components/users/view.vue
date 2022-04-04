<script>
    export default {
        name: "user-view",
        data() {
            return {
                user: {
                    roles : [],
                    permissions : [],
                },
                loading: true
            };
        },
        methods : {
            action(action){
                window.action(action , 'User' , `${window.location.origin}/users/${this.$route.params.id}/${action}`).then((response) => {
                    this.user = response.data.body.model;
                });
            },
            init(){
                this.loading = true;
                window.axios.get(`${window.location.origin}/users/${this.$route.params.id}/view`).then((response) => {
                    this.user = response.data.body.model;
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
                                    <button v-if="!user.status" @click="action('activate')" type="button" class="btn btn-light m-1">
                                        <i class="mdi mdi-lightbulb-outline mr-1"></i> Activate
                                    </button>
                                    <button v-if="user.status" @click="action('deactivate')"  type="button" class="btn btn-light m-1">
                                        <i class="mdi mdi-lightbulb-off-outline mr-1"></i> De-Activate
                                    </button>
                                </div>
                            </div>
                            <div class="text-left">
                                <p>
                                    <strong class="mr-2">First Name :</strong>
                                    <span>{{ user.name }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2">Last Name :</strong>
                                    <span>{{ user.last_name }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2"> Email :</strong>
                                    <span>{{ user.email }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2">Created :</strong>
                                    <span>{{ user.created_at }}</span>
                                </p>
                                <p>
                                    <strong class="mr-2">Status :</strong>
                                    <span> <span class="badge badge-light p-2 font-12">{{ user.status ? 'activated' : 'de-activated' }}</span></span>
                                </p>
                                <p v-if="user.roles.length > 0">
                                    <strong class="mr-2">Roles :</strong>
                                    <span> <span v-for="row in user.roles" class="badge badge-light p-2 m-1 mb-0 font-12">{{ row.name }}</span></span>
                                </p>
                                <p v-if="user.permissions.length > 0">
                                    <strong class="mr-2">Permissions :</strong>
                                    <span> <span v-for="row in user.permissions" class="badge badge-light p-2 m-1 font-12">{{ row.name }}</span></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

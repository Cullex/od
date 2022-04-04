<script>
    export default {
        name: "user-view",
        data() {
            return {
                role : {
                    permissions : []
                },
                loading: true
            };
        },
        methods : {
            init(){
                this.loading = true;
                window.axios.get(`${window.location.origin}/roles/${this.$route.params.id}/view`).then((response) => {
                    this.role = response.data.body.model;
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
                                <h4 class="header-title m-0 flex-fill">Role Information</h4>
                            </div>
                            <div class="text-left">
                                <p>
                                    <strong class="mr-2">Name :</strong>
                                    <span>{{ role.name }}</span>
                                </p>
                                <p v-if="role.permissions.length > 0">
                                    <strong class="mr-2">Permissions :</strong>
                                    <span> <span v-for="row in role.permissions" class="badge badge-light p-2 m-1 mb-0 font-12">{{ row.name }}</span></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

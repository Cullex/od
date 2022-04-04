<script>
    export default {
        name: "internal",
        data()
        {
            return {
                user : window.user
            }
        },
        methods : {
        }
    }
</script>
<template>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 flex-wrap">
                        <h4 class="header-title m-0 flex-fill">Personal Information</h4>
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
                        <p v-if="user.permissions.length > 0">
                            <strong class="mr-2">Permissions :</strong>
                            <span> <span v-for="row in user.permissions" class="badge badge-light p-2 m-1 font-12">{{ row.name }}</span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


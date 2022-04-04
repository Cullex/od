<template>
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Edit User Profile</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" v-model="user.name"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" v-model="user.last_name"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" v-model="user.email"  class="form-control form-control-sm" disabled>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control form-control-sm"  v-model="user.status" data-toggle="select2" >
                            <option value=1>Active</option>
                            <option value=0>Disable</option>
                        </select>
                        <p class="text-danger" v-text="errors.status"></p>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control form-control-sm"  v-model="user.accessLevel" data-toggle="select2" >
                            <option value="ordinary">Ordinary</option>
                            <option value="administrator">Administrator</option>
                            <option value="checker">Checker</option>
                            <option value="aprrover">Approver</option>
                        </select>
                        <p class="text-danger" v-text="errors.accessLevel"></p>
                    </div>
                    <a  @click="updateUser()" class="btn btn-warning">Update User Profile</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            user : {},
            name: '',
            last_name: '',
            status: '',
            accessLevel: '',
            email: '',
            created_at: '',
            errors:{},
        };
    },
    methods:{

        updateUser()
        {
            window.Swal.fire({
                title: 'Update User Profile?',
                text: "Are You Sure You Want To Update Profile?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update!'
            }).then((result) => {
                if (result.value) {
                    window.axios.post(`/updateUser/${this.user.id}`, this.user).then((response) => {
                        console.log("updated");
                        console.log(response);
                        this.$router.push('/accessManagement/allUsers')
                    }).catch((errors) => {
                        Swal.fire(
                            'Error In Fields!',
                            'Kindly Check Your Fields',
                            'error'
                        )
                        this.errors = errors.response.data.errors
                    })
                    Swal.fire(
                        'Updated Successfully!',
                        'User Profile Updated Successfully',
                        'success'
                    )
                }
            })
        },
    },
    mounted() {
        window.axios.get('/editUser/' + this.$route.params.id).then((response) =>
            (this.user = response.data.body.user))
            .catch((errors) =>{
                this.errors = errors.response.data.errors
            });
    }
}
</script>




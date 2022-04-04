<template>
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Review Application</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Applicant Lastname</label>
                        <input type="text" v-model="application.last_name"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Applicant FirstName</label>
                        <input type="text" v-model="application.first_name"  class="form-control form-control-sm"  disabled>
                        <p class="text-danger" v-text="department"></p>
                    </div>
                    <div class="form-group">
                        <label>Amount Applied</label>
                        <input type="text" v-model="application.amount"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Application Status</label>
                        <input type="text" v-model="application.status"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" v-model="application.account_number"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Overdraft Tenure</label>
                        <input type="text" v-model="application.overdraft_tenure"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea v-model="comment" cols="30" rows="6" class="form-control form-control-sm"  required></textarea>
                    </div>
                    <a  @click="approveOverdraftApplication()" class="btn btn-warning">Approve Application</a>
                    <a  @click="revokeOverdraftApplication()" class="btn btn-warning">Revoke Application</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            application : {
                first_name: '',
                last_name: '',
                overdraft_tenure: '',
                account_number: '',
                amount: '',
                status: '',
            },

        };
    },
    methods:{

        approveOverdraftApplication()
        {
            window.Swal.fire({
                title: 'Approve Application?',
                text: "Are You Sure You Want To Approve Application?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve!'
            }).then((result) => {
                if (result.value) {
                    window.axios.post(`/approveOverdraftApplication/${this.application.id}`, this.application).then((response) => {
                        console.log("applicant shortlisted");
                        console.log(response);
                        this.$router.push('/applications/receivedApplications')
                    }).catch((errors) => {
                        Swal.fire(
                            'Error In Fields!',
                            'Comment Field Is Required',
                            'error'
                        )
                        this.errors = errors.response.data.errors
                    })
                    Swal.fire(
                        'Successful!',
                        'Application Successfully Approved',
                        'success'
                    )
                }
            })
        },
        revokeOverdraftApplication()
        {
            window.Swal.fire({
                title: 'Revoke Application?',
                text: "Are You Sure You Want To Revoke Application?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Revoke!'
            }).then((result) => {
                if (result.value) {
                    window.axios.post(`/revokeOverdraftApplication/${this.application.id}`, this.application).then((response) => {
                        console.log("application revoked");
                        console.log(response);
                        this.$router.push('/applications/receivedApplications')
                    }).catch((errors) => {
                        Swal.fire(
                            'Error In Fields!',
                            'Kindly Check Your Fields',
                            'error'
                        )
                        this.errors = errors.response.data.errors
                    })
                    Swal.fire(
                        'Successful!',
                        'Application Successfully Revoked',
                        'success'
                    )
                }
            })
        },
    },
    mounted() {
        window.axios.get('/viewOverdraftApplication/' + this.$route.params.id).then((response) =>
            (this.application = response.data.body.application))
            .catch((errors) =>{
                this.errors = errors.response.data.errors
            });
    }
}
</script>





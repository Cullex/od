<template>
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Application Information</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Vacancy Title</label>
                        <input type="text" v-model="application.vacancy"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Application Status</label>
                        <input type="text" v-model="application.status"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Date Applied</label>
                        <input type="text" v-model="application.created_at"  class="form-control form-control-sm"  disabled>
                    </div>
                    <a  @click="revokeApplication()" class="btn btn-warning">Revoke Application</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            application : {},
            vacancy: '',
            status: '',
            created_at: '',
        };
    },
    methods:{
        revokeApplication()
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
                    window.axios.post(`/revokeApplication/${this.application.id}`, this.application).then((response) => {
                        console.log("application revoked");
                        console.log(response);
                        this.$router.push('/vacancies/appliedVacancies')
                    }).catch((errors) => {
                        Swal.fire(
                            'Error In Fields!',
                            'Kindly Check Your Fields',
                            'error'
                        )
                        this.errors = errors.response.data.errors
                    })
                    Swal.fire(
                        'Revocation Successful!',
                        'Application Successfully Revoked',
                        'success'
                    )
                }
            })


        },
    },
    mounted() {
        window.axios.get('/selectApplication/' + this.$route.params.id).then((response) =>
            (this.application = response.data.body.application))
            .catch((errors) =>{
                this.errors = errors.response.data.errors
            });
    }
}
</script>





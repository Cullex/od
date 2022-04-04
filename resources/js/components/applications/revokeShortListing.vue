<template>
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Revoke ShortListing</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>ShortListed Applicant Name</label>
                        <input type="text" v-model="applicant.applicantName"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>ShortListed Applicant Surname</label>
                        <input type="text" v-model="applicant.applicantSurname"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Interview Date</label>
                        <input type="text" v-model="applicant.interviewDate"  class="form-control form-control-sm"  disabled>
                    </div>
                    <div class="form-group">
                        <label>Decision</label>
                        <input type="text" v-model="applicant.decision"  class="form-control form-control-sm"  disabled>
                    </div>
                    <a  @click="revokeShortListing()" class="btn btn-warning">Revoke ShortListing</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            applicant : {},
            decision: '',
            interviewDate: '',
            interviewTime: '',
            applicantName: '',
            applicantSurname: '',
            created_at: '',
        };
    },
    methods:{
        revokeShortListing()
        {
            window.Swal.fire({
                title: 'Revoke ShortListing?',
                text: "Are You Sure You Want To Revoke ShortListing?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Revoke!'
            }).then((result) => {
                if (result.value) {
                    window.axios.post(`/revokeShortListing/${this.applicant.id}`, this.applicant).then((response) => {
                        console.log("revoked");
                        console.log(response);
                        this.$router.push('/applications/shortListed')
                    }).catch((errors) => {
                        Swal.fire(
                            'Error In Fields!',
                            'Kindly Check Your Fields',
                            'error'
                        )
                        this.errors = errors.response.data.errors
                    })
                    Swal.fire(
                        'ShortListing Revoked!',
                        'ShortListing Revoked Successfully',
                        'success'
                    )
                }
            })
        }
        },
    mounted() {
        window.axios.get('/viewShortList/' + this.$route.params.id).then((response) =>
            (this.applicant = response.data.body.applicant))
            .catch((errors) =>{
                this.errors = errors.response.data.errors
            });
    }
}
</script>





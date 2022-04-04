<template>
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">View Vacancy</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Vacancy Title</label>
                        <input type="text" v-model="vacancy.title"  class="form-control form-control-sm"  disabled>
                        <p class="text-danger" v-text="title"></p>

                    </div>
                    <div class="form-group">
                        <label>Vacancy Department</label>
                        <input type="text" v-model="vacancy.department"  class="form-control form-control-sm"  disabled>
                        <p class="text-danger" v-text="department"></p>
                    </div>
                    <div class="form-group">
                        <label>Vacancy Category</label>
                        <input type="text" v-model="vacancy.category"  class="form-control form-control-sm"  disabled>
                        <p class="text-danger" v-text="category"></p>
                    </div>
                    <div class="form-group">
                        <label>Vacancy Description</label>
                        <textarea v-model="vacancy.description" cols="30" rows="6" class="form-control form-control-sm" disabled></textarea>
                        <p class="text-danger" v-text="description"></p>
                    </div>
                    <a  @click="applyJob()" class="btn btn-warning">Apply To Job</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            vacancy : {},
            title: '',
            department: '',
            category: '',
            description: '',
            errors : {},
        };
    },
    methods:{

        applyJob()
        {
            this.error = false;
            window.Swal.fire({
                title: 'Apply Job?',
                text: "Are You Sure You Want To Apply To Vacancy?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Apply!'
            }).then((result) => {
                if (result.value) {
                    window.axios.post(`/applyJob/${this.vacancy.id}`, this.vacancy).then((response) => {
                        console.log("application successful");
                        console.log(response);

                        Swal.fire(
                            response.data.message,
                            response.data.message,
                            response.data.message,
                        );

                        this.$router.push('/vacancies/appliedVacancies')
                    }).catch((errors) => {
                        Swal.fire(
                            'Already Applied!',
                            'Already Applied',
                            'error'
                        )
                        this.errors = errors.response.data.errors
                    })

                }
            })
        },
    },
    mounted() {
        window.axios.get('/viewVacancy/' + this.$route.params.id).then((response) =>
            (this.vacancy = response.data.body.vacancy))
            .catch((errors) =>{
                this.errors = errors.response.data.errors
            });
    }
}
</script>




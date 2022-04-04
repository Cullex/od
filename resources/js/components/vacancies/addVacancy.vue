<template>
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Add Vacancy</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Vacancy Title</label>
                        <input type="text" v-model="formData.title"  class="form-control form-control-sm" placeholder="vacancy title" >
                        <p class="text-danger" v-text="errors.title"></p>
                    </div>
                    <div class="form-group">
                        <label>Vacancy Department</label>
                        <select class="form-control form-control-sm"  v-model="formData.department" data-toggle="select2" >
                            <option value="Retail Banking">Retail Banking & Agri Dev</option>
                            <option value=" Corporate Banking"> Corporate Banking</option>
                            <option value="ICT">ICT</option>
                            <option value="Banking Operations">Banking Operations</option>
                            <option value="Internal Audit">Internal Audit</option>
                            <option value="Corporate Services">Corporate Services</option>
                            <option value="Treasury & International Banking"> Treasury & International Banking</option>
                            <option value="Business Risk">Business Risk</option>
                            <option value="Strategy & Marketing">Strategy & Marketing</option>
                            <option value=" Credit & Debt Recoveries"> Credit & Debt Recoveries</option>
                            <option value="Legal & Compliance">Legal & Compliance</option>
                            <option value="Finance & Admin">Finance & Admin</option>
                            <option value="Human Resources">Human Resources</option>
                            <option value="Procurement Services">Procurement Services</option>
                        </select>
                        <p class="text-danger" v-text="errors.department"></p>
                    </div>
                    <div class="form-group">
                        <label>Vacancy Description</label>
                        <textarea v-model="formData.description" cols="30" rows="6" class="form-control form-control-sm"  required></textarea>
                        <p class="text-danger" v-text="errors.description"></p>
                    </div>
                    <div class="form-group">
                        <label>Vacancy Category</label>
                        <select class="form-control form-control-sm"  v-model="formData.category" data-toggle="select2" >
                            <option value="internal">Internal</option>
                            <option value="external">External</option>
                        </select>
                        <p class="text-danger" v-text="errors.category"></p>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button @click.prevent="addVacancy" :class="['btn btn-primary px-4']" type="submit"> Add Vacancy </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {

            formData: {
                title: '',
                department : '',
                description : '',
                category : ''
            },
            errors:{},
        };
    },
    methods:{
        addVacancy() {
            window.Swal.fire({
                title: 'Add New Vacancy?',
                text: "Are You Sure You Want To Add New Vacancy?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    window.axios.post('addVacancy', this.formData).then((response) => {
                        console.log(response);
                        this.$router.push('/')
                    }).catch((errors) => {
                        Swal.fire(
                            'Error In Fields!',
                            'Kindly Check Your Fields',
                            'error'
                        )
                        this.errors = errors.response.data.errors
                    })
                    Swal.fire(
                        'Added!',
                        'New Vacancy has been submitted.',
                        'success'

                    )
                }
            })
        }
    }
}
</script>



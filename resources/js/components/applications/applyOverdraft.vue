<template>
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Overdraft Application Form</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" v-model="formData.last_name"  class="form-control form-control-sm" placeholder="enter last name" >
                        <p class="text-danger" v-text="errors.last_name"></p>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" v-model="formData.first_name"  class="form-control form-control-sm" placeholder="enter first name" >
                        <p class="text-danger" v-text="errors.first_name"></p>
                    </div>
                    <div class="form-group">
                        <label>Overdraft Tenure</label>
                        <select class="form-control form-control-sm"  v-model="formData.overdraft_tenure" data-toggle="select2" >
                            <option value="1 Month">1 Month</option>
                            <option value="3 Months">3 Months</option>
                            <option value="6 Months">6 Months</option>
                        </select>
                        <p class="text-danger" v-text="errors.overdraft_tenure"></p>
                    </div>
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="number" v-model="formData.account_number"  class="form-control form-control-sm" placeholder="enter account number" >
                        <p class="text-danger" v-text="errors.account_number"></p>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" v-model="formData.amount"  class="form-control form-control-sm" placeholder="enter amount" >
                        <p class="text-danger" v-text="errors.amount"></p>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button @click.prevent="applyOverdraft" :class="['btn btn-primary px-4']" type="submit"> Apply Overdraft </button>
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
                last_name: '',
                first_name : '',
                overdraft_tenure : '',
                account_number : '',
                amount: '',
            },
            errors:{},
        };
    },
    methods:{
        applyOverdraft() {
            window.Swal.fire({
                title: 'Apply Overdraft?',
                text: "Are You Sure You Want To Apply For Overdraft?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    window.axios.post('applyOverdraft', this.formData).then((response) => {
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
                        'Applied!',
                        'Overdraft Application Submitted.',
                        'success'

                    )
                }
            })
        }
    }
}
</script>




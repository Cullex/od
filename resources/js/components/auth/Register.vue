<template>
    <div class="">
        <form @submit.prevent="register" autocomplete="off" class="card-body px-4">
            <div class="text-center w-75 m-auto">
                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">OVERDRAFT APPLICATION MANAGEMENT</h4>
                <p class="text-muted mb-3">Enter your details below</p>
            </div>
            <p v-if="message" :class="['alert text-center mb-0 rounded-0 mb-3 px-3' , error ? 'alert-danger' : 'alert-success']">
                {{ message }}
            </p>
            <div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h4>Personal Information</h4>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" v-model="form.name" :class="[ 'form-control' , form.errors.get('name') ? 'is-invalid' : '' ]" placeholder="Enter your name" autocomplete="unique-1">
                        <div v-text="form.errors.get('name')" class="invalid-feedback"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name</label>
                        <input type="text" v-model="form.last_name" :class="[ 'form-control' , form.errors.get('last_name') ? 'is-invalid' : '' ]" placeholder="Enter your last name" autocomplete="unique-1">
                        <div v-text="form.errors.get('last_name')" class="invalid-feedback"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h4>Contact Information</h4>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label>Phone</label>
                        <input type="number" v-model="form.phone" :class="[ 'form-control' , form.errors.get('phone') ? 'is-invalid' : '' ]" placeholder="Enter your phone" autocomplete="unique-1">
                        <div v-text="form.errors.get('phone')" class="invalid-feedback"/>
                    </div>
                    <div class="form-group  col-md-6">
                        <label>Email address</label>
                        <input type="email" v-model="form.email" :class="[ 'form-control' , form.errors.get('email') ? 'is-invalid' : '' ]" placeholder="Enter your email" autocomplete="unique-1">
                        <div v-text="form.errors.get('email')" class="invalid-feedback"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h4>Authentication</h4>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label>Password</label>
                        <input type="password" v-model="form.password" :class="[ 'form-control' , form.errors.get('password') ? 'is-invalid' : '' ]" placeholder="Enter your password" autocomplete="unique-1">
                        <div v-text="form.errors.get('password')" class="invalid-feedback"/>
                    </div>
                    <div class="form-group  col-md-6">
                        <label>Password Confirmation</label>
                        <input type="password" v-model="form.password_confirmation" :class="[ 'form-control' , form.errors.get('password_confirmation') ? 'is-invalid' : '' ]" placeholder="Enter password_confirmation" autocomplete="unique-1">
                        <div v-text="form.errors.get('password_confirmation')" class="invalid-feedback"/>
                    </div>
                </div>

                <div class="form-group mb-0 text-center">
                    <button @click.prevent="registerUser" :class="['btn btn-primary px-4' , form.loading || loading ? 'btn-loading' : '']" type="submit"> Register </button>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-center">
                    <p class=""><span class="text-muted">Already have an account?</span> <a href="/login" class=""><b>Login </b></a></p>
                </div> <!-- end col -->
            </div>
        </form>
    </div>
</template>

<script>
import Form from "../../core/forms/form";
export default {
    name: "register",
    data()
    {
        return {
            loading : false,
            error : false,
            message : '',
            form : new Form({
                email : '',
                phone : '',
                name : '',
                last_name : '',
                password : '',
                password_confirmation : ''
            })
        };
    },
    methods : {
        registerUser()
        {
            this.loading = true;
            this.error = false;
            this.message = "";
            this.form.submit('/registerUser').then((response) => {
                if (response.data.success === true ){
                    Swal.fire(
                        'Registration Successful!',
                        'You have successfully registered',
                        'success'
                    )
                    this.message = response.data.message;
                    setTimeout(function () {
                        window.location = `${window.location.origin}/`;
                    } , 2000 );
                } else {
                    this.message = response.data.message;
                    this.loading = false;
                    this.error = true;
                }
            }).catch((error) => {
                this.loading = false;
            });
        }
    }
}
</script>

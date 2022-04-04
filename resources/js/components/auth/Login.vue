<template>
    <div class="">
        <form @submit.prevent="runForm" autocomplete="off" class="card-body px-4">
            <div class="text-center w-75 m-auto">
                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">OVERDRAFT APPLICATION MANAGEMENT</h4>
                <p class="text-muted mb-3">Enter your email address and password to login</p>
            </div>
            <p v-if="message" :class="['alert text-center mb-0 rounded-0 mb-3 px-3' , error ? 'alert-danger' : 'alert-success']">
                {{ message }}
            </p>
            <div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="text" v-model="form.email" :class="[ 'form-control' , form.errors.get('email') ? 'is-invalid' : '' ]" placeholder="Enter your email" autocomplete="unique-1">
                    <div v-text="form.errors.get('email')" class="invalid-feedback"/>
                </div>
                <div class="form-group mb-3">
                    <a href="/password/reset" class="text-primary float-right"><small>Forgot your password?</small></a>
                    <label>Password</label>
                    <input type="password" v-model="form.password" :class="[ 'form-control' , form.errors.get('password') ? 'is-invalid' : '' ]"  placeholder="Enter your password" autocomplete="unique-2">
                    <div v-text="form.errors.get('password')" class="invalid-feedback"/>
                </div>
                <div class="form-group mb-0 text-center">
                    <button @click.prevent="loginUser" :class="['btn btn-primary px-4' , form.loading || loading ? 'btn-loading' : '']" type="submit">Login</button>
                </div>.
                <div> </div>
                <div class="form-group mb-0 text-center">
                    <a href="/register" class="text-primary float-center"><small>Not Registered?</small></a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import Form from "../../core/forms/form";

export default {
    name: "login",
    data()
    {
        return {
            loading : false,
            error : false,
            message : '',
            form : new Form({
                email : '',
                password  :'',
            })
        };
    },
    methods : {
        runForm()
        {
            this.loginUser();
        },
        loginUser()
        {
            this.loading = true;
            this.error = false;
            this.message = "";
            this.form.submit('/login').then((response) => {
                if (response.data.success === true ){
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

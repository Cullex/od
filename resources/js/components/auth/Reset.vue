<template>
    <div class="">
        <div class="card-body px-4">
            <div class="text-center w-75 m-auto">
                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Reset Password</h4>
                <p class="text-muted mb-3">Enter your email address to receive your reset Token</p>
            </div>
            <p v-if="message" :class="['alert text-center mb-0 rounded-0 mb-3 px-3' , error ? 'alert-danger' : 'alert-success']">
                {{ message }}
            </p>
            <div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="text" v-model="form.email" :class="[ 'form-control' , form.errors.get('email') ? 'is-invalid' : '' ]" placeholder="Enter your email" autocomplete="off">
                    <div v-text="form.errors.get('email')" class="invalid-feedback"/>
                </div>
                <div v-if="otpSent" class="form-group">
                    <label>Token</label>
                    <input type="text" v-model="form.token" :class="[ 'form-control' , form.errors.get('token') ? 'is-invalid' : '' ]" placeholder="Enter Token" autocomplete="off">
                    <div v-text="form.errors.get('token')" class="invalid-feedback"/>
                </div>
                <div v-if="otpSent" class="form-group">
                    <label>Password</label>
                    <input type="password" v-model="form.password" :class="[ 'form-control' , form.errors.get('password') ? 'is-invalid' : '' ]" placeholder="Enter Password" autocomplete="off">
                    <div v-text="form.errors.get('password')" class="invalid-feedback"/>
                    <div class="help-block text-right"><small> [ Must have at least one digit , capital , small letter and special character] </small></div>
                </div>
                <div v-if="otpSent" class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" v-model="form.password_confirmation" :class="[ 'form-control' , form.errors.get('password_confirmation') ? 'is-invalid' : '' ]" placeholder="Enter Password Confirm" autocomplete="off">
                    <div v-text="form.errors.get('password_confirmation')" class="invalid-feedback"/>
                </div>
                <div v-if="!otpSent" class="form-group mb-0 text-center">
                    <button @click="getOTP" :class="['btn btn-primary px-4' , form.loading || loading ? 'btn-loading' : '']" type="submit"> Get Token</button>
                </div>
                <div v-if="otpSent" class="form-group mb-0 text-center">
                    <button @click="loginUser" :class="['btn btn-primary px-4' , form.loading || loading ? 'btn-loading' : '']" type="submit">Reset Password</button>
                    <div class="mt-2">
                        <a @click.prevent="getOTP" href="#" class="text-primary"><small> Get new Reset Token ?</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from "../../core/forms/form";

    export default {
        name: "reset",
        data()
        {
            return {
                loading : false,
                otpSent : false,
                error : false,
                message : '',
                form : new Form({
                    email : '',
                    password  :'',
                    password_confirmation  :'',
                    token : ''
                })
            };
        },
        methods : {
            getOTP()
            {
                this.loading = true;
                this.error = false;
                this.message = "";
                this.form.submit('/password/reset').then((response) => {
                    if (response.data.success === true ){
                        this.otpSent = true;
                        this.message = response.data.message;
                    } else {
                        this.message = response.data.message;
                        this.error = true;
                    }
                    this.loading = false;
                }).catch((error) => {
                    this.loading = false;
                });
            },
            loginUser()
            {
                this.loading = true;
                this.error = false;
                this.message = "";
                this.form.submit('/reset').then((response) => {
                    if (response.data.success === true ){
                        this.message = response.data.message;
                        setTimeout(function () {
                            window.location = `${window.location.origin}/login`;
                        } , 2000 );
                    } else {
                        this.message = response.data.message;
                        this.error = true;
                    }
                }).catch((error) => {
                    this.loading = false;
                });
            }
        }
    }
</script>

<script>
    import Form from "../../core/forms/form";
    export default {
        name: "internal",
        mounted() {
            this.init();
        },
        data()
        {
            return {
                loading : false,
                accounts : [],
                form : new Form({
                    old_password : '',
                    password : '',
                    password_confirmation : '',
                })
            }
        },
        methods : {
            init (){

            },
            submit(){
                window.Swal.fire({
                    title: 'Are you sure ?',
                    text: `You want to update your password`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1c4b27',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Yes, Update!`
                }).then((result) => {
                    if (result.value) {
                        this.form.submit('/password').then((response) => {
                            window.alerts.success(response);
                            this.form.reset();
                        }).catch((error) => {
                        });
                    }
                });
            }
        }
    }
</script>
<template>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div :class="['dimmer' , loading || form.loading ? 'active' : '']">
                        <div class="loader"></div>
                        <div class="dimmer-content">
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-lg-9">
                                    <h4 class="header-title mb-2">Account Settings</h4>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-lg-3 col-form-label">Old Password</label>
                                <div class="col-lg-9">
                                    <input type="password"  v-model="form.old_password" :class="[ 'form-control mw-400' , form.errors.get('old_password') ? 'is-invalid' : '' ]" placeholder="">
                                    <div v-text="form.errors.get('old_password')" class="invalid-feedback"/>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-lg-3 col-form-label">New Password</label>
                                <div class="col-lg-9">
                                    <div class="help-block text-right mw-400"><small> [ Must have at least one digit , capital , small letter and special character(@$!%*#?&) ] </small></div>
                                    <input type="password"  v-model="form.password" :class="[ 'form-control mw-400' , form.errors.get('password') ? 'is-invalid' : '' ]" placeholder="">
                                    <div v-text="form.errors.get('password')" class="invalid-feedback"/>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-lg-3 col-form-label">Repeat Password</label>
                                <div class="col-lg-9">
                                    <input type="password"  v-model="form.password_confirmation" :class="[ 'form-control mw-400' , form.errors.get('password_confirmation') ? 'is-invalid' : '' ]" placeholder="">
                                    <div v-text="form.errors.get('password_confirmation')" class="invalid-feedback"/>
                                </div>
                            </div>

                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-lg-9">
                                    <button type="submit" @click.prevent="submit" :class="['btn btn-primary' , form.loading ? 'btn-loading' : '']">Update Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


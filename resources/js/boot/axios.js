// Configure Axios for all ajax requests

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';

window.axios.interceptors.response.use(
    function(response) { return response;},
    function(error) {
        let returnError =  Promise.reject(error);

        if (!error.response)
        {
            // network error

            window.Swal.fire({
                title: "Network Error",
                text: "Page will automatically refresh",
                icon: "warning",
                showConfirmButton: true,
                padding: '20px',
                confirmButtonColor: '#1c4b27',
            }).then((res) => {
                // window.location.reload();
                window.location.href = window.location.href;
            });

        }

        if (error.response)
        {
            // Login Redirect

            if (401 === error.response.status)
            {
                window.Swal.fire({
                    title: "Session Expired",
                    text: "Your session has expired. You will be redirected to login",
                    icon: "warning",
                    showConfirmButton: true,
                    padding: '20px',
                    confirmButtonColor: '#1c4b27',
                }).then((res) => {
                    window.location = '/login';
                });
            }

            if (403 === error.response.status)
            {
                window.Swal.fire({
                    text: "Your action was Forbidden",
                    icon: 'error',
                    showConfirmButton: true,
                    padding: '20px',
                    confirmButtonColor: '#1c4b27',
                }).then(r => {});
            }

            // Server Error

            if (500 === error.response.status)
            {
                window.Swal.fire({
                    icon: 'error',
                    showConfirmButton: true,
                    padding: '20px',
                    confirmButtonColor: '#1c4b27',
                    text: "An Error occurred , Kindly Contact Admin if it persists",
                }).then(r => {});
            }
        }

        return returnError;

    });

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found , this is required for this web application');
}
let auth = document.head.querySelector('meta[name="user"]');
window.user  = {};

if (auth)
{
    window.user = JSON.parse(auth.content);
}


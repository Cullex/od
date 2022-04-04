window.action = function (action , name , url ) {
    return new Promise((resolve, reject) => {
        window.Swal.fire({
            title: 'Are you sure?',
            text: `You want to ${action.replace('-' , ' ')} this ${name}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, ${action.replace('-' , ' ')}!`
        }).then((result) => {
            if (result.value) {
                window.axios.get(url).then((response) => {
                    window.alerts.success(response).then((response) => {
                        resolve(response);
                    });
                }).catch((error) => {
                    reject(error);
                });
            }
        });
    });
};

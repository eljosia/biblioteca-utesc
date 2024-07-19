const env = $('meta[name="env"]').attr('content');
function blockUI(target, message = '<div class="blockui-message"><span class="spinner-border text-primary"></span> Cargando ...</div>') {
    target = document.querySelector(target)
    return new KTBlockUI(target, {
        message: message,
        overlayClass: "bg-dark bg-opacity-50",
    });
}

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toastr-top-center",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "400",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

h = {
    getPetition: (path, params, type = 'POST', async = true) => {
        return getPetition = new Promise((resolve, reject) => {
            let token = $('meta[name="csrf-token"]').attr('content');
            let user_id = $('meta[name="data-user"]').attr('content');
            let _token = { '_token': token, 'api': true, 'by_user_id': user_id };
            $.extend(true, params, _token);

            $.ajax({
                type: type,
                async: async,
                url: path,
                dataType: 'json',
                data: params,
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Authorization': 'Bearer ' + $('meta[name="auth-key"]').attr('content'),
                },
                success: (data) => {
                    resolve(data);
                },
                error: (err) => {
                    if (err.status == 422) {
                        if (err.message)
                            toastr.warning(err.message);
                    } else if (err.status == 404) {
                        toastr.error('No se encuentra el ID', 'error');
                    } else if (err.status === 401) {
                        toastr.error('Ocurrió un error de autorización, recarge la pagina', 'error')
                    } else {
                        reject(err);
                    }
                },
                beforeSend: function () {
                    // blockUI.block();
                },
                complete: function () {
                    // blockUI.release();
                }
            });
        });
    },
    sendForm: (id) => {
        return sendForm = new Promise(function (resolve, reject) {
            var idform = id;
            var url = $(idform).attr('action');
            var errors = document.querySelectorAll('.error');
            var submit = $('button[type=submit]', idform);
            var textSubmit = submit.html();
            let user_id = $('meta[name="data-user"]').attr('content');
            $('.error').text('');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + $('meta[name="auth-key"]').attr('content'),
                }
            });
            let formData = new FormData(idform);
            formData.append('by_user_id', user_id);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType,
                success: function (data) {
                    resolve(data);
                },
                error: (err) => {
                    if (err.status == 422) {
                        if (err.message)
                            toastr.warning(err.message);
                    } else if (err.status == 404) {
                        toastr.error('No se encuentra el ID', 'error');
                    } else if (err.status == 500) {
                        toastr.error(`ERROR: ${err.responseJSON.message}`, 'error')
                    } else {
                        reject(err);
                    }
                },
                beforeSend: function () {
                    //   submit.html('<i class="fas fa-spinner fa-spin"></i>');
                    submit.prop('disabled', true);
                    // blockUI.block();
                },
                complete: function () {
                    submit.prop('disabled', false);
                    // blockUI.block();
                }
            });
        })
    }
};
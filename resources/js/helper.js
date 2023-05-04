export function toast(msg, icon = 'success') {
    // Toast.fire({
    //   icon: icon,
    //   title: msg
    // })

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr[icon](msg)

}

export function getPetition(path, params, type = 'POST', async = true) {
    return new Promise((resolve, reject) => {
        let token = $('meta[name="csrf-token"]').attr('content');
        let user_id = $('meta[name="data-user"]').attr('content');
        let key = $('meta[name="data-key"]').attr('content');
        let _token = { '_token': token, 'api': true, 'by_user_id': user_id, 'key': key };
        $.extend(true, params, _token);

        $.ajax({
            type: type,
            async: async,
            url: path,
            dataType: 'json',
            data: params,
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: (data) => {
                resolve(data);
            },
            error: (err) => {
                if (err.status == 422) {
                    if (err.message)
                        toast(err.message, 'warning');
                } else if (err.status == 404) {
                    toast('No se encuentra el ID', 'error');
                } else {
                    reject(err);
                }
            },
            // beforeSend: function(){
            //     blockUI.block();
            // },
            // complete: function(){
            //     blockUI.release();
            //  }
        });
    });
}

export function sendform(id) {
    return new Promise(function (resolve, reject) {
        var idform = id;
        var url = $(idform).attr('action');
        var errors = document.querySelectorAll('.error');
        var submit = $('button[type=submit]', idform);
        var textSubmit = submit.html();
        let user_id = $('meta[name="data-user"]').attr('content');

        $('.error').text('');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                        toast(err.message, 'warning');
                } else if (err.status == 404) {
                    toast('No se encuentra el ID', 'error');
                } else {
                    reject(err);
                }
            },
            beforeSend: function () {
                submit.html('<i class="fas fa-spinner fa-spin"></i>');
            },
            complete: function () {
                submit.html(textSubmit);
            }
        });
    })
}

export function swalert(title, msg, icon = 'success') {
    Swal.fire(
        title,
        msg,
        icon
    )
}

export function deledit_action() {
    $(document).on('click', '[data-action]', function (e) {
        e.preventDefault();

        var $this = this;
        var url = $($this).data('url');
        var action = $($this).data('action');

        switch (action) {
            case "delete":
                Swal.fire({
                    title: '¿Estas seguro de eliminarlo?',
                    text: "¡Una vez hecho esto, ya no es posible recuperarlo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f36',
                    cancelButtonColor: '#cfd6df',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        getPetition(url, {}, 'DELETE', false).then(data => {
                            if (data.success == true) {
                                toast(data.msg);
                                if (data.action) {
                                    location.href = data.action;
                                } else {
                                    $(`#${data.table_id}`).DataTable().ajax.reload();
                                }
                            } else {
                                toast("Ops...", 'Ha ocurrido un error');
                                console.log(data)
                            }
                        });
                    }
                })
                break;
            case "edit":
                location.href = url;
                break;
        }
    })
}

export function loader_spinner(div, remove = false) {
    if (remove) {
        $('.loader').remove();
    } else {
        $(div).html('<div class="loader text-center"></div>');
    }
}
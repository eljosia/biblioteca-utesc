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
        let _token = { '_token': token, 'api': true, 'by_user_id': user_id };
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
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
                } else if (err.status === 401) {
                    toast('Ocurrió un error de autorización, recarge la pagina', 'error')
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
        let key = $('meta[name="data-key"]').attr('content');
        let user_id = $('meta[name="data-user"]').attr('content');

        $('.error').text('');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formData = new FormData(idform);
        formData.append('by_user_id', user_id);
        formData.append('key', key);

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
                } else if (err.status === 401) {
                    toast('Ocurrió un error de autorización, recarge la pagina', 'error')
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

export function dateAgo(ndate) {
    let date = new Date(ndate);
    let now = new Date();
    const weekdays = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

    let diff = datefns_differenceInDays(date, now, { locale: datefns_es });

    // return weekdays[date.getDay()];

    if (diff == 0) {
        return `Hoy`;
    } else if (diff == -1) {
        return `Ayer`;
    } else if (diff == -2) {
        return `Antier`;
    } else {
        return weekdays[date.getDay()];
    }
}

export async function profile_modal(identifier) {
    $('#modal-delivery-info .identifier').text(identifier);
    h.loader_spinner('#modal-delivery-info #people-info');

    let params = { search: true, identifier: identifier }
    let info = "";
    let loan = "";
    let people
    let loans
    $.extend(true, $.fn.dataTable.defaults, {
        // processing: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json',
            paginate: {
                previous: "<",
                next: '>',
            },
        },
        dom: '<"table-responsive"rt><"bottom row"<"col-12 d-flex justify-content-center"i><"col-12 d-flex justify-content-center"p>>',
        autoWidth: true,
    })

    await h.getPetition('/api/personas', params, 'GET', true).then(res => {
        console.log(res)
        people = res.people;
        loans = res.loans;

        info += `<div class="col-md-3 text-center">
                    <img src="/images/avatar.png" class="rounded-circle avatar img-fluid" alt="" style="width:80px !important; height:80px !important;">
                </div>
                <div class="col-md-9">
                    <span class="name font-bold h3">${people.name} ${people.last_name}</span><br>
                    <span class="identifier text-muted text-sm"> ${people.identifier}</span>
                    <div class="text-sm"><i class="fa-solid fa-helmet-safety me-1 mt-3"></i> ${people.career}</div>
                    <div class="text-sm"><i class="fa-solid fa-phone me-2"></i> ${people.phone}</div>
                </div>`;

        $('#people-loans-table').DataTable({
            order: [[0, "desc"]],
            pageLength: 5,
            data: loans,
            columns: [
                { data: 'code' },
                {
                    data: 'title',
                    colspan: 2,
                    render: function (data, type, row, meta) {
                        return `<span class="text-wrap">${row.title}</span>`;
                    }
                },
                {
                    data: 'return_date',
                    render: function (data, type, row, meta) {
                        return loan_status(row.return_date, row.delivery_date)
                    }
                },
            ],
            initComplete: function (settings, json) {
                setTimeout(function () {
                    $(`#people-loans-table`).removeAttr("style")
                }, 500)
            },
        });
    });
    $('#people-info').html(info)
}

export function loan_status(ndate, delivery_date) {
    // Crear un objeto de fecha con la fecha que deseas comparar
    const fechaDeseada = new Date(ndate);
    // Crear un objeto de fecha con la fecha actual
    const fechaActual = new Date();

    // Si delivery_date no es nulo quiere decir que ya lo entregó.
    if (delivery_date) {
        return `<span class="badge bg-success">Entregado</span>`;
    }

    // Comparar las fechas utilizando el método getTime() y devolver "atraso" si la fecha deseada ha pasado
    if (fechaDeseada.getDate() === fechaActual.getDate() &&
        fechaDeseada.getMonth() === fechaActual.getMonth() &&
        fechaDeseada.getFullYear() === fechaActual.getFullYear()) {
        return `<span class="badge bg-warning">Hoy</span>`;
    }
    else if (fechaDeseada.getDay() < fechaActual.getDay()) {
        return `<span class="badge bg-danger">Atrasado</span>`;
    } else {
        return `<span class="badge bg-secondary">Pendiente</span>`;
    }
}
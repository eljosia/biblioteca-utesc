$(document).ready(function () {
    let table_id = 'peoples-table';
    $.extend(true, $.fn.dataTable.defaults, {
        // processing: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json',
            paginate: {
                previous: "<",
                next: '>',
            },
        },
        dom: 'f<"table-responsive"rt><"bottom row"<"col-12 d-flex justify-content-center"i><"col-12 d-flex justify-content-center"p>>',
        autoWidth: true,
    })
    let loan_table = $(`#${table_id}`).DataTable({
        ajax: {
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'bearer': $('meta[name="data-key"]').attr('content'),
            },
            data: {key:$('meta[name="data-key"]').attr('content')},
            url: $(`#${table_id}`).data('url'),
            dataSrc: "people",
            beforeSend: function () {
                $(`#${table_id} tbody`).html('<tr><td colspan="13"><div class="loader text-center"></div></td></tr>');
            },
            // complete: function () {
            //     $('.loading').addClass('d-none');
            // }
        },
        columns: [
            { data: 'identifier' },
            { data: 'name' },
            { data: 'last_name' },
            { data: 'phone' },
            { data: 'career' },
            {
                data: 'id',
                render: function (data, type, row, meta) {
                    return `
            <a href="${row.edit_url}" class="btn btn-secondary btn-xs rounded-circle"><i class="fa-solid fa-pen-to-square"></i></a>
            <a href="#" class="btn btn-dark btn-xs rounded-circle open-modal" data-ide="${row.identifier}" data-bs-toggle="modal" data-bs-target="#modal-delivery-info"><i class="fa-solid fa-eye"></i></a>
            `
                }
            },
        ],
        fixedColumns: {
            left: 0,
            right: 1,
        },
        initComplete: function (settings, json) {
            setTimeout(function () {
                $(`#${table_id}`).removeAttr("style")
            }, 500)
        },
    });

    loan_table.on('processing.dt', function (e, settings, processing) {
        console.log("Procesing")
    });

    $(`#${table_id}`).on("click", 'td .open-modal', function (e) {
        e.preventDefault();
        let identifier = $(this).data('ide');
        h.profile_modal(identifier);
    });

    const modal_delivery_info = document.getElementById('modal-delivery-info')
    modal_delivery_info.addEventListener('hidden.bs.modal', event => {
        $('#people-loans-table').DataTable().destroy();
    })
});


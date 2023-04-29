$(document).ready(function () {
    let table_id = 'loans-table';
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
            url: $(`#${table_id}`).data('url'),
            dataSrc: "loans",
            beforeSend: function () {
                $(`#${table_id} tbody`).html('<tr><td colspan="13"><div class="loader text-center"></div></td></tr>');
            },
            // complete: function () {
            //     $('.loading').addClass('d-none');
            // }
        },
        columns: [
            { data: 'code' },
            { data: 'identifier' },
            { data: 'full_name' },
            { data: 'title' },
            { data: 'loan_date' },
            { data: 'return_date' },
            { data: 'created_by' },
            {
                data: 'show_url',
                render: function (data, type, row, meta) {
                    return `
            <a href="${row.print_url}" target="_blank" class="btn btn-primary btn-xs rounded-circle"><i class="fa-solid fa-print"></i></a>
            <a href="${row.edit_url}" class="btn btn-secondary btn-xs rounded-circle"><i class="fa-solid fa-pen-to-square"></i></a>
            <button data-url="${row.delete_url}" data-action="delete" class="btn btn-success btn-xs rounded-circle"><i class="fa-solid fa-check"></i></button>
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

    loan_table.on('draw.dt', function () {
        $(`#${table_id} tbody`).find('tr').eq(0).remove();
    });
});
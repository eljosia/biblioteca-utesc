$(document).ready(function () {
    let table_id = 'books-table';
    $.extend(true, $.fn.dataTable.defaults, {
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
    $(`#${table_id}`).DataTable({
        ajax: {
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'bearer': $('meta[name="data-user"]').attr('content'),
            },
            url: $(`#${table_id}`).data('url'),
            dataSrc: "books"
        },
        columns: [{
            data: 'title'
        },
        {
            data: 'folio'
        },
        {
            data: 'isbn'
        },
        {
            data: 'autor'
        },
        {
            data: 'editorial'
        },
        {
            data: 'area'
        },
        {
            data: 'quantity'
        },
        {
            data: 'edition'
        },
        {
            data: 'country'
        },
        {
            data: 'pages'
        },
        {
            data: 'shelf'
        },
        {
            data: 'theme'
        }, {
            data: 'edit_url',
            render: function (data, type, row, meta) {
                return `
            <a href="${row.edit_url}" class="btn btn-success btn-xs rounded-circle"><i class="fa-solid fa-pen-to-square"></i></a>
            <button data-url="${row.delete_url}" class="btn btn-danger btn-xs rounded-circle"><i class="fa-solid fa-trash"></i></button>
            `
            }
        },
        ],
        fixedColumns: {
            left: 0,
            right: 1,
        },
        initComplete: function(settings, json) {
            setTimeout(function() {
                $(`#${table_id}`).removeAttr("style")
            }, 500)
        },
    });
});

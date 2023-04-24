$(document).ready(function () {
    let table_id = 'books-table';
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
    let book_table = $(`#${table_id}`).DataTable({
        ajax: {
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'bearer': $('meta[name="data-user"]').attr('content'),
            },
            url: $(`#${table_id}`).data('url'),
            dataSrc: "books",
            beforeSend: function () {
                $(`#${table_id} tbody`).html('<tr><td colspan="13"><div class="loader text-center"></div></td></tr>');
            },
            // complete: function () {
            //     $('.loading').addClass('d-none');
            // }
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
            <button data-url="${row.delete_url}" data-action="delete" class="btn btn-danger btn-xs rounded-circle"><i class="fa-solid fa-trash"></i></button>
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

    book_table.on('processing.dt', function (e, settings, processing) {
        
        console.log("Procesing")
    });

    book_table.on('draw.dt', function () {
        $(`#${table_id} tbody`).find('tr').eq(0).remove();
    });

    new AirDatepicker('#datefilter', {
        locale: localeEs,
        range: true,
        multipleDatesSeparator: ' - '
    })


    $('#book-filter').on('submit', function (e) {
        e.preventDefault();
        var filter_url
        var formData = {
            search: $('input[name="search"]').val(),
            area: $('select[name="area"]').val(),
            estante: $('input[name="estante"]').val(),
            fechas: $('input[name="datefilter"]').val()
        };

        // Remover parámetros vacíos
        Object.keys(formData).forEach(function (key) {
            if (!formData[key]) {
                delete formData[key];
            }
        });
        filter_url = $(this).attr('action') + '?' + $.param(formData);
        book_table.ajax.url(filter_url).load();
    });

    $('.btn-clean-filter').on('click', function (e) {
        e.preventDefault();
        $('#book-filter')[0].reset();
        book_table.ajax.url($('#book-filter').attr('action')).load();
    })
});

h.deledit_action();
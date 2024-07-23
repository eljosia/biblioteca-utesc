"use strict";
let table_id = 'loan-table';

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;
    var data = {
        'search': {
            "value": $('#search').val(),
            "area": ($('#area').length) ? $('#area').val() : null,
            "datefilter": ($('#datefilter').length) ? $('#datefilter').val() : null
        }
    };

    // Private functions
    var initDatatable = function () {
        dt = $("#" + table_id).DataTable({
            searchDelay: 1000,
            processing: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json',
                paginate: {
                    previous: "<",
                    next: '>',
                },
            },
            dom: '<"table-responsive"rt><"bottom row"<"col-12 d-flex justify-content-center"i><"col-12 d-flex justify-content-center"p>>',
            order: [
                [2, 'asc']
            ],
            columnDefs: [{
                targets: 0, // El índice de la columna oculta
                visible: false, // Ocultar la columna
                searchable: true // Hacer que la columna sea buscable
            }],
            ajax: {
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + $('meta[name="auth-key"]').attr('content'),
                },
                url: $(`#${table_id}`).data('url'),
                data: function (d) {
                    return $.extend({}, d, data);
                }
            },
            columns: [{
                data: 'created_at'
            }, {
                data: 'code',
                title: 'Código',
            }, {
                data: 'identifier',
                title: 'Matrícula',
            }, {
                data: 'full_name',
                title: 'Nombre',
                render: function (data, type, row, meta) {
                    var today = new Date(); // Fecha de hoy
                    var returnDateObj = new Date(row.return_date);
                    var alert = "";
                    if (returnDateObj < today && row.delivery_date == null) {
                        console.log('entro')
                        alert =
                            '<span class="badge badge-light-danger ms-2">Vencido</span>';
                    }

                    return row.full_name + alert;
                }
            }, {
                data: 'title',
                title: 'Libro',
            }, {
                data: 'loan_date',
                title: 'Prestamo',
            }, {
                data: 'return_date',
                title: 'Fecha Límite',
            }, {
                data: 'created_by',
                title: 'Prestado Por',
            }, {
                data: 'edit_url',
                render: function (data, type, row, meta) {
                    var return_btn = "";
                    if (row.delivery_date == null) {
                        return_btn = `
                        <a href="#" class="btn-delivery_book" 
                            data-url="${row.deliver_url}" 
                            data-code="${row.code}" 
                            data-folio="${row.folio}">
                            <i class="ki-duotone ki-check-circle fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>`;
                    }
                    return `
                    <div class="d-flex">
                        <a href="${row.edit_url}">
                            <i class="ki-duotone ki-pencil fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                        <a href="#" class="btn-del" data-url="${row.delete_url}" data-action="delete">
                            <i class="ki-duotone ki-trash-square fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </a>
                        ${return_btn}
                    </div>
                `
                }
            },],
            fixedColumns: {
                left: 0,
                right: 1,
            }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-ecommerce-product-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            console.log(e.target.value)
            dt.search(e.target.value).draw();
        });
    }
    var handleFilterDatatable = () => {

        // Filter datatable on submit
        if ($('#area').length) {
            console.log("Aqui");
            $('#area').on('change', function (e) {
                // data.search.area = e.target.value;
                // dt.search($('#search').val()).draw();
                if (e.target.value == "all") {
                    dt.column(6).search("").draw();
                } else {
                    dt.column(6).search(e.target.value).draw();
                }
            });
        }

        if ($('#datefilter').length) {
            $('#datefilter').on('apply.daterangepicker', function (ev, picker) {
                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');

                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var date = data[0].split('T')[0]; // Obtener solo la parte de la fecha

                        if (date >= startDate && date <= endDate) {
                            return true;
                        }
                        return false;
                    }
                );

                dt.draw();
                $.fn.dataTable.ext.search.pop();
            });

            $('#datefilter').on('cancel.daterangepicker', function (ev, picker) {
                $('#datefilter').val('');
                $.fn.dataTable.ext.search.pop();
                dt.draw();
            });

        }
    }
    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            handleFilterDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});

$('input[name="datefilter"]').daterangepicker({
    autoUpdateInput: false,
    locale: {
        cancelLabel: 'Clear'
    }
});

$('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
        'MM/DD/YYYY'));
});

$('input[name="datefilter"]').on('cancel.daterangepicker', function (ev, picker) {
    $(this).val('');
});

$('body').on('click', '.btn-del', function (e) {
    e.preventDefault();
    console.log("data-action");

    var $this = this;
    var url = $($this).data('url');
    var ID = $($this).data('id');

    Swal.fire({
        title: '¿Confirma eliminarlo?',
        text: "Una vez hecho esto, no podrás deshacer esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f36',
        cancelButtonColor: '#cfd6df',
        confirmButtonText: 'Confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            h.getPetition(url, {
                id: ID
            }, 'DELETE', false).then(data => {
                if (data.success == true) {
                    toastr.success(data.msg);
                    if (data.action) {
                        setTimeout(function () {
                            location.href = data.action;
                        }, 2000)
                    } else {
                        $(`#${data.table_id}`).DataTable().ajax.reload();
                    }
                } else {
                    toastr.error((data.msg) ? data.msg : 'Ha ocurrido un error',
                        "Ops...",);
                    console.log(data)
                }
            });
        }
    })
});

$('body').on('click', '.btn-delivery_book', function (e) {
    e.preventDefault();
    console.log("data-action");

    var $this = this;
    var url = $($this).data('url');
    var code = $($this).data('code');
    var folio = $($this).data('folio');

    Swal.fire({
        title: 'Aviso',
        text: "Por favor, verifica que el libro sea el mismo y se encuentre en condiciones antes de confirmar la entrega.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f36',
        cancelButtonColor: '#cfd6df',
        confirmButtonText: 'Confirmar',
        input: 'text',
        inputPlaceholder: 'Ingrese el número de adquisición'
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.value.length > 0)
                if (result.value == folio) {
                    h.getPetition(url, {
                        code: code,
                        folio: result.value
                    }, 'post', false).then(data => {
                        if (data.success == true) {
                            toastr.success(data.msg);
                            if (data.action) {
                                location.href = data.action;
                            }
                        } else {
                            toastr.error("Ops...", 'Ha ocurrido un error');
                            console.log(data)
                        }
                    });
                } else {
                    toastr.warning('El numero de adquisición no corresponde al libro')
                }
            else {
                toastr.warning("Ingrese el número de adquisición");
            }
        }
    });
});
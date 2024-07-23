"use strict";
let table_id = 'book-table';

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;

    // Private functions
    var initDatatable = function () {
        dt = $("#" + table_id).DataTable({
            searchDelay: 500,
            processing: true,
            order: [
                [2, 'asc']
            ],
            stateSave: true,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + $('meta[name="auth-key"]').attr('content'),
                },
                url: $(`#${table_id}`).data('url')
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
                    <div class="d-flex">
                        <a href="${row.edit_url}">
                            <i class="ki-duotone ki-pencil fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                        <a href="#" data-url="${row.delete_url}" data-action="delete">
                            <i class="ki-duotone ki-trash-square fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </a>
                    </div>
                `
                }
            },
            ],
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

    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
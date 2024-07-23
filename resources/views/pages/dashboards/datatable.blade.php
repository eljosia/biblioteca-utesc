<x-default-layout>
    @include('partials._head-slots')

    <div class="row">
        <div class="col-12 mx-auto">
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header d-flex justify-content-start row">
                    <!--begin::Search-->
                    <div class="col-4 col-md-2 d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-product-filter="search"
                            class="form-control form-control-solid w-250px ps-12" id="search" name="search"
                            placeholder="Buscar" />
                    </div>
                    <!--end::Search-->

                    <div class="col-4 col-md-2 d-flex align-items-center position-relative my-1">
                        <select class="form-select form-select-solid filtro" data-control="select2"
                            data-placeholder="Area" data-live-search="true" data-style="btn-outline-light text-dark"
                            id="area" name="area">
                            <option value="all">Todas</option>
                            @foreach (\App\Models\Careers::all() as $area)
                                <option value="{{ $area->name }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--begin::Search-->
                    <div class="col-4 col-md-2 d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-calendar fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-product-filter="datefilter"
                            class="form-control form-control-solid w-250px ps-12" name="datefilter" id="datefilter"
                            placeholder="Fechas" placeholder="Fechas" />
                    </div>
                    <!--end::Search-->

                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 mt-10">
                    <!--begin::Datatable-->
                    <table id="{{ isset($data->table->js) ? $data->table->js : $data->table->js }}"
                        data-url="{{ $data->table->list }}" class="table table-striped table-row-bordered gy-5 gs-7">
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                    <!--end::Datatable-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
    </div>
    @push('scripts')
        {{-- <script src="{{ mix('js/dashboard.js') }}"></script> --}}
        {{-- <script src="{{ mix('js/scripts/datatables/' . $data->table->js . '.js') }}" type="text/javascript"></script> --}}
        <script>
            "use strict";
            let table_id = 'book-table';

            // Class definition
            var KTDatatablesServerSide = function() {
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
                var initDatatable = function() {
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
                            data: function(d) {
                                return $.extend({}, d, data);
                            }
                        },
                        columns: [{
                                data: 'created_at'
                            }, {
                                data: 'title',
                                title: 'Titulo',
                            },
                            {
                                data: 'folio',
                                title: 'Folio'
                            },
                            {
                                data: 'isbn',
                                title: 'ISBN'
                            },
                            {
                                data: 'autor',
                                title: 'Autor'
                            },
                            {
                                data: 'editorial',
                                title: 'Editorial'
                            },
                            {
                                data: 'area',
                                title: 'Area'
                            },
                            {
                                data: 'quantity',
                                title: 'Cantidad'
                            },
                            {
                                data: 'edition',
                                title: 'Edición'
                            },
                            {
                                data: 'country',
                                title: 'País'
                            },
                            {
                                data: 'pages',
                                title: 'Páginas'
                            },
                            {
                                data: 'shelf',
                                title: 'Estante'
                            },
                            {
                                data: 'theme',
                                title: 'Tema'
                            }, {
                                data: 'edit_url',
                                render: function(data, type, row, meta) {
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
                    dt.on('draw', function() {
                        KTMenu.createInstances();
                    });
                }

                // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
                var handleSearchDatatable = function() {
                    const filterSearch = document.querySelector('[data-kt-ecommerce-product-filter="search"]');
                    filterSearch.addEventListener('keyup', function(e) {
                        console.log(e.target.value)
                        dt.search(e.target.value).draw();
                    });
                }
                var handleFilterDatatable = () => {

                    // Filter datatable on submit
                    if ($('#area').length) {
                        console.log("Aqui");
                        $('#area').on('change', function(e) {
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
                        $('#datefilter').on('apply.daterangepicker', function(ev, picker) {
                            var startDate = picker.startDate.format('YYYY-MM-DD');
                            var endDate = picker.endDate.format('YYYY-MM-DD');

                            $.fn.dataTable.ext.search.push(
                                function(settings, data, dataIndex) {
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

                        $('#datefilter').on('cancel.daterangepicker', function(ev, picker) {
                            $('#datefilter').val('');
                            $.fn.dataTable.ext.search.pop();
                            dt.draw();
                        });

                    }
                }
                // Public methods
                return {
                    init: function() {
                        initDatatable();
                        handleSearchDatatable();
                        handleFilterDatatable();
                    }
                }
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function() {
                KTDatatablesServerSide.init();
            });

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        </script>
    @endpush
    @push('modals')
        @if (isset($data->modals))
            @foreach ($data->modals as $modal)
                @include($modal['include'])
            @endforeach
        @endif
    @endpush
</x-default-layout>

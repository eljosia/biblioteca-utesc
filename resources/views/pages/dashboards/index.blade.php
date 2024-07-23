<x-default-layout>
    @include('partials._head-slots')

    @include('pages.dashboards.partials._top')

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xl-4">
            <!--begin::Chart widget 19-->
            <div class="card card-flush mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Libros por carrera</span>
                        <span class="text-gray-500 pt-2 fw-semibold fs-6">Registro mensual</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0">
                    <!--begin::Tab Content (ishlamayabdi)-->
                    <div class="tab-content">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_chart_widget_19_tab_content_1">
                            <!--begin::Items-->
                            <div class="m-0">
                                @foreach ($data->careers['careers'] as $career)
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="{{ $career->icon }}" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="" />
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $career->name }}</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">
                                                    @if ($career->percentage_change > 0)
                                                        <!--begin::Label-->
                                                        <span class="badge badge-light-success fs-base">
                                                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>{{ $career->percentage_change }}%</span>
                                                        <!--end::Label-->
                                                    @elseif ($career->percentage_change < 0)
                                                        <!--begin::Label-->
                                                        <span class="badge badge-light-danger fs-base">
                                                            <i class="ki-duotone ki-arrow-up fs-5 text-danger ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>{{ $career->percentage_change }}%</span>
                                                        <!--end::Label-->
                                                    @else
                                                        <!--begin::Label-->
                                                        <span class="badge badge-light-secondary fs-base">
                                                            <i
                                                                class="ki-duotone ki-dots-horizontal fs-5 text-dark ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                            </i>
                                                            </i>{{ $career->percentage_change }}%</span>
                                                        <!--end::Label-->
                                                    @endif
                                                </span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            <span
                                                class="text-gray-800 fw-bold fs-4 me-3">{{ $career->total_books_general }}</span>
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                @endforeach

                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 19-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-8 mb-xl-10">
            <!--begin::Chart widget 38-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Libros por Estante</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                    <!--begin::Chart-->
                    <div id="chart-books_by_shelf" data-get='@json($data->shelfs)'
                        class="h-325px w-100 min-h-auto ps-4 pe-6"></div>
                    <!--end::Chart-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Chart widget 38-->
            <div class="card mb-5 mb-xl-10 p-40">
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Calendario</span>
                    </h3>
                    <!--end::Title-->
                </div>

                <div class="card-body pt-0">
                    <div id="kt_docs_fullcalendar_selectable"></div>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <div class="col-12 col-md-8">

        </div>
    </div>
    <!--end::Row-->

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                "use strict";

                var KTChartsWidget38 = function() {
                    var chart = {
                        self: null,
                        rendered: false
                    };

                    var initChart = function() {
                        var element = document.getElementById("chart-books_by_shelf");
                        if (!element) {
                            console.error('Element not found');
                            return;
                        }

                        var jsonData = element.getAttribute('data-get');
                        if (!jsonData) {
                            console.error('No data-get attribute found');
                            return;
                        }

                        try {
                            var parsedData = JSON.parse(jsonData);
                            if (!parsedData.original || !Array.isArray(parsedData.original)) {
                                console.error('Data is not in the expected format');
                                return;
                            }

                            var data = parsedData.original;

                            // Verificar que los datos sean válidos
                            if (!data.length) {
                                console.error('Data array is empty');
                                return;
                            }

                            // Mapear categorías y totales
                            const categories = data.map(item => item.shelf ||
                            ''); // Asegúrate de usar el nombre correcto
                            const totals = data.map(item => item.total ||
                            0); // Asegúrate de usar el nombre correcto

                            if (categories.length === 0 || totals.length === 0) {
                                console.error('Categories or totals are empty');
                                return;
                            }

                            var height = parseInt(KTUtil.css(element, 'height')) || 400; // Valor predeterminado
                            var labelColor = KTUtil.getCssVariableValue('--bs-gray-900') || '#000';
                            var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color') || '#ddd';

                            var options = {
                                series: [{
                                    name: 'Libros Totales',
                                    data: totals
                                }],
                                chart: {
                                    fontFamily: 'inherit',
                                    type: 'bar',
                                    height: height,
                                    toolbar: {
                                        show: false
                                    }
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: false,
                                        columnWidth: ['28%'],
                                        borderRadius: 5,
                                        dataLabels: {
                                            position: "top" // top, center, bottom
                                        },
                                        startingShape: 'flat'
                                    },
                                },
                                legend: {
                                    show: false
                                },
                                dataLabels: {
                                    enabled: true,
                                    offsetY: -28,
                                    style: {
                                        fontSize: '13px',
                                        colors: [labelColor]
                                    },
                                    formatter: function(val) {
                                        return val; // + "H";
                                    }
                                },
                                stroke: {
                                    show: true,
                                    width: 2,
                                    colors: ['transparent']
                                },
                                xaxis: {
                                    categories: categories,
                                    axisBorder: {
                                        show: false,
                                    },
                                    axisTicks: {
                                        show: false
                                    },
                                    labels: {
                                        style: {
                                            colors: KTUtil.getCssVariableValue('--bs-gray-500') || '#666',
                                            fontSize: '13px'
                                        }
                                    },
                                    crosshairs: {
                                        fill: {
                                            gradient: {
                                                opacityFrom: 0,
                                                opacityTo: 0
                                            }
                                        }
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        style: {
                                            colors: KTUtil.getCssVariableValue('--bs-gray-500') || '#666',
                                            fontSize: '13px'
                                        },
                                        formatter: function(val) {
                                            return val;
                                        }
                                    }
                                },
                                fill: {
                                    opacity: 1
                                },
                                states: {
                                    normal: {
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    },
                                    hover: {
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    },
                                    active: {
                                        allowMultipleDataPointsSelection: false,
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    }
                                },
                                tooltip: {
                                    style: {
                                        fontSize: '12px'
                                    },
                                    y: {
                                        formatter: function(val) {
                                            return +val + 'M'
                                        }
                                    }
                                },
                                colors: [KTUtil.getCssVariableValue('--bs-primary') || '#007bff', KTUtil
                                    .getCssVariableValue('--bs-primary-light') || '#cce5ff'
                                ],
                                grid: {
                                    borderColor: borderColor,
                                    strokeDashArray: 4,
                                    yaxis: {
                                        lines: {
                                            show: true
                                        }
                                    }
                                }
                            };

                            chart.self = new ApexCharts(element, options);

                            setTimeout(function() {
                                chart.self.render();
                                chart.rendered = true;
                            }, 200);
                        } catch (e) {
                            console.error('Error parsing JSON or rendering chart:', e);
                        }
                    }

                    return {
                        init: function() {
                            initChart();

                            KTThemeMode.on("kt.thememode.change", function() {
                                if (chart.rendered) {
                                    chart.self.destroy();
                                }

                                initChart();
                            });
                        }
                    }
                }();


                if (typeof module !== 'undefined') {
                    module.exports = KTChartsWidget38;
                }




                // CALENDARIO
                // Class definition
                var KTGeneralFullCalendarSelectDemos = function() {
                    // Private functions

                    var exampleSelect = function() {
                        // Define variables
                        var calendarEl = document.getElementById('kt_docs_fullcalendar_selectable');

                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            // initialDate: '2020-09-12',
                            locale: 'es',
                            navLinks: true, // can click day/week names to navigate views
                            selectable: true,
                            selectMirror: true,

                            // Create new event
                            select: function(arg) {
                                Swal.fire({
                                    html: '<div class="mb-7">¿Agregar evento?</div><div class="fw-bolder mb-5">Event Name:</div><input type="text" class="form-control" name="event_name" />',
                                    icon: "info",
                                    showCancelButton: true,
                                    buttonsStyling: false,
                                    confirmButtonText: "Si, crear",
                                    cancelButtonText: "No, regresar",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                        cancelButton: "btn btn-active-light"
                                    }
                                }).then(function(result) {
                                    if (result.value) {
                                        var title = document.querySelector(
                                            'input[name="event_name"]').value;
                                        if (title) {
                                            calendar.addEvent({
                                                title: title,
                                                start: arg.start,
                                                end: arg.end,
                                                allDay: arg.allDay
                                            })
                                        }
                                        calendar.unselect()
                                    } else if (result.dismiss === 'cancel') {
                                        // Swal.fire({
                                        //     text: "Event creation was declined!.",
                                        //     icon: "error",
                                        //     buttonsStyling: false,
                                        //     confirmButtonText: "Ok, got it!",
                                        //     customClass: {
                                        //         confirmButton: "btn btn-primary",
                                        //     }
                                        // });
                                    }
                                });
                            },

                            // Delete event
                            eventClick: function(arg) {
                                Swal.fire({
                                    text: '¿Estás seguro de borrar este evento?',
                                    icon: "warning",
                                    showCancelButton: true,
                                    buttonsStyling: false,
                                    confirmButtonText: "Borrar",
                                    cancelButtonText: "Cancelar",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                        cancelButton: "btn btn-active-light"
                                    }
                                }).then(function(result) {
                                    if (result.value) {
                                        arg.event.remove()
                                    } else if (result.dismiss === 'cancel') {
                                        Swal.fire({
                                            text: "El evento no se ha borrado!.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Cerrar!",
                                            customClass: {
                                                confirmButton: "btn btn-primary",
                                            }
                                        });
                                    }
                                });
                            },
                            editable: true,
                            dayMaxEvents: true, // allow "more" link when too many events
                            events: []
                        });

                        calendar.render();
                    }

                    return {
                        // Public Functions
                        init: function() {
                            exampleSelect();
                        }
                    };
                }();


                KTUtil.onDOMContentLoaded(function() {
                    KTChartsWidget38.init();
                    KTGeneralFullCalendarSelectDemos.init();
                });
            });
        </script>
    @endpush
    @push('modals')
    @endpush
</x-default-layout>

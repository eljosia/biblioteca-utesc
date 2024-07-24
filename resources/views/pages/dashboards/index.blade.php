<x-default-layout>
    @include('partials._head-slots')

    @include('pages.dashboards.partials._top')

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xl-3">
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
        <div class="col-xl-9 mb-xl-10">
            <div class="row mb-5 mb-xl-10">

                <div class="col-12 col-sm-8">
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
                </div>

                <div class="col-12 col-sm-4">
                    <div class="card p-40 h-100">
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Libros Donados/Comprados</span>
                            </h3>
                            <!--end::Title-->
                        </div>

                        <div class="card-body pt-0">
                            <div id="chart-typeBook" data-donated="{{ $data->typebook->donated }}"
                                data-buyed="{{ $data->typebook->buyed }}" class="min-h-auto"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Chart widget 38-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Libros Por Carrera</span>
                    </h3>
                    <!--end::Title-->
                </div>

                <div class="card-body">
                    <div id="chart-books_by_career" data-get='@json($data->careers)' style="height: 350px">
                    </div>
                </div>
            </div>

            <!--end::Chart widget 38-->


        </div>
        <!--end::Col-->

        <div class="col-12 col-md-8">

        </div>
    </div>
    <!--end::Row-->

    @push('scripts')
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                "use strict";

                var ChartShelf = function() {
                    var chart = {
                        self: null,
                        rendered: false
                    };

                    var initShelfChart = function() {
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
                                        columnWidth: ['90%'],
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
                            initShelfChart();

                            KTThemeMode.on("kt.thememode.change", function() {
                                if (chart.rendered) {
                                    chart.self.destroy();
                                }

                                initShelfChart();
                            });
                        }
                    }
                }();

                var ChartTypeBook = function() {
                    var chart = {
                        self: null,
                        rendered: false
                    };
                    // Private methods
                    var initTypeChart = function(chart) {
                        var element = document.getElementById("chart-typeBook");
                        var donated = $('#chart-typeBook').data('donated');
                        var buyed = $('#chart-typeBook').data('buyed');

                        if (!element) {
                            return;
                        }

                        var labelColor = KTUtil.getCssVariableValue('--bs-gray-800');
                        var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
                        var maxValue = 18;

                        var options = {
                            series: [{
                                name: 'Cantidad',
                                data: [donated, buyed]
                            }],
                            chart: {
                                fontFamily: 'inherit',
                                type: 'bar',
                                height: 350,
                                toolbar: {
                                    show: false
                                }
                            },
                            plotOptions: {
                                bar: {
                                    borderRadius: 8,
                                    horizontal: true,
                                    distributed: true,
                                    barHeight: 40,
                                    dataLabels: {
                                        position: 'bottom' // use 'bottom' for left and 'top' for right align(textAnchor)
                                    }
                                }
                            },
                            dataLabels: { // Docs: https://apexcharts.com/docs/options/datalabels/
                                enabled: true,
                                textAnchor: 'start',
                                offsetX: 0,
                                formatter: function(val, opts) {
                                    var Format = wNumb({
                                        //prefix: '$',
                                        //suffix: ',-',
                                        thousand: ','
                                    });

                                    return Format.to(val);
                                },
                                style: {
                                    fontSize: '14px',
                                    fontWeight: '600',
                                    align: 'left',
                                }
                            },
                            legend: {
                                show: false
                            },
                            colors: ['#3E97FF', '#F1416C'],
                            xaxis: {
                                categories: ["Donado", "Comprado"],
                                labels: {
                                    formatter: function(val) {
                                        return val
                                    },
                                    style: {
                                        colors: labelColor,
                                        fontSize: '14px',
                                        fontWeight: '600',
                                        align: 'left'
                                    }
                                },
                                axisBorder: {
                                    show: false
                                }
                            },
                            yaxis: {
                                labels: {
                                    formatter: function(val, opt) {
                                        if (Number.isInteger(val)) {
                                            var percentage = parseInt(val * 100 / maxValue).toString();
                                            return val + ' - ' + percentage + '%';
                                        } else {
                                            return val;
                                        }
                                    },
                                    style: {
                                        colors: labelColor,
                                        fontSize: '14px',
                                        fontWeight: '600'
                                    },
                                    offsetY: 2,
                                    align: 'left'
                                }
                            },
                            grid: {
                                borderColor: borderColor,
                                xaxis: {
                                    lines: {
                                        show: true
                                    }
                                },
                                yaxis: {
                                    lines: {
                                        show: false
                                    }
                                },
                                strokeDashArray: 4
                            },
                            tooltip: {
                                style: {
                                    fontSize: '12px'
                                },
                                y: {
                                    formatter: function(val) {
                                        return val;
                                    }
                                }
                            }
                        };

                        chart.self = new ApexCharts(element, options);

                        // Set timeout to properly get the parent elements width
                        setTimeout(function() {
                            chart.self.render();
                            chart.rendered = true;
                        }, 200);
                    }

                    // Public methods
                    return {
                        init: function() {
                            initTypeChart(chart);

                            // Update chart on theme mode change
                            KTThemeMode.on("kt.thememode.change", function() {
                                if (chart.rendered) {
                                    chart.self.destroy();
                                }

                                initTypeChart(chart);
                            });
                        }
                    }
                }();

                am5.ready(function() {
                    // Create root element
                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                    var root = am5.Root.new("chart-books_by_career");

                    // Set themes
                    // https://www.amcharts.com/docs/v5/concepts/themes/
                    root.setThemes([
                        am5themes_Animated.new(root)
                    ]);

                    // Create chart
                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                    var chart = root.container.children.push(am5percent.PieChart.new(root, {
                        layout: root.verticalLayout
                    }));

                    // Create series
                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                    var series = chart.series.push(am5percent.PieSeries.new(root, {
                        alignLabels: true,
                        calculateAggregates: true,
                        valueField: "value",
                        categoryField: "category"
                    }));

                    series.slices.template.setAll({
                        strokeWidth: 3,
                        stroke: am5.color(0xffffff)
                    });

                    series.labelsContainer.set("paddingTop", 30);

                    // Set up adapters for variable slice radius
                    // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                    series.slices.template.adapters.add("radius", function(radius, target) {
                        var dataItem = target.dataItem;
                        var high = series.getPrivate("valueHigh");

                        if (dataItem) {
                            var value = target.dataItem.get("valueWorking", 0);
                            return radius * value / high;
                        }
                        return radius;
                    });

                    var element = document.getElementById('chart-books_by_career');
                    var jsonData = JSON.parse(element.getAttribute('data-get')).careers;

                    // Procesa los datos para el gráfico
                    var chartData = jsonData.map(function(item) {
                        return {
                            value: item.total_books_general,
                            category: item.name
                        };
                    });

                    series.data.setAll(chartData);

                    // Create legend
                    // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                    var legend = chart.children.push(am5.Legend.new(root, {
                        centerX: am5.p50,
                        x: am5.p50,
                        marginTop: 15,
                        marginBottom: 15
                    }));

                    legend.data.setAll(series.dataItems);

                    // Play initial series animation
                    // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                    series.appear(1000, 100);
                }); // end am5.ready()


                if (typeof module !== 'undefined') {
                    module.exports = ChartShelf;
                    module.exports = ChartTypeBook;
                }

                KTUtil.onDOMContentLoaded(function() {
                    ChartShelf.init();
                    ChartTypeBook.init();
                });

            });
        </script>
    @endpush
    @push('modals')
    @endpush
</x-default-layout>

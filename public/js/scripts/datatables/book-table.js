/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/tables/book-table.js":
/*!*******************************************!*\
  !*** ./resources/js/tables/book-table.js ***!
  \*******************************************/
/***/ (() => {

eval("\n\nvar table_id = 'book-table';\n\n// Class definition\nvar KTDatatablesServerSide = function () {\n  // Shared variables\n  var table;\n  var dt;\n  var filterPayment;\n  var _data = {\n    'search': {\n      \"value\": $('#search').val(),\n      \"area\": $('#area').length ? $('#area').val() : null,\n      \"datefilter\": $('#datefilter').length ? $('#datefilter').val() : null\n    }\n  };\n\n  // Private functions\n  var initDatatable = function initDatatable() {\n    dt = $(\"#\" + table_id).DataTable({\n      searchDelay: 1000,\n      processing: true,\n      language: {\n        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json',\n        paginate: {\n          previous: \"<\",\n          next: '>'\n        }\n      },\n      dom: '<\"table-responsive\"rt><\"bottom row\"<\"col-12 d-flex justify-content-center\"i><\"col-12 d-flex justify-content-center\"p>>',\n      order: [[2, 'asc']],\n      columnDefs: [{\n        targets: 0,\n        // El índice de la columna oculta\n        visible: false,\n        // Ocultar la columna\n        searchable: true // Hacer que la columna sea buscable\n      }],\n\n      ajax: {\n        type: 'GET',\n        headers: {\n          'X-Requested-With': 'XMLHttpRequest',\n          'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content'),\n          'Authorization': 'Bearer ' + $('meta[name=\"auth-key\"]').attr('content')\n        },\n        url: $(\"#\".concat(table_id)).data('url'),\n        data: function data(d) {\n          return $.extend({}, d, _data);\n        }\n      },\n      columns: [{\n        data: 'created_at'\n      }, {\n        data: 'title',\n        title: 'Titulo'\n      }, {\n        data: 'folio',\n        title: 'Folio'\n      }, {\n        data: 'isbn',\n        title: 'ISBN'\n      }, {\n        data: 'autor',\n        title: 'Autor'\n      }, {\n        data: 'editorial',\n        title: 'Editorial'\n      }, {\n        data: 'area',\n        title: 'Area'\n      }, {\n        data: 'quantity',\n        title: 'Cantidad'\n      }, {\n        data: 'edition',\n        title: 'Edición'\n      }, {\n        data: 'country',\n        title: 'País'\n      }, {\n        data: 'pages',\n        title: 'Páginas'\n      }, {\n        data: 'shelf',\n        title: 'Estante'\n      }, {\n        data: 'theme',\n        title: 'Tema'\n      }, {\n        data: 'edit_url',\n        render: function render(data, type, row, meta) {\n          return \"\\n                    <div class=\\\"d-flex\\\">\\n                        <a href=\\\"\".concat(row.edit_url, \"\\\">\\n                            <i class=\\\"ki-duotone ki-pencil fs-2 me-2\\\">\\n                                <span class=\\\"path1\\\"></span>\\n                                <span class=\\\"path2\\\"></span>\\n                            </i>\\n                        </a>\\n                        <a href=\\\"#\\\" class=\\\"btn-del\\\" data-url=\\\"\").concat(row.delete_url, \"\\\" data-action=\\\"delete\\\">\\n                            <i class=\\\"ki-duotone ki-trash-square fs-2\\\">\\n                                <span class=\\\"path1\\\"></span>\\n                                <span class=\\\"path2\\\"></span>\\n                                <span class=\\\"path3\\\"></span>\\n                                <span class=\\\"path4\\\"></span>\\n                            </i>\\n                        </a>\\n                    </div>\\n                \");\n        }\n      }],\n      fixedColumns: {\n        left: 0,\n        right: 1\n      }\n    });\n    table = dt.$;\n\n    // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw\n    dt.on('draw', function () {\n      KTMenu.createInstances();\n    });\n  };\n\n  // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()\n  var handleSearchDatatable = function handleSearchDatatable() {\n    var filterSearch = document.querySelector('[data-kt-ecommerce-product-filter=\"search\"]');\n    filterSearch.addEventListener('keyup', function (e) {\n      console.log(e.target.value);\n      dt.search(e.target.value).draw();\n    });\n  };\n  var handleFilterDatatable = function handleFilterDatatable() {\n    // Filter datatable on submit\n    if ($('#area').length) {\n      console.log(\"Aqui\");\n      $('#area').on('change', function (e) {\n        // data.search.area = e.target.value;\n        // dt.search($('#search').val()).draw();\n        if (e.target.value == \"all\") {\n          dt.column(6).search(\"\").draw();\n        } else {\n          dt.column(6).search(e.target.value).draw();\n        }\n      });\n    }\n    if ($('#datefilter').length) {\n      $('#datefilter').on('apply.daterangepicker', function (ev, picker) {\n        var startDate = picker.startDate.format('YYYY-MM-DD');\n        var endDate = picker.endDate.format('YYYY-MM-DD');\n        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {\n          var date = data[0].split('T')[0]; // Obtener solo la parte de la fecha\n\n          if (date >= startDate && date <= endDate) {\n            return true;\n          }\n          return false;\n        });\n        dt.draw();\n        $.fn.dataTable.ext.search.pop();\n      });\n      $('#datefilter').on('cancel.daterangepicker', function (ev, picker) {\n        $('#datefilter').val('');\n        $.fn.dataTable.ext.search.pop();\n        dt.draw();\n      });\n    }\n  };\n  // Public methods\n  return {\n    init: function init() {\n      initDatatable();\n      handleSearchDatatable();\n      handleFilterDatatable();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTDatatablesServerSide.init();\n});\n$('input[name=\"datefilter\"]').daterangepicker({\n  autoUpdateInput: false,\n  locale: {\n    cancelLabel: 'Clear'\n  }\n});\n$('input[name=\"datefilter\"]').on('apply.daterangepicker', function (ev, picker) {\n  $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));\n});\n$('input[name=\"datefilter\"]').on('cancel.daterangepicker', function (ev, picker) {\n  $(this).val('');\n});\n$('body').on('click', '.btn-del', function (e) {\n  e.preventDefault();\n  console.log(\"data-action\");\n  var $this = this;\n  var url = $($this).data('url');\n  var ID = $($this).data('id');\n  Swal.fire({\n    title: '¿Confirma eliminarlo?',\n    text: \"Una vez hecho esto, no podrás deshacer esta acción\",\n    icon: 'warning',\n    showCancelButton: true,\n    confirmButtonColor: '#f36',\n    cancelButtonColor: '#cfd6df',\n    confirmButtonText: 'Confirmar'\n  }).then(function (result) {\n    if (result.isConfirmed) {\n      h.getPetition(url, {\n        id: ID\n      }, 'DELETE', false).then(function (data) {\n        if (data.success == true) {\n          toastr.success(data.msg);\n          if (data.action) {\n            setTimeout(function () {\n              location.href = data.action;\n            }, 2000);\n          } else {\n            $(\"#\".concat(data.table_id)).DataTable().ajax.reload();\n          }\n        } else {\n          toastr.error(data.msg ? data.msg : 'Ha ocurrido un error', \"Ops...\");\n          console.log(data);\n        }\n      });\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvdGFibGVzL2Jvb2stdGFibGUuanMuanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBQ2IsSUFBSUEsUUFBUSxHQUFHLFlBQVk7O0FBRTNCO0FBQ0EsSUFBSUMsc0JBQXNCLEdBQUcsWUFBWTtFQUNyQztFQUNBLElBQUlDLEtBQUs7RUFDVCxJQUFJQyxFQUFFO0VBQ04sSUFBSUMsYUFBYTtFQUNqQixJQUFJQyxLQUFJLEdBQUc7SUFDUCxRQUFRLEVBQUU7TUFDTixPQUFPLEVBQUVDLENBQUMsQ0FBQyxTQUFTLENBQUMsQ0FBQ0MsR0FBRyxFQUFFO01BQzNCLE1BQU0sRUFBR0QsQ0FBQyxDQUFDLE9BQU8sQ0FBQyxDQUFDRSxNQUFNLEdBQUlGLENBQUMsQ0FBQyxPQUFPLENBQUMsQ0FBQ0MsR0FBRyxFQUFFLEdBQUcsSUFBSTtNQUNyRCxZQUFZLEVBQUdELENBQUMsQ0FBQyxhQUFhLENBQUMsQ0FBQ0UsTUFBTSxHQUFJRixDQUFDLENBQUMsYUFBYSxDQUFDLENBQUNDLEdBQUcsRUFBRSxHQUFHO0lBQ3ZFO0VBQ0osQ0FBQzs7RUFFRDtFQUNBLElBQUlFLGFBQWEsR0FBRyxTQUFoQkEsYUFBYUEsQ0FBQSxFQUFlO0lBQzVCTixFQUFFLEdBQUdHLENBQUMsQ0FBQyxHQUFHLEdBQUdOLFFBQVEsQ0FBQyxDQUFDVSxTQUFTLENBQUM7TUFDN0JDLFdBQVcsRUFBRSxJQUFJO01BQ2pCQyxVQUFVLEVBQUUsSUFBSTtNQUNoQkMsUUFBUSxFQUFFO1FBQ05DLEdBQUcsRUFBRSw0REFBNEQ7UUFDakVDLFFBQVEsRUFBRTtVQUNOQyxRQUFRLEVBQUUsR0FBRztVQUNiQyxJQUFJLEVBQUU7UUFDVjtNQUNKLENBQUM7TUFDREMsR0FBRyxFQUFFLHdIQUF3SDtNQUM3SEMsS0FBSyxFQUFFLENBQ0gsQ0FBQyxDQUFDLEVBQUUsS0FBSyxDQUFDLENBQ2I7TUFDREMsVUFBVSxFQUFFLENBQUM7UUFDVEMsT0FBTyxFQUFFLENBQUM7UUFBRTtRQUNaQyxPQUFPLEVBQUUs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Q0FBQyxDQUFDO0FBQ04sQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL3RhYmxlcy9ib29rLXRhYmxlLmpzP2RmZmEiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcbmxldCB0YWJsZV9pZCA9ICdib29rLXRhYmxlJztcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtURGF0YXRhYmxlc1NlcnZlclNpZGUgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAvLyBTaGFyZWQgdmFyaWFibGVzXHJcbiAgICB2YXIgdGFibGU7XHJcbiAgICB2YXIgZHQ7XHJcbiAgICB2YXIgZmlsdGVyUGF5bWVudDtcclxuICAgIHZhciBkYXRhID0ge1xyXG4gICAgICAgICdzZWFyY2gnOiB7XHJcbiAgICAgICAgICAgIFwidmFsdWVcIjogJCgnI3NlYXJjaCcpLnZhbCgpLFxyXG4gICAgICAgICAgICBcImFyZWFcIjogKCQoJyNhcmVhJykubGVuZ3RoKSA/ICQoJyNhcmVhJykudmFsKCkgOiBudWxsLFxyXG4gICAgICAgICAgICBcImRhdGVmaWx0ZXJcIjogKCQoJyNkYXRlZmlsdGVyJykubGVuZ3RoKSA/ICQoJyNkYXRlZmlsdGVyJykudmFsKCkgOiBudWxsXHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxuXHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG4gICAgdmFyIGluaXREYXRhdGFibGUgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgZHQgPSAkKFwiI1wiICsgdGFibGVfaWQpLkRhdGFUYWJsZSh7XHJcbiAgICAgICAgICAgIHNlYXJjaERlbGF5OiAxMDAwLFxyXG4gICAgICAgICAgICBwcm9jZXNzaW5nOiB0cnVlLFxyXG4gICAgICAgICAgICBsYW5ndWFnZToge1xyXG4gICAgICAgICAgICAgICAgdXJsOiAnaHR0cHM6Ly9jZG4uZGF0YXRhYmxlcy5uZXQvcGx1Zy1pbnMvMS4xMy4xL2kxOG4vZXMtTVguanNvbicsXHJcbiAgICAgICAgICAgICAgICBwYWdpbmF0ZToge1xyXG4gICAgICAgICAgICAgICAgICAgIHByZXZpb3VzOiBcIjxcIixcclxuICAgICAgICAgICAgICAgICAgICBuZXh0OiAnPicsXHJcbiAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBkb206ICc8XCJ0YWJsZS1yZXNwb25zaXZlXCJydD48XCJib3R0b20gcm93XCI8XCJjb2wtMTIgZC1mbGV4IGp1c3RpZnktY29udGVudC1jZW50ZXJcImk+PFwiY29sLTEyIGQtZmxleCBqdXN0aWZ5LWNvbnRlbnQtY2VudGVyXCJwPj4nLFxyXG4gICAgICAgICAgICBvcmRlcjogW1xyXG4gICAgICAgICAgICAgICAgWzIsICdhc2MnXVxyXG4gICAgICAgICAgICBdLFxyXG4gICAgICAgICAgICBjb2x1bW5EZWZzOiBbe1xyXG4gICAgICAgICAgICAgICAgdGFyZ2V0czogMCwgLy8gRWwgw61uZGljZSBkZSBsYSBjb2x1bW5hIG9jdWx0YVxyXG4gICAgICAgICAgICAgICAgdmlzaWJsZTogZmFsc2UsIC8vIE9jdWx0YXIgbGEgY29sdW1uYVxyXG4gICAgICAgICAgICAgICAgc2VhcmNoYWJsZTogdHJ1ZSAvLyBIYWNlciBxdWUgbGEgY29sdW1uYSBzZWEgYnVzY2FibGVcclxuICAgICAgICAgICAgfV0sXHJcbiAgICAgICAgICAgIGFqYXg6IHtcclxuICAgICAgICAgICAgICAgIHR5cGU6ICdHRVQnLFxyXG4gICAgICAgICAgICAgICAgaGVhZGVyczoge1xyXG4gICAgICAgICAgICAgICAgICAgICdYLVJlcXVlc3RlZC1XaXRoJzogJ1hNTEh0dHBSZXF1ZXN0JyxcclxuICAgICAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKSxcclxuICAgICAgICAgICAgICAgICAgICAnQXV0aG9yaXphdGlvbic6ICdCZWFyZXIgJyArICQoJ21ldGFbbmFtZT1cImF1dGgta2V5XCJdJykuYXR0cignY29udGVudCcpLFxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHVybDogJChgIyR7dGFibGVfaWR9YCkuZGF0YSgndXJsJyksXHJcbiAgICAgICAgICAgICAgICBkYXRhOiBmdW5jdGlvbiAoZCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHJldHVybiAkLmV4dGVuZCh7fSwgZCwgZGF0YSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGNvbHVtbnM6IFt7XHJcbiAgICAgICAgICAgICAgICBkYXRhOiAnY3JlYXRlZF9hdCdcclxuICAgICAgICAgICAgfSwge1xyXG4gICAgICAgICAgICAgICAgZGF0YTogJ3RpdGxlJyxcclxuICAgICAgICAgICAgICAgIHRpdGxlOiAnVGl0dWxvJyxcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgZGF0YTogJ2ZvbGlvJyxcclxuICAgICAgICAgICAgICAgIHRpdGxlOiAnRm9saW8nXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGRhdGE6ICdpc2JuJyxcclxuICAgICAgICAgICAgICAgIHRpdGxlOiAnSVNCTidcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgZGF0YTogJ2F1dG9yJyxcclxuICAgICAgICAgICAgICAgIHRpdGxlOiAnQXV0b3InXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGRhdGE6ICdlZGl0b3JpYWwnLFxyXG4gICAgICAgICAgICAgICAgdGl0bGU6ICdFZGl0b3JpYWwnXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGRhdGE6ICdhcmVhJyxcclxuICAgICAgICAgICAgICAgIHRpdGxlOiAnQXJlYSdcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgZGF0YTogJ3F1YW50aXR5JyxcclxuICAgICAgICAgICAgICAgIHRpdGxlOiAnQ2FudGlkYWQnXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGRhdGE6ICdlZGl0aW9uJyxcclxuICAgICAgICAgICAgICAgIHRpdGxlOiAnRWRpY2nDs24nXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGRhdGE6ICdjb3VudHJ5JyxcclxuICAgICAgICAgICAgICAgIHRpdGxlOiAnUGHDrXMnXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGRhdGE6ICdwYWdlcycsXHJcbiAgICAgICAgICAgICAgICB0aXRsZTogJ1DDoWdpbmFzJ1xyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICBkYXRhOiAnc2hlbGYnLFxyXG4gICAgICAgICAgICAgICAgdGl0bGU6ICdFc3RhbnRlJ1xyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB7XHJcbiAgICAgICAgICAgICAgICBkYXRhOiAndGhlbWUnLFxyXG4gICAgICAgICAgICAgICAgdGl0bGU6ICdUZW1hJ1xyXG4gICAgICAgICAgICB9LCB7XHJcbiAgICAgICAgICAgICAgICBkYXRhOiAnZWRpdF91cmwnLFxyXG4gICAgICAgICAgICAgICAgcmVuZGVyOiBmdW5jdGlvbiAoZGF0YSwgdHlwZSwgcm93LCBtZXRhKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGBcclxuICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVwiZC1mbGV4XCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIDxhIGhyZWY9XCIke3Jvdy5lZGl0X3VybH1cIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxpIGNsYXNzPVwia2ktZHVvdG9uZSBraS1wZW5jaWwgZnMtMiBtZS0yXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJwYXRoMVwiPjwvc3Bhbj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInBhdGgyXCI+PC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9pPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICA8L2E+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIDxhIGhyZWY9XCIjXCIgY2xhc3M9XCJidG4tZGVsXCIgZGF0YS11cmw9XCIke3Jvdy5kZWxldGVfdXJsfVwiIGRhdGEtYWN0aW9uPVwiZGVsZXRlXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aSBjbGFzcz1cImtpLWR1b3RvbmUga2ktdHJhc2gtc3F1YXJlIGZzLTJcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInBhdGgxXCI+PC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwicGF0aDJcIj48L3NwYW4+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJwYXRoM1wiPjwvc3Bhbj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInBhdGg0XCI+PC9zcGFuPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9pPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICA8L2E+XHJcbiAgICAgICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICBgXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIF0sXHJcbiAgICAgICAgICAgIGZpeGVkQ29sdW1uczoge1xyXG4gICAgICAgICAgICAgICAgbGVmdDogMCxcclxuICAgICAgICAgICAgICAgIHJpZ2h0OiAxLFxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIHRhYmxlID0gZHQuJDtcclxuXHJcbiAgICAgICAgLy8gUmUtaW5pdCBmdW5jdGlvbnMgb24gZXZlcnkgdGFibGUgcmUtZHJhdyAtLSBtb3JlIGluZm86IGh0dHBzOi8vZGF0YXRhYmxlcy5uZXQvcmVmZXJlbmNlL2V2ZW50L2RyYXdcclxuICAgICAgICBkdC5vbignZHJhdycsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgS1RNZW51LmNyZWF0ZUluc3RhbmNlcygpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIFNlYXJjaCBEYXRhdGFibGUgLS0tIG9mZmljaWFsIGRvY3MgcmVmZXJlbmNlOiBodHRwczovL2RhdGF0YWJsZXMubmV0L3JlZmVyZW5jZS9hcGkvc2VhcmNoKClcclxuICAgIHZhciBoYW5kbGVTZWFyY2hEYXRhdGFibGUgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgY29uc3QgZmlsdGVyU2VhcmNoID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEta3QtZWNvbW1lcmNlLXByb2R1Y3QtZmlsdGVyPVwic2VhcmNoXCJdJyk7XHJcbiAgICAgICAgZmlsdGVyU2VhcmNoLmFkZEV2ZW50TGlzdGVuZXIoJ2tleXVwJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgY29uc29sZS5sb2coZS50YXJnZXQudmFsdWUpXHJcbiAgICAgICAgICAgIGR0LnNlYXJjaChlLnRhcmdldC52YWx1ZSkuZHJhdygpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG4gICAgdmFyIGhhbmRsZUZpbHRlckRhdGF0YWJsZSA9ICgpID0+IHtcclxuXHJcbiAgICAgICAgLy8gRmlsdGVyIGRhdGF0YWJsZSBvbiBzdWJtaXRcclxuICAgICAgICBpZiAoJCgnI2FyZWEnKS5sZW5ndGgpIHtcclxuICAgICAgICAgICAgY29uc29sZS5sb2coXCJBcXVpXCIpO1xyXG4gICAgICAgICAgICAkKCcjYXJlYScpLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgICAgICAgICAgLy8gZGF0YS5zZWFyY2guYXJlYSA9IGUudGFyZ2V0LnZhbHVlO1xyXG4gICAgICAgICAgICAgICAgLy8gZHQuc2VhcmNoKCQoJyNzZWFyY2gnKS52YWwoKSkuZHJhdygpO1xyXG4gICAgICAgICAgICAgICAgaWYgKGUudGFyZ2V0LnZhbHVlID09IFwiYWxsXCIpIHtcclxuICAgICAgICAgICAgICAgICAgICBkdC5jb2x1bW4oNikuc2VhcmNoKFwiXCIpLmRyYXcoKTtcclxuICAgICAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgZHQuY29sdW1uKDYpLnNlYXJjaChlLnRhcmdldC52YWx1ZSkuZHJhdygpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGlmICgkKCcjZGF0ZWZpbHRlcicpLmxlbmd0aCkge1xyXG4gICAgICAgICAgICAkKCcjZGF0ZWZpbHRlcicpLm9uKCdhcHBseS5kYXRlcmFuZ2VwaWNrZXInLCBmdW5jdGlvbiAoZXYsIHBpY2tlcikge1xyXG4gICAgICAgICAgICAgICAgdmFyIHN0YXJ0RGF0ZSA9IHBpY2tlci5zdGFydERhdGUuZm9ybWF0KCdZWVlZLU1NLUREJyk7XHJcbiAgICAgICAgICAgICAgICB2YXIgZW5kRGF0ZSA9IHBpY2tlci5lbmREYXRlLmZvcm1hdCgnWVlZWS1NTS1ERCcpO1xyXG5cclxuICAgICAgICAgICAgICAgICQuZm4uZGF0YVRhYmxlLmV4dC5zZWFyY2gucHVzaChcclxuICAgICAgICAgICAgICAgICAgICBmdW5jdGlvbiAoc2V0dGluZ3MsIGRhdGEsIGRhdGFJbmRleCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB2YXIgZGF0ZSA9IGRhdGFbMF0uc3BsaXQoJ1QnKVswXTsgLy8gT2J0ZW5lciBzb2xvIGxhIHBhcnRlIGRlIGxhIGZlY2hhXHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICBpZiAoZGF0ZSA+PSBzdGFydERhdGUgJiYgZGF0ZSA8PSBlbmREYXRlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gdHJ1ZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgKTtcclxuXHJcbiAgICAgICAgICAgICAgICBkdC5kcmF3KCk7XHJcbiAgICAgICAgICAgICAgICAkLmZuLmRhdGFUYWJsZS5leHQuc2VhcmNoLnBvcCgpO1xyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgICQoJyNkYXRlZmlsdGVyJykub24oJ2NhbmNlbC5kYXRlcmFuZ2VwaWNrZXInLCBmdW5jdGlvbiAoZXYsIHBpY2tlcikge1xyXG4gICAgICAgICAgICAgICAgJCgnI2RhdGVmaWx0ZXInKS52YWwoJycpO1xyXG4gICAgICAgICAgICAgICAgJC5mbi5kYXRhVGFibGUuZXh0LnNlYXJjaC5wb3AoKTtcclxuICAgICAgICAgICAgICAgIGR0LmRyYXcoKTtcclxuICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC8vIFB1YmxpYyBtZXRob2RzXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgaW5pdERhdGF0YWJsZSgpO1xyXG4gICAgICAgICAgICBoYW5kbGVTZWFyY2hEYXRhdGFibGUoKTtcclxuICAgICAgICAgICAgaGFuZGxlRmlsdGVyRGF0YXRhYmxlKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5LVFV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uICgpIHtcclxuICAgIEtURGF0YXRhYmxlc1NlcnZlclNpZGUuaW5pdCgpO1xyXG59KTtcclxuXHJcbiQoJ2lucHV0W25hbWU9XCJkYXRlZmlsdGVyXCJdJykuZGF0ZXJhbmdlcGlja2VyKHtcclxuICAgIGF1dG9VcGRhdGVJbnB1dDogZmFsc2UsXHJcbiAgICBsb2NhbGU6IHtcclxuICAgICAgICBjYW5jZWxMYWJlbDogJ0NsZWFyJ1xyXG4gICAgfVxyXG59KTtcclxuXHJcbiQoJ2lucHV0W25hbWU9XCJkYXRlZmlsdGVyXCJdJykub24oJ2FwcGx5LmRhdGVyYW5nZXBpY2tlcicsIGZ1bmN0aW9uIChldiwgcGlja2VyKSB7XHJcbiAgICAkKHRoaXMpLnZhbChwaWNrZXIuc3RhcnREYXRlLmZvcm1hdCgnTU0vREQvWVlZWScpICsgJyAtICcgKyBwaWNrZXIuZW5kRGF0ZS5mb3JtYXQoXHJcbiAgICAgICAgJ01NL0REL1lZWVknKSk7XHJcbn0pO1xyXG5cclxuJCgnaW5wdXRbbmFtZT1cImRhdGVmaWx0ZXJcIl0nKS5vbignY2FuY2VsLmRhdGVyYW5nZXBpY2tlcicsIGZ1bmN0aW9uIChldiwgcGlja2VyKSB7XHJcbiAgICAkKHRoaXMpLnZhbCgnJyk7XHJcbn0pO1xyXG5cclxuJCgnYm9keScpLm9uKCdjbGljaycsICcuYnRuLWRlbCcsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICBjb25zb2xlLmxvZyhcImRhdGEtYWN0aW9uXCIpO1xyXG5cclxuICAgIHZhciAkdGhpcyA9IHRoaXM7XHJcbiAgICB2YXIgdXJsID0gJCgkdGhpcykuZGF0YSgndXJsJyk7XHJcbiAgICB2YXIgSUQgPSAkKCR0aGlzKS5kYXRhKCdpZCcpO1xyXG5cclxuICAgIFN3YWwuZmlyZSh7XHJcbiAgICAgICAgdGl0bGU6ICfCv0NvbmZpcm1hIGVsaW1pbmFybG8/JyxcclxuICAgICAgICB0ZXh0OiBcIlVuYSB2ZXogaGVjaG8gZXN0bywgbm8gcG9kcsOhcyBkZXNoYWNlciBlc3RhIGFjY2nDs25cIixcclxuICAgICAgICBpY29uOiAnd2FybmluZycsXHJcbiAgICAgICAgc2hvd0NhbmNlbEJ1dHRvbjogdHJ1ZSxcclxuICAgICAgICBjb25maXJtQnV0dG9uQ29sb3I6ICcjZjM2JyxcclxuICAgICAgICBjYW5jZWxCdXR0b25Db2xvcjogJyNjZmQ2ZGYnLFxyXG4gICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiAnQ29uZmlybWFyJ1xyXG4gICAgfSkudGhlbigocmVzdWx0KSA9PiB7XHJcbiAgICAgICAgaWYgKHJlc3VsdC5pc0NvbmZpcm1lZCkge1xyXG4gICAgICAgICAgICBoLmdldFBldGl0aW9uKHVybCwgeyBpZDogSUQgfSwgJ0RFTEVURScsIGZhbHNlKS50aGVuKGRhdGEgPT4ge1xyXG4gICAgICAgICAgICAgICAgaWYgKGRhdGEuc3VjY2VzcyA9PSB0cnVlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgdG9hc3RyLnN1Y2Nlc3MoZGF0YS5tc2cpO1xyXG4gICAgICAgICAgICAgICAgICAgIGlmIChkYXRhLmFjdGlvbikge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGxvY2F0aW9uLmhyZWYgPSBkYXRhLmFjdGlvbjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfSwgMjAwMClcclxuICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkKGAjJHtkYXRhLnRhYmxlX2lkfWApLkRhdGFUYWJsZSgpLmFqYXgucmVsb2FkKCk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICB0b2FzdHIuZXJyb3IoKGRhdGEubXNnKSA/IGRhdGEubXNnIDogJ0hhIG9jdXJyaWRvIHVuIGVycm9yJywgXCJPcHMuLi5cIiwpO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKGRhdGEpXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH1cclxuICAgIH0pXHJcbn0pOyJdLCJuYW1lcyI6WyJ0YWJsZV9pZCIsIktURGF0YXRhYmxlc1NlcnZlclNpZGUiLCJ0YWJsZSIsImR0IiwiZmlsdGVyUGF5bWVudCIsImRhdGEiLCIkIiwidmFsIiwibGVuZ3RoIiwiaW5pdERhdGF0YWJsZSIsIkRhdGFUYWJsZSIsInNlYXJjaERlbGF5IiwicHJvY2Vzc2luZyIsImxhbmd1YWdlIiwidXJsIiwicGFnaW5hdGUiLCJwcmV2aW91cyIsIm5leHQiLCJkb20iLCJvcmRlciIsImNvbHVtbkRlZnMiLCJ0YXJnZXRzIiwidmlzaWJsZSIsInNlYXJjaGFibGUiLCJhamF4IiwidHlwZSIsImhlYWRlcnMiLCJhdHRyIiwiY29uY2F0IiwiZCIsImV4dGVuZCIsImNvbHVtbnMiLCJ0aXRsZSIsInJlbmRlciIsInJvdyIsIm1ldGEiLCJlZGl0X3VybCIsImRlbGV0ZV91cmwiLCJmaXhlZENvbHVtbnMiLCJsZWZ0IiwicmlnaHQiLCJvbiIsIktUTWVudSIsImNyZWF0ZUluc3RhbmNlcyIsImhhbmRsZVNlYXJjaERhdGF0YWJsZSIsImZpbHRlclNlYXJjaCIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvciIsImFkZEV2ZW50TGlzdGVuZXIiLCJlIiwiY29uc29sZSIsImxvZyIsInRhcmdldCIsInZhbHVlIiwic2VhcmNoIiwiZHJhdyIsImhhbmRsZUZpbHRlckRhdGF0YWJsZSIsImNvbHVtbiIsImV2IiwicGlja2VyIiwic3RhcnREYXRlIiwiZm9ybWF0IiwiZW5kRGF0ZSIsImZuIiwiZGF0YVRhYmxlIiwiZXh0IiwicHVzaCIsInNldHRpbmdzIiwiZGF0YUluZGV4IiwiZGF0ZSIsInNwbGl0IiwicG9wIiwiaW5pdCIsIktUVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCIsImRhdGVyYW5nZXBpY2tlciIsImF1dG9VcGRhdGVJbnB1dCIsImxvY2FsZSIsImNhbmNlbExhYmVsIiwicHJldmVudERlZmF1bHQiLCIkdGhpcyIsIklEIiwiU3dhbCIsImZpcmUiLCJ0ZXh0IiwiaWNvbiIsInNob3dDYW5jZWxCdXR0b24iLCJjb25maXJtQnV0dG9uQ29sb3IiLCJjYW5jZWxCdXR0b25Db2xvciIsImNvbmZpcm1CdXR0b25UZXh0IiwidGhlbiIsInJlc3VsdCIsImlzQ29uZmlybWVkIiwiaCIsImdldFBldGl0aW9uIiwiaWQiLCJzdWNjZXNzIiwidG9hc3RyIiwibXNnIiwiYWN0aW9uIiwic2V0VGltZW91dCIsImxvY2F0aW9uIiwiaHJlZiIsInJlbG9hZCIsImVycm9yIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/tables/book-table.js\n");

/***/ }),

/***/ "./resources/mix/vendors/jstree/jstree.bundle.scss":
/*!*********************************************************!*\
  !*** ./resources/mix/vendors/jstree/jstree.bundle.scss ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvanN0cmVlL2pzdHJlZS5idW5kbGUuc2Nzcy5qcyIsIm1hcHBpbmdzIjoiO0FBQUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvanN0cmVlL2pzdHJlZS5idW5kbGUuc2Nzcz9iMjMzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/mix/vendors/jstree/jstree.bundle.scss\n");

/***/ }),

/***/ "./resources/mix/vendors/leaflet/leaflet.bundle.scss":
/*!***********************************************************!*\
  !*** ./resources/mix/vendors/leaflet/leaflet.bundle.scss ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvbGVhZmxldC9sZWFmbGV0LmJ1bmRsZS5zY3NzLmpzIiwibWFwcGluZ3MiOiI7QUFBQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9taXgvdmVuZG9ycy9sZWFmbGV0L2xlYWZsZXQuYnVuZGxlLnNjc3M/NDNjNyJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/mix/vendors/leaflet/leaflet.bundle.scss\n");

/***/ }),

/***/ "./resources/mix/vendors/prismjs/prismjs.bundle.scss":
/*!***********************************************************!*\
  !*** ./resources/mix/vendors/prismjs/prismjs.bundle.scss ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvcHJpc21qcy9wcmlzbWpzLmJ1bmRsZS5zY3NzLmpzIiwibWFwcGluZ3MiOiI7QUFBQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9taXgvdmVuZG9ycy9wcmlzbWpzL3ByaXNtanMuYnVuZGxlLnNjc3M/NDUzZiJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/mix/vendors/prismjs/prismjs.bundle.scss\n");

/***/ }),

/***/ "./resources/mix/vendors/tiny-slider/tiny-slider.scss":
/*!************************************************************!*\
  !*** ./resources/mix/vendors/tiny-slider/tiny-slider.scss ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvdGlueS1zbGlkZXIvdGlueS1zbGlkZXIuc2Nzcy5qcyIsIm1hcHBpbmdzIjoiO0FBQUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvdGlueS1zbGlkZXIvdGlueS1zbGlkZXIuc2Nzcz8xYzJhIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/mix/vendors/tiny-slider/tiny-slider.scss\n");

/***/ }),

/***/ "./resources/mix/vendors/vis-timeline/vis-timeline.bundle.scss":
/*!*********************************************************************!*\
  !*** ./resources/mix/vendors/vis-timeline/vis-timeline.bundle.scss ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvdmlzLXRpbWVsaW5lL3Zpcy10aW1lbGluZS5idW5kbGUuc2Nzcy5qcyIsIm1hcHBpbmdzIjoiO0FBQUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvdmlzLXRpbWVsaW5lL3Zpcy10aW1lbGluZS5idW5kbGUuc2Nzcz9hYjJlIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/mix/vendors/vis-timeline/vis-timeline.bundle.scss\n");

/***/ }),

/***/ "./resources/mix/plugins.scss":
/*!************************************!*\
  !*** ./resources/mix/plugins.scss ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3BsdWdpbnMuc2Nzcy5qcyIsIm1hcHBpbmdzIjoiO0FBQUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWl4L3BsdWdpbnMuc2Nzcz9jMDBlIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/mix/plugins.scss\n");

/***/ }),

/***/ "./resources/_keenthemes/src/sass/style.scss":
/*!***************************************************!*\
  !*** ./resources/_keenthemes/src/sass/style.scss ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvX2tlZW50aGVtZXMvc3JjL3Nhc3Mvc3R5bGUuc2Nzcy5qcyIsIm1hcHBpbmdzIjoiO0FBQUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvX2tlZW50aGVtZXMvc3JjL3Nhc3Mvc3R5bGUuc2Nzcz8wNzAyIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/_keenthemes/src/sass/style.scss\n");

/***/ }),

/***/ "./resources/mix/vendors/datatables/datatables.bundle.scss":
/*!*****************************************************************!*\
  !*** ./resources/mix/vendors/datatables/datatables.bundle.scss ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvZGF0YXRhYmxlcy9kYXRhdGFibGVzLmJ1bmRsZS5zY3NzLmpzIiwibWFwcGluZ3MiOiI7QUFBQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9taXgvdmVuZG9ycy9kYXRhdGFibGVzL2RhdGF0YWJsZXMuYnVuZGxlLnNjc3M/MTRlOCJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/mix/vendors/datatables/datatables.bundle.scss\n");

/***/ }),

/***/ "./resources/mix/vendors/fullcalendar/fullcalendar.bundle.scss":
/*!*********************************************************************!*\
  !*** ./resources/mix/vendors/fullcalendar/fullcalendar.bundle.scss ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvZnVsbGNhbGVuZGFyL2Z1bGxjYWxlbmRhci5idW5kbGUuc2Nzcy5qcyIsIm1hcHBpbmdzIjoiO0FBQUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvZnVsbGNhbGVuZGFyL2Z1bGxjYWxlbmRhci5idW5kbGUuc2Nzcz8yOWI3Il0sInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/mix/vendors/fullcalendar/fullcalendar.bundle.scss\n");

/***/ }),

/***/ "./resources/mix/vendors/jkanban/jkanban.bundle.scss":
/*!***********************************************************!*\
  !*** ./resources/mix/vendors/jkanban/jkanban.bundle.scss ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWl4L3ZlbmRvcnMvamthbmJhbi9qa2FuYmFuLmJ1bmRsZS5zY3NzLmpzIiwibWFwcGluZ3MiOiI7QUFBQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9taXgvdmVuZG9ycy9qa2FuYmFuL2prYW5iYW4uYnVuZGxlLnNjc3M/MTI4MyJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/mix/vendors/jkanban/jkanban.bundle.scss\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/scripts/datatables/book-table": 0,
/******/ 			"assets/plugins/global/plugins.bundle": 0,
/******/ 			"assets/plugins/custom/datatables/datatables.bundle": 0,
/******/ 			"assets/plugins/custom/leaflet/leaflet.bundle": 0,
/******/ 			"assets/plugins/custom/jkanban/jkanban.bundle": 0,
/******/ 			"assets/plugins/custom/fullcalendar/fullcalendar.bundle": 0,
/******/ 			"assets/plugins/custom/vis-timeline/vis-timeline.bundle": 0,
/******/ 			"assets/plugins/custom/tiny-slider/tiny-slider": 0,
/******/ 			"assets/plugins/custom/prismjs/prismjs.bundle": 0,
/******/ 			"assets/plugins/custom/jstree/jstree.bundle": 0,
/******/ 			"assets/css/style.bundle": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/js/tables/book-table.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/plugins.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/_keenthemes/src/sass/style.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/vendors/datatables/datatables.bundle.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/vendors/fullcalendar/fullcalendar.bundle.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/vendors/jkanban/jkanban.bundle.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/vendors/jstree/jstree.bundle.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/vendors/leaflet/leaflet.bundle.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/vendors/prismjs/prismjs.bundle.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/vendors/tiny-slider/tiny-slider.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/plugins/global/plugins.bundle","assets/plugins/custom/datatables/datatables.bundle","assets/plugins/custom/leaflet/leaflet.bundle","assets/plugins/custom/jkanban/jkanban.bundle","assets/plugins/custom/fullcalendar/fullcalendar.bundle","assets/plugins/custom/vis-timeline/vis-timeline.bundle","assets/plugins/custom/tiny-slider/tiny-slider","assets/plugins/custom/prismjs/prismjs.bundle","assets/plugins/custom/jstree/jstree.bundle","assets/css/style.bundle"], () => (__webpack_require__("./resources/mix/vendors/vis-timeline/vis-timeline.bundle.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
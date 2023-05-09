import $ from 'jquery';

import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import Swal from 'sweetalert2';
import * as h from './helper';
import toastr from 'toastr';
import dt from 'datatables.net-bs5';
import 'datatables.net-fixedcolumns';
import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker.css';
import localeEs from 'air-datepicker/locale/es';
import select2 from 'select2';
import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';
import { format, formatDistanceToNow, formatDistance } from 'date-fns';
import differenceInDays from 'date-fns/differenceInDays'
import { es } from 'date-fns/locale';

select2($);
window.$ = $;
window.h = h;
window.toastr = toastr;
$.DataTable = dt;
window.Swal = Swal;
window.Chart = Chart;
Chart.register(ChartDataLabels);

window.AirDatepicker = AirDatepicker;
window.localeEs = localeEs;

window.datefns_format = format;
window.datefns_formatDistanceToNow = formatDistanceToNow;
window.datefns_formatDistance = formatDistance;
window.datefns_differenceInDays = differenceInDays;
window.datefns_es = es;

window.Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

$('select').select2({
    theme: "bootstrap-5",
    selectionCssClass: "select2--large",
    dropdownCssClass: "select2--large",
});
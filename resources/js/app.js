import $ from 'jquery';
window.$ = $;

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

window.h = h;
window.toastr = toastr;
$.DataTable = dt;
window.Swal = Swal;

window.AirDatepicker = AirDatepicker;
window.localeEs = localeEs;

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
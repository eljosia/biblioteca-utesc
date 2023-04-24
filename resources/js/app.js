import $ from 'jquery';
window.$ = $;

import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
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

window.AirDatepicker = AirDatepicker;
window.localeEs = localeEs;

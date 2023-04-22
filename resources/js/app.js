import $ from 'jquery';
window.$ = $;

import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import * as h from './helper';
import toastr from 'toastr';
import dt from 'datatables.net-bs5';

window.h = h;
window.toastr = toastr;
$.DataTable = dt;
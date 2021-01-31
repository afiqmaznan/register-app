require('./bootstrap');
require('select2');
import $ from 'jquery';


window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

$('.datepicker').datepicker();

import $ from 'jquery';

/* Foundation JS imports here */
import './lib/foundation';

/* Main stylesheet, do not remove */
import "../scss/app.scss";

/* Your own modules go here */
import main from './lib/main';
main.load();

$(document).foundation();
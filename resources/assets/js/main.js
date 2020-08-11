import Vue from 'vue';

function getLang() {
  return window.locale;
}

const systemCountryId = process.env.MIX_SYSTEM_COUNTRY_ID || '42';
const InternationalApiUrl = process.env.MIX_API_URL || '';

window._ = _; // is this really needed in window scope?
/* eslint-disable global-require */ // fugly solution until we can remove jquery from window scope
try {
  window.jQuery = require('jquery');
  window.$ = jQuery;

  require('bootstrap-sass');
} catch (e) {
  //
}

require('./external-script-generation.js');

// globals
/* eslint-disable import/no-dynamic-require */
window.InternationalApiUrl = InternationalApiUrl;
window.systemCountryId = systemCountryId;
window.RememberLoggedInLink = null;

window.strToField = str => str.replace(/([A-Z])/g, '_$1').toLowerCase()
  .split('.')[0]
  .replace(/_/g, ' ');

window.tofixedTwo = (value) => {
  let newValue = null;
  if (value.toString().match(/\d/g)) {
    [newValue] = value.toString().match(/\d+(\.\d{0,2})?/g);
  }
  return newValue;
};

window.moment = (value) => {
  const date = new Date(value);
  const yyyy = date.getFullYear();

  let mm = date.getMonth() + 1;
  mm = (mm < 10) ? `0${mm}` : mm;

  let dd = date.getDate();
  dd = (dd < 10) ? `0${dd}` : dd;

  return `${yyyy}-${mm}-${dd}`;
};

window.scrollToMe = (scrollLocation) => {
  const element = document.querySelector(scrollLocation);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
};

window.Lang = getLang();

window.Vue = Vue;

window.functions = require('./functions.js');
window.$ = $.extend(require('slick-carousel'));
window.$ = $.extend(require('webpack-jquery-ui/selectmenu'));
window.$ = $.extend(require('webpack-jquery-ui/autocomplete'));
window.$ = $.extend(require('bootstrap-datepicker'));
window.$ = $.extend(require('jquery-fancybox/source/js/jquery.fancybox.pack.js'));

Vue.prototype.trans = trans;
Vue.prototype.locale = locale;
Vue.prototype.systemCountryId = systemCountryId;
Vue.prototype.UrlLang = UrlLang;
Vue.prototype.moment = window.moment;

require('bootstrap-datepicker/js/locales/bootstrap-datepicker.sv.js');
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.no.js');
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.fi.js');
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js');

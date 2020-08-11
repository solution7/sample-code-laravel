require('jsdom-global')();

global.$ = global.jQuery = require('jquery');
require('bootstrap-sass');

window.Date = Date; // Fix for "TypeError: Super expression must either be null or a function"

global.expect = require('expect');
global.axios = require('axios');
global.Vuex = require('vuex');
global.Vue = require('vue');
global._ = require('lodash');

global.locale = 'en';
global.UrlLang = 'en';
global.Lang = 'en';
global.systemCountryId = 42;
global.trans = key => key;
global.InternationalApiUrl = '';

global.localStorage = {
  items: {},
};

localStorage.getItem = function (item) {
  return localStorage.items.item;
};

localStorage.setItem = function (item, value) {
  return localStorage.items[item] = value;
};
global.scrollToMe = (scrollLocation) => {
  const element = document.querySelector(scrollLocation);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
};

localStorage.removeItem = function (item) {
  delete localStorage.items[item];
};

// jQuery ui extend
$ = $.extend(require('jquery-ui/ui/version'));
$ = $.extend(require('jquery-ui/ui/widget'));
$ = $.extend(require('jquery-ui/ui/widgets/selectmenu'));
$ = $.extend(require('bootstrap-datepicker'));
$ = $.extend(require('slick-carousel'));
$ = $.extend(require('jquery-fancybox/source/js/jquery.fancybox.pack.js'));

global.strToField = () => {};
global.strToTrans = () => {};

global.moment = (value) => {
  const date = new Date(value);
  let mm = date.getMonth() + 1;
  mm = (mm < 10) ? `0${mm}` : mm;
  let dd = date.getDate();
  dd = (dd < 10) ? `0${dd}` : dd;
  const yyyy = date.getFullYear();

  return `${yyyy}-${mm}-${dd}`;
};

global.scrollToMe = (scrollLocation) => {
  const element = document.querySelector(scrollLocation);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
};

global.functions = require('./../../resources/assets/js/functions.js');

// Helper Functions
global.see = (wrapper, text, selector) => {
  const wrap = selector ? wrapper.find(selector) : wrapper;

  expect(wrap.html()).toContain(text);
};

global.dontSee = (wrapper, text, selector) => {
  const wrap = selector ? wrapper.find(selector) : wrapper;

  expect(wrap.html()).not.toContain(text);
};

global.type = (wrapper, text, selector) => {
  const node = wrapper.find(selector);

  node.element.value = text;
  node.trigger('input');
};

global.click = (wrapper, selector) => {
  wrapper.find(selector).trigger('click');
};

global.submit = (wrapper, selector) => {
  wrapper.find(selector).trigger('submit');
};

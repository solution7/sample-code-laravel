import SiteHeader from './components/common/SiteHeader.vue';

import PageNotFound from './components/front/common/PageNotFound.vue';
import Footer from './components/common/Footer.vue';

import Error from './components/common/elements/Error.vue';

import InternalServerError from './components/errors/500.vue';

import Alerts from './components/common/Alerts.vue';

import svgIconComponent from './components/common/elements/SvgIcon.vue';


Vue.component('error-component', Error);

Vue.component('site-header-component', SiteHeader);
Vue.component('footer-component', Footer);

Vue.component('page-not-found-component', PageNotFound);

Vue.component('internal-server-error-component', InternalServerError);

Vue.component('svg-icon', svgIconComponent);

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('alerts', Alerts);

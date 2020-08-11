import VueFormWizard from 'vue-form-wizard';
import axios from './services/client';
import store from './store/store';
import router from './routes/router';
import App from './App.vue';

Vue.use(VueFormWizard);

window.axios = axios; // this is now our single point of contact for axios

require('./globalComponents');

// make vue app
const vm = new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App),
  mounted() {
    document.dispatchEvent(new Event('render-event'));
  },
});

// this surely can be done better?
document.getElementsByTagName('body')[0].onclick = () => {
  vm.$store.dispatch('CLOSE_ALL_MENUS');
};

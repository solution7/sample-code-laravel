import store from './../store/store';

const hiddenRoutesWhenLoggedIn = ['Register', 'Login', 'ResetPassword', 'ForgotPassword', 'Loader'];
const lang = window.UrlLang ? `/${window.UrlLang}` : '';

// Make sure that the logged in user is always available in store
// Reroute if trying to route to some routes
const loggedInUserMiddleware = {
  async handle(to, next) {
    if (store.getters.auth && !store.getters.loggedInUser) {
      await store.dispatch('REFRESH_LOGGED_IN_USER');
    }

    if (store.getters.auth && hiddenRoutesWhenLoggedIn.includes(to.name)) {
      next({ path: lang });
    }
  },
};

export default loggedInUserMiddleware;

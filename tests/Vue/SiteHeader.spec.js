/* global describe beforeEach it see afterEach Vuex axios click dontSee */
/* eslint-disable no-underscore-dangle */
import { mount, createLocalVue } from '@vue/test-utils';
import moxios from 'moxios';

import SiteHeader from '../../resources/assets/js/components/common/SiteHeader.vue';
import headerModule from '../../resources/assets/js/store/modules/header';
import commonModule from '../../resources/assets/js/store/modules/common';

const localVue = createLocalVue();
localVue.use(Vuex);
localVue.prototype.trans = key => key;

const $route = {
  name: 'Client',
};

describe('SiteHeader', () => {
  let wrapper;

  const store = new Vuex.Store({
    modules: {
      commonModule,
      headerModule,
    },
  });

  beforeEach(() => {
    moxios.install(axios);

    wrapper = mount(SiteHeader, {
      store,
      localVue,
      mocks: {
        $route,
      },
      data() {
        return {
          authed: true,
        };
      },
      stubs: ['router-link', 'router-view'],
      computed: {
        header() {
          return this.$store.state.headerModule.header;
        },
        activeLang() {
          return 'en';
        },
        auth() {
          return this._data.authed;
        },
      },
      methods: {
        logout() {
          wrapper.vm._data.authed = false;
        },
      },
    });
  });

  afterEach(() => {
    moxios.uninstall(axios);
  });

  it('shows logout button when logged in', () => {
    see(wrapper, 'common.Logout');
  });

  it('does not show logout button after logout', () => {
    click(wrapper, '.logout');
    dontSee(wrapper, 'common.Logout');
  });
});

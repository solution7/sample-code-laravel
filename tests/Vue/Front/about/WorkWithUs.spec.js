import { mount, createLocalVue } from '@vue/test-utils';
import moxios from 'moxios';
import VueRouter from 'vue-router';

import WorkWithUs from '../../../../resources/assets/js/components/front/about/WorkWithUs.vue';
import jobPositionModule from '../../../../resources/assets/js/store/modules/job-position';
import exceptionModule from '../../../../resources/assets/js/store/modules/exception';
import alertModule from '../../../../resources/assets/js/store/modules/alert';

const localVue = createLocalVue();
localVue.use(Vuex);
localVue.use(VueRouter);

localVue.prototype.trans = key => key;
window.trans = key => key;

describe('Work with us', () => {
  let wrapper;

  const store = new Vuex.Store({
    modules: {
      jobPositionModule,
      alertModule,
      exceptionModule,
    },
  });

  beforeEach(() => {
    moxios.install(axios);

    wrapper = mount(WorkWithUs, {
      store,
      localVue,
    });
  });

  afterEach(() => {
    moxios.uninstall(axios);
  });

  it('Shows "Page Title" Text', () => {
    see(wrapper, 'about.work_with_us');
  });

  it('Get "Jobs for work with us"', (done) => {
    moxios.stubOnce('GET', '/jobs', {
      status: 200,
      response: {
        data: [{
          id: 2,
          content: 'Send us your resume and cover letter',
          country_id: 42,
          language_id: 1,
          subject: 'Open application',
          user_id: 1,
        }],
      },
    });
    moxios.wait(() => {
      see(wrapper, 'Open application');
      see(wrapper, 'Send us your resume and cover letter');
      done();
    });
  });

  it('Validation for "Apply For Job" Form', (done) => {
    click(wrapper, '.apply-form-submit');

    moxios.stubOnce('post', '/apply-for-job', {
      status: 422,
      response: {
        message: 'The given data was invalid.',
        errors: {
          first_name: ['The first name field is required.'],
          last_name: ['The last name field is required.'],
          email: ['The email field is required.'],
        },
      },
    });

    moxios.wait(() => {
      see(wrapper, 'The first name field is required.');
      see(wrapper, 'The last name field is required.');
      see(wrapper, 'The email field is required.');
      done();
    });
  });

  it('Submit "Apply For Job" Form', (done) => {
    click(wrapper, '.apply-form-submit');

    moxios.stubOnce('post', '/apply-for-job', {
      status: 200,
      response: 'success',
    });

    moxios.wait(() => {
      see(wrapper, 'common.Send');
      expect(exceptionModule.state.error422.length).toBe(0);
      done();
    });
  });
});

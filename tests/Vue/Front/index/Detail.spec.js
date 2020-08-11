/* global describe beforeEach it see */
import { mount, createLocalVue, RouterLinkStub } from '@vue/test-utils';
import VueRouter from 'vue-router';
import Detail from '../../../../resources/assets/js/components/front/index/Detail.vue';

const localVue = createLocalVue();
localVue.use(VueRouter);

describe('Index Detail Page', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(Detail, {
      stubs: {
        'router-link': RouterLinkStub,
      },
      methods: {
        trans(key) {
          return key;
        },
      },
    });
  });

  it('shows "First start puff number" Link', () => {
    see(wrapper, 'common.first_start_puff_number');
  });

  it('shows "Frilans first umbrella company was founded"', () => {
    see(wrapper, 'common.Frilans_first_umbrella_company_was_founded');
  });

  it('shows "second start puff number" Link', () => {
    see(wrapper, 'common.second_start_puff_number');
  });
});

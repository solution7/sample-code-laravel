/* global describe beforeEach it see */
import { mount, createLocalVue } from '@vue/test-utils';
import Advantages from '../../../../resources/assets/js/components/front/index/Advantage.vue';
import svgIconComponent from '../../../../resources/assets/js/components/common/elements/SvgIcon.vue';

const localVue = createLocalVue();
localVue.component('svg-icon', svgIconComponent);

describe('Advantages', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(Advantages, {
      localVue,
      stubs: ['router-link', 'router-view'],
      methods: {
        trans(key) {
          return key;
        },
      },
    });
  });

  it('shows title', () => {
    see(wrapper, 'common.The_advantages_with_Frilans');
  });

  it('shows "get paid with in five" section', () => {
    see(wrapper, 'common.Get_paid_within_five');
  });

  it('shows "security" section', () => {
    see(wrapper, 'common.Security');
  });

  it('shows "personal service" section', () => {
    see(wrapper, 'common.Personal_service');
  });

  it('shows "fee" section', () => {
    see(wrapper, 'common.fee');
  });

  it('shows "personal service" section', () => {
    see(wrapper, 'common.Personal_service');
  });
});

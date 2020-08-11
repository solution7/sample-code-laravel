/* global describe beforeEach it see */
import { mount } from '@vue/test-utils';
import Instagram from '../../../../resources/assets/js/components/front/about/Instagram.vue';

describe('About Page Instagram', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(Instagram, {
      methods: {
        trans(key) {
          return key;
        },
      },
    });
  });

  it('shows Our umbrella contractors', () => {
    see(wrapper, 'about.Our_umbrella_contractors');
  });
  it('shows Follow on Instagram link', () => {
    see(wrapper, 'common.Follow_on_Instagram');
  });
});

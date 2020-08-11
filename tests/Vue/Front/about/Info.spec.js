/* global describe beforeEach it see */
import { mount } from '@vue/test-utils';
import Info from '../../../../resources/assets/js/components/front/about/Info.vue';

describe('About Page Info', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(Info, {
      methods: {
        trans(key) {
          return key;
        },
      },
    });
  });

  it('shows Frilans Finans Sweden largest', () => {
    see(wrapper, 'about.Frilans_Finans_Sweden_largest');
  });
});

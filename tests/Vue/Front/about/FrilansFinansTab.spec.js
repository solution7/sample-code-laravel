/* global describe beforeEach it see */
import { mount } from '@vue/test-utils';
import FrilansFinansTab from '../../../../resources/assets/js/components/front/about/FrilansFinansTab.vue';

describe('Frilans Finans Tab', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(FrilansFinansTab, {
      methods: {
        trans(key) {
          return key;
        },
      },
    });
  });

  it('shows "title"', () => {
    see(wrapper, 'about.About_Frilans');
  });

  it('shows "vision"', () => {
    see(wrapper, 'common.vision');
  });

  it('shows "believe people"', () => {
    see(wrapper, 'about.believe_people');
  });

  it('shows "In mid 1990"', () => {
    see(wrapper, 'about.In_mid_1990');
  });
});

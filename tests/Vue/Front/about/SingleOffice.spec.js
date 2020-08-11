/* global describe beforeEach it see */
import { mount } from '@vue/test-utils';
import SingleOffice from '../../../../resources/assets/js/components/front/about/SingleOffice.vue';

describe('Single Office', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(SingleOffice, {
      propsData: {
        country: 'sweden',
        number: '1',
      },
      methods: {
        trans(key) {
          return key;
        },
      },
    });
  });
  it('shows our office location', () => {
    see(wrapper, 'common.our_office_sweden_location');
  });

  it('shows our office contact number', () => {
    see(wrapper, 'common.our_office_sweden_email');
  });

  it('shows our office email', () => {
    see(wrapper, 'common.our_office_sweden_contact_number');
  });
});

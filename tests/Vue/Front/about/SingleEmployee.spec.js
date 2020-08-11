/* global describe beforeEach it see */
import { mount } from '@vue/test-utils';
import SingleEmployee from '../../../../resources/assets/js/components/front/about/SingleEmployee.vue';

describe('Single Employee', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(SingleEmployee, {
      propsData: {
        position: 'ceo',
      },
      methods: {
        trans(key) {
          return key;
        },
      },
    });
  });

  it('shows staff ceo name', () => {
    see(wrapper, 'staff.ceo_name');
  });

  it('shows staff ceo phone number', () => {
    see(wrapper, 'staff.ceo_phone_number');
  });

  it('shows staff ceo email', () => {
    see(wrapper, 'staff.ceo_email');
  });
});

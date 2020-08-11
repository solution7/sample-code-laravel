/* global describe beforeEach it see */
import { mount, createLocalVue } from '@vue/test-utils';
import OurOffices from '../../../../resources/assets/js/components/front/about/OurOffices.vue';

const localVue = createLocalVue();
localVue.use(Vuex);
localVue.prototype.trans = key => key;

describe('OurOffices', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(OurOffices, {
      localVue,
    });
  });

  it('shows Our offices title', () => {
    see(wrapper, 'about.Our_offices');
  });
  it('shows Frilans international organization', () => {
    see(wrapper, 'about.Frilans_international_organization');
  });
});

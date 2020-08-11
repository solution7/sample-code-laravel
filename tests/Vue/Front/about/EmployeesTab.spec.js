import { mount, createLocalVue } from '@vue/test-utils';
import EmployeesTab from '../../../../resources/assets/js/components/front/about/EmployeesTab.vue';
import commonModule from '../../../../resources/assets/js/store/modules/common';

const localVue = createLocalVue();
localVue.use(Vuex);
localVue.prototype.trans = key => key;

const store = new Vuex.Store({
  modules: {
    commonModule,
  },
});

describe('About Page EmployeesTab', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(EmployeesTab, {
      store,
      localVue,
    });
  });

  it('shows title', () => {
    see(wrapper, 'about.Employees_Finans');
  });
  it('shows Client support Tab', () => {
    see(wrapper, 'about.Client_support');
  });
  it('shows IT Tab', () => {
    see(wrapper, 'about.IT');
  });
  it('shows Finance and marketing Tab', () => {
    see(wrapper, 'about.Finance_and_marketing');
  });
  it('shows Management Tab', () => {
    see(wrapper, 'about.Management');
  });

  it('click "On Employees at Frilans Finans Tab"', () => {
    const tab = wrapper.find('a.tab-btn');
    tab.trigger('click');
    see(wrapper, 'about.The_administration_also_called');
    see(wrapper, 'about.The_IT_department');
    expect(wrapper.find('p.tab-3-content').exists()).toBe(true);
  });

  it('shows about page Client support image ', () => {
    see(wrapper, 'assets/images/ff_kontakt-2-1024x302.jpg');
  });

  it('shows about page It  tab image ', () => {
    see(wrapper, 'assets/images/ff_network-2-1024x452.jpg');
  });

  it('shows about page Finance and marketing image ', () => {
    see(wrapper, 'assets/images/ff_omoss2-1024x452.jpg');
  });
});

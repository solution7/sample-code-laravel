/* global describe beforeEach it see */
import { mount, createLocalVue, RouterLinkStub } from '@vue/test-utils';
import VueRouter from 'vue-router';
import OurNetwork from '../../../../resources/assets/js/components/front/index/OurNetwork.vue';

const localVue = createLocalVue();
localVue.use(VueRouter);

describe('Our Network', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(OurNetwork, {
      stubs: {
        'router-link': RouterLinkStub,
      },
      data() {
        return {
          locale() {
            return 'en';
          },
        };
      },
      methods: {
        trans(key) {
          return key;
        },
      },
    });
  });

  it('shows "Our Network for those who are umbrella', () => {
    see(wrapper, 'common.Our_Network_for_those_who_are_umbrella');
  });

  it('shows "Via our Network you have"', () => {
    see(wrapper, 'common.Via_our_Network_you_have');
  });
});

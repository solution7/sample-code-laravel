<template>
  <div class="left-Sidebar">
    <div class="page-trigger" id="pageTrigger" @click="menuTrigger">
      <p class="title">
        <a v-text="activeMenu"></a>
      </p>
    </div>
    <div class="my-page-inner mCustomScrollbar client-header">
      <div class="Page-wrraper">
        <div class="side-bar-top">
          <h5 v-text="trans('client.My_pages')"></h5>
          <ul>
            <li :class="{ active: isActive('ClientActivities', trans('client.Activities') ) }">
              <router-link :to="{name : 'ClientActivities'}" class="collapsed"
                v-text="trans('client.Activities')">
              </router-link>
            </li>
            <li class="parent-dropdown" :class="{ active: isActive('ClientEconomyInvoice') ||
              isActive('ClientEconomyDeduction') || isActive('ClientEconomyInvoiceTool') ||
              isActive('ClientEconomyContracts') || isActive('ClientSalaries') ||
              isActive('ClientPreregisteredOrders')}">
              <a class="collapse-example-eco"
                v-bind:class="{collapsed: !isActive('ClientEconomyInvoice') &&
                !isActive('ClientEconomyDeduction') && !isActive('ClientEconomyInvoiceTool') &&
                !isActive('ClientEconomyContracts') && !isActive('ClientSalaries') &&
                !isActive('ClientPreregisteredOrders')}">
                {{ trans('client.Economy') }}
                <span class="Down-angle-collapse"><i class="fa fa-angle-right"></i></span>
              </a>
              <ul class="custom-collapse hidden-content slide-up">
                <li :class="{ active: isActive('ClientEconomyInvoice', trans('client.Invoices'))}">
                  <router-link :to="{name : 'ClientEconomyInvoice'}"
                    v-text="trans('client.Invoices')">
                  </router-link>
                </li>
                <li v-if="salaryPageEnabled"
                  :class="{ active: isActive('ClientSalaries', trans('common.Salaries'))}">
                  <router-link :to="{name : 'ClientSalaries'}"
                    v-text="trans('common.Salaries')">
                  </router-link>
                </li>
                <li v-if="header.showContractsPage"
                  :class="{ active: isActive('ClientEconomyContracts', trans('client.Contracts'))}">
                  <router-link :to="{name : 'ClientEconomyContracts'}"
                    v-text="trans('client.Contracts')">
                  </router-link>
                </li>
                <li
                  :class="{ active: isActive('ClientEconomyDeduction', trans('client.Deduction'))}">
                  <router-link :to="{name : 'ClientEconomyDeduction'}"
                    v-text="trans('client.Deduction')">
                  </router-link>
                </li>
                <li :class="{ active: isActive('ClientEconomyInvoiceTool',
                  trans('client.Create_invoice'))}">
                  <router-link :to="{name : 'ClientEconomyInvoiceTool'}"
                    v-text="trans('client.Create_invoice')">
                  </router-link>
                </li>
                <li v-if="preregisterEnabled"
                  :class="{ active: isActive('ClientPreregisteredOrders',
                  trans('client.PreregisterInvoice'))}">
                  <router-link :to="{name : 'ClientPreregisteredOrders'}"
                    v-text="trans('client.PreregisterInvoice')">
                  </router-link>
                </li>
              </ul>
            </li>
            <li :class="{ active: isActive('ClientCustomerIndex', trans('client.My_customers')) ||
              isActive('ClientCustomerEditForm', trans('client.My_customers')) }">
              <router-link :to="{name :'ClientCustomerIndex'}"
                v-text="trans('client.My_customers')" class="collapsed">
              </router-link>
            </li>
            <li v-if="coworkersEnabled"
              :class="{ active: isActive('ClientCoworkers', trans('client.Coworkers')) }">
              <router-link :to="{name :'ClientCoworkers'}"
                v-text="trans('client.Coworkers')">
              </router-link>
            </li>
            <li class="parent-dropdown"
              :class="{ active: isActive('ClientPersonalInfo') || isActive('ClientBankInfo') ||
              isActive('ClientChangePassword') || isActive('ClientInvoiceSetting') }">
              <a class="collapse-example-eco"
                v-bind:class="{ collapsed: !isActive('ClientPersonalInfo') &&
                !isActive('ClientBankInfo') &&
                !isActive('ClientChangePassword') && !isActive('ClientInvoiceSetting') }"
                >
                {{ trans('client.Settings') }}
                <span class="Down-angle-collapse"><i class="fa fa-angle-right"></i></span>
              </a>
              <ul class="custom-collapse hidden-content slide-up">
                <li :class="{ active: isActive('ClientPersonalInfo',
                  trans('client.Personal_information'))}">
                  <router-link :to="{name : 'ClientPersonalInfo'}"
                    v-text="trans('client.Personal_information')">
                  </router-link>
                </li>
                <li :class="{ active: isActive('ClientBankInfo',
                  trans('client.Bank_information'))}">
                  <router-link :to="{name : 'ClientBankInfo'}"
                    v-text="trans('client.Bank_information')">
                  </router-link>
                </li>
                <li :class="{ active: isActive('ClientInvoiceSetting',
                  trans('client.Invoice_setting'))}">
                  <router-link :to="{name : 'ClientInvoiceSetting'}"
                    v-text="trans('client.Invoice_setting')">
                  </router-link>
                </li>
                <li :class="{ active: isActive('ClientChangePassword',
                  trans('common.Change_Password'))}">
                  <router-link :to="{name : 'ClientChangePassword'}"
                    v-text="trans('common.Change_Password')">
                  </router-link>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="side-bar-down">
          <ul>
            <li v-if="newsPageEnabled"
              :class="{ active: isActive('ClientNews', trans('client.News')) ||
              isActive('ClientCustomerEditForm', trans('client.News')) }">
              <router-link :to="{name :'ClientNews'}"
                v-text="trans('client.News')">
              </router-link>
            </li>
            <li
              :class="{ active: isActive('ClientInsurance', trans('client.Insurances')) }">
              <router-link :to="{name : 'ClientInsurance'}" class="collapsed"
                v-text="trans('client.Insurances')">
              </router-link>
            </li>
            <li :class="{ active: isActive('ClientActivitiesCalculator',
              trans('client.Calculator'))}">
              <router-link
                :to="{name : 'ClientActivitiesCalculator', params : {calculator:'calculator'}}"
                class="collapsed" v-text="trans('client.Calculator')">
              </router-link>
            </li>
            <li :class="{ active: isActive('ClientQuestionsAndAnswers',
              trans('client.Common_Question'))}">
              <router-link :to="{name : 'ClientQuestionsAndAnswers'}" class="collapsed"
                v-text="trans('client.Common_Question')">
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      activeMenu: '',
    };
  },
  computed: {
    header() {
      return this.$store.state.headerModule.header;
    },
    auth() {
      return this.$store.getters.auth;
    },
    activeLang() {
      const html = document.documentElement; // returns the html tag
      return html.getAttribute('lang');
    },
    preregisterEnabled() {
      return this.$store.state.headerModule.header.preregisterEnabled;
    },
    newsPageEnabled() {
      return this.$store.state.headerModule.header.newsPageEnabled;
    },
    salaryPageEnabled() {
      return this.$store.state.headerModule.header.salaryPageEnabled;
    },
    coworkersEnabled() {
      return this.$store.state.headerModule.header.coworkersEnabled;
    },
  },
  methods: {
    isActive(menuItem, menuName = null) {
      if (menuName !== null && this.$route.name === menuItem) {
        this.activeMenu = menuName;
      }

      return this.$route.name === menuItem;
    },
    menuTrigger() {
      const myPageInner = document.getElementsByClassName('my-page-inner')[0];
      const pageTrigger = document.getElementById('pageTrigger');
      myPageInner.classList.toggle('visible-now');

      if (myPageInner.classList.contains('visible-now')) {
        pageTrigger.classList.add('open-page-trigger');
      } else {
        pageTrigger.classList.remove('open-page-trigger');
      }
    },
    sideBarDropdown(initSidebarDropdown) {
      const elements = document.querySelectorAll('a.collapse-example-eco');
      const childElements = document.getElementsByClassName('hidden-content');
      const parentElements = document.querySelectorAll('.parent-dropdown');

      if (initSidebarDropdown) {
        elements.forEach((element, key) => {
          element.addEventListener('click', () => {
            childElements[key].classList.toggle('slide-down');
            childElements[key].classList.toggle('slide-up');
            element.classList.toggle('collapsed');
          });
        });
      }
      this.setActiveDropdown(parentElements, childElements, elements);
    },

    setActiveDropdown(parentElems, childElems, elems) {
      parentElems.forEach((parentElem, key) => {
        if (parentElem.classList.contains('active')) {
          childElems[key].classList.add('slide-down');
          childElems[key].classList.remove('slide-up');
          elems[key].classList.remove('collapsed');
        } else {
          childElems[key].classList.remove('slide-down');
          childElems[key].classList.add('slide-up');
          elems[key].classList.add('collapsed');
        }
      });
    },
  },
  watch: {
    activeMenu() {
      const myPageInner = document.getElementsByClassName('my-page-inner')[0];
      const pageTrigger = document.getElementById('pageTrigger');

      if (myPageInner.classList.contains('visible-now')) {
        myPageInner.classList.remove('visible-now');
        pageTrigger.classList.remove('open-page-trigger');
      }
    },
  },
  mounted() {
    this.$nextTick(() => {
      this.sideBarDropdown('initSidebarDropdown');
    });
  },
  updated() {
    this.$nextTick(() => {
      this.sideBarDropdown();
    });
  },
};
</script>

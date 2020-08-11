<template>
    <div class="inner-section">
        <div class="activites-page">
         <div class="name-client-sec">
            <h5 class="text-size-20 main-heading">
              <span v-text="trans('client.Hello')"></span>
              <span v-text="loggedInUser.first_name+','"></span>
              <span v-text="trans('client.what_do_you_want')"></span>
            </h5>
            <div class="list-create">
              <ul>
                 <li v-if="activitiesActionOrder == 'INVOICE_FIRST'">
                    <router-link :to="{name : 'ClientEconomyInvoiceTool'}">
                      <span class="minsize" v-text="trans('client.Create_invoice_quote')"></span>
                      <svg-icon :icon="'right-arrow-circle'" :attr="svgAttr"> </svg-icon>
                    </router-link>
                 </li>
                 <li v-if="trans('client.Create_tender_link')">
                    <a target="_blank"
                      :href="trans('client.Create_tender_link')" >
                      <span class="minsize"  v-text="trans('client.Create_tender')"></span>
                      <svg-icon :icon="'right-arrow-circle'" :attr="svgAttr"> </svg-icon>
                    </a>
                 </li>
                 <li v-if="trans('client.Write_a_contract_link')">
                    <a target="_blank"
                      :href="trans('client.Write_a_contract_link')">
                      <span class="minsize"  v-text="trans('client.Write_a_contract')"></span>
                      <svg-icon :icon="'right-arrow-circle'" :attr="svgAttr"> </svg-icon>
                    </a>
                 </li>
                 <li v-if="activitiesActionOrder == 'INVOICE_LAST'">
                    <router-link :to="{name : 'ClientEconomyInvoiceTool'}">
                      <span class="minsize" v-text="trans('client.Create_invoice_quote')"></span>
                      <svg-icon :icon="'right-arrow-circle'" :attr="svgAttr"> </svg-icon>
                    </router-link>
                 </li>
              </ul>
            </div>
         </div>
         <current-errands-component :invoicelist="activities">
         </current-errands-component>
         <vacation-component v-if="showVacationAmountSection"></vacation-component>
         <div id="simulator-container">
            <simulator-component :client-view="true"></simulator-component>
         </div>
      </div>
    </div>
</template>

<style scoped>
@media screen and (min-width:767px) {
  .inner-section .vue-slider-always{
    margin-left: -60px !important;
  }

  .inner-section .diy-tooltip {
    font-size: 22px !important;
  }
  .inner-section .drag-btn-right {
    left: 128px !important;
  }
  .inner-section .drag-btn-left {
    top: 5px !important;
    left: 12px !important
  }
}
.right-arrow-circle-icon {
  vertical-align: middle;
}

</style>
<script>

import CurrentErrandsComponent from './CurrentErrands.vue';
import VacationComponent from './Vacation.vue';
import SimulatorComponent from './../../../front/simulator/Simulator.vue';

export default {
  name: 'ClientActivities',

  data() {
    return {
      svgAttr: {
        class: 'icon-blue',
        width: 25,
      },
    };
  },
  computed: {
    activities() {
      return this.$store.state.clientModule.activities;
    },
    activitiesActionOrder() {
      return this.$store.state.headerModule.header.activitiesActionOrder;
    },
    showVacationAmountSection() {
      return this.$store.state.headerModule.header.showVacationAmountSection;
    },
    loggedInUser() {
      return this.$store.state.authModule.loggedInUser;
    },
  },
  beforeCreate() {
    this.$store.dispatch('GET_CLIENT_ACTIVITIES');
    this.$store.commit('RESET_ERROR_422');
    this.$store.commit('SET_CALC_SCROLL_ENABLE');
    this.$store.commit('setSliderWidth', 155);
  },
  components: {
    'current-errands-component': CurrentErrandsComponent,
    'simulator-component': SimulatorComponent,
    'vacation-component': VacationComponent,
  },
  watch: {
    $route(to) {
      if (to.params.calculator) scrollToMe('#simulator-container');
    },
  },
  updated() {
    if (this.$route.name === 'ClientActivitiesCalculator' && this.$store.state.clientModule.calcScroll) {
      scrollToMe('#simulator-container');
    }
  },
};
</script>

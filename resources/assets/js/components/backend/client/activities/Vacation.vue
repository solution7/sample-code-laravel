<template>
  <div class="card-section">
    <h2 v-text="trans('client.Pension_and_vacation')"></h2>
    <div class="card-content">
    <div class="vaction-pay-icon">
      <svg-icon :icon="'sun'" :attr="{ width: 60, class: 'icon-blue' }"> </svg-icon>
    </div>
    <div class="content-vaction">
      <h3>
        {{ vacationPay.amount || 0 | roundFilter(0)}}
        {{ vacationPay.currency || defaultCurrency }}
      </h3>
      <h5 v-text="trans('client.Saved_vacation')"></h5>
      <router-link :to="{ name :'ClientInvoiceSetting'}">
        <span v-text="trans('client.Change_settings')"></span>
      </router-link>
    </div>
    </div>
  </div>
</template>

<style scoped>
.card-section {
    border: 0;
    margin:30px 0 0;
}

.vaction-pay-icon {
  display: inline-block;
  vertical-align: middle;
  margin-right: 20px;
}

.card-section h5 {
  font-size: 14px;
  margin: 5px 0;
  margin-top: 5px;
  font-weight: normal;
}

.card-section h2 {
  font-size: 18px;
}
</style>

<script>

import RoundFilter from '../../../../filters/roundFilter';

export default {
  computed: {
    vacationPay() {
      return this.$store.state.clientModule.vacationPay;
    },
    defaultCurrency() {
      return this.$store.state.simulatorModule.calculator.currency;
    },
  },
  filters: {
    RoundFilter,
  },
  beforeCreate() {
    this.$store.dispatch('GET_CLIENT_VACATION_PAY');
    this.$store.commit('RESET_ERROR_422');
  },
};
</script>

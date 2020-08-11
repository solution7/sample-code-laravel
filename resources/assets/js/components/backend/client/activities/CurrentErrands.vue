<template>
  <div>
    <div class="customer-data-salary">
      <h5 class="text-size-20 main-heading" v-text="trans('client.Your_errands')"></h5>
      <div v-if="invoicelist.data && invoicelist.data.length">
        <div class="unapporved-sec" v-for="(invoice, key) in invoicelist.data" :key="key">
          <div class='row'>
            <div class="col-lg-3 col-md-12">
              <div class="customer-Content">
                <div class="media">
                  <div class="media-body media-custom-content">
                    <h4 v-text="invoice.customer_name"></h4>
                    <p v-text="trans('client.Created') + ' ' + moment(invoice.created_at)"></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-9 col-md-12">
              <div class="customer-content-right">
                <ul>
                  <li>
                    <span v-if="isApproved(invoice)" class="icon-check">
                      <i class="fa fa-check"></i>
                    </span>
                    <span v-else>1</span>
                    <strong v-text="trans('client.Status')"></strong><br>
                    <label v-text="invoiceStatusFontStyle(invoice)"></label>
                  </li>
                  <li>
                    <span v-if="invoice.paid_at" class="icon-check">
                      <i class="fa fa-check"></i>
                    </span>
                    <span v-else >2</span>
                    <strong v-text="trans('client.Salary_payment')"></strong><br>
                    <template v-if="invoice.paid_at">
                      <label v-text="trans('client.Paid') + ' ' + moment(invoice.paid_at)">
                      </label>
                    </template>
                  </li>
                  <li>
                    <span v-if="invoice.paid_at" class="icon-check">
                      <i class="fa fa-check"></i>
                    </span>
                    <span v-else v-text="3"></span>
                    <strong v-text="trans('client.Invoice_payment')"></strong><br>
                    <template v-if="invoice.paid_at">
                      <label v-text="trans('client.Paid') + ' ' + moment(invoice.paid_at)">
                      </label>
                    </template>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <pagination :data="invoicelist" v-on:pagination-change-page="fetchData" class="pull-right">
        </pagination>
      </div>
      <div v-else >
        <div class="empty-result" v-text="trans('client.NoInvoicesForTheSelectedPeriod')"></div>
      </div>
    </div>
  </div>
</template>
<style scoped>
@media (max-width: 585px){
  .empty-result {
    margin: 10px;
  }
}
</style>
<script>
export default {
  props: ['invoicelist'],
  methods: {
    isApproved(invoice) {
      return ['approved', 'approved with a mark'].includes(invoice.order_status_type_name);
    },
    invoiceStatusFontStyle(invoice) {
      const status = invoice.order_status_type_name.replace(/\s/g, '');
      return trans(`client.${status}`);
    },
    fetchData(page) {
      this.$store.commit('SET_CALC_SCROLL_DISABLE');
      scrollToMe('.customer-data-salary');
      this.$store.dispatch('GET_CLIENT_ACTIVITIES', page);
    },
  },
};
</script>

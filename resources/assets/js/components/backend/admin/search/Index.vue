<template>
  <div class="main-content">
    <div class="main-content-top">
      <div class="search-content">
        <label v-text="trans('common.Search')"></label>
        <form v-on:keydown.enter.prevent="search" >
          <div class="input-group">
            <input type="text" class="form-control searchInput"
              :placeholder="trans('common.TypeToSearch')" v-model="searchInput.query"/>
            <div class="search-btn input-group-addon addSec"
              @click="search" v-text="trans('common.Search') + '!'">
            </div>
          </div>
        </form>
        <div class="search-Table">
          <div class="table-responsive"
            v-if="(result.customers && result.customers.data && result.customers.data.length) ||
                  (result.invoices && result.invoices.data && result.invoices.data.length) ||
                  (result.clients && result.clients.data && result.clients.data.length)">
            <!-- Client list Start-->
            <table class="table custom-table table-bordered"
              v-if="result.clients && result.clients.data && result.clients.data.length">
              <tbody>
                <tr>
                  <th v-text="trans('common.Client')"></th>
                  <th v-text="trans('client.CivicNum')"></th>
                  <th v-text="trans('client.City')"></th>
                  <th v-text="trans('client.ClientId')"></th>
                </tr>
                <tr v-for="(client, key) in result.clients.data" :key="key">
                  <td>
                    <router-link
                      :to="{ name :'ClientInfo', params : { id : client.id}}"
                      class="backend-link">
                      <span v-text="`${client.profile.first_name} ${client.profile.last_name}`">
                      </span>
                    </router-link>
                  </td>
                  <td v-text="client.profile.identity_data"></td>
                  <td v-text="client.profile.city"></td>
                  <td v-text="client.id"></td>
                </tr>
              </tbody>
              </table>
              <pagination :data="result.clients"
                v-on:pagination-change-page="fetchClients" class="pull-right">
              </pagination>
            <!-- End Client list -->

            <!-- Customer list Start-->
            <table class="table custom-table table-bordered"
              v-if="result.customers && result.customers.data && result.customers.data.length">
              <tbody>
                <tr>
                  <th v-text="trans('common.Customer')"></th>
                  <th v-text="trans('common.VATNR')"></th>
                  <th v-text="trans('common.City')"></th>
                  <th v-text="trans('common.CustomerId')"></th>
                </tr>
                <tr v-for="(customer, key) in result.customers.data" :key="key">
                  <td>
                    <router-link :to="{name: 'CustomerInfo' , params: {id: customer.id }}"
                      class="backend-link" v-text="customer.name">
                    </router-link>
                  </td>
                  <td v-text="customer.vat_number"></td>
                  <td v-text="customer.city"></td>
                  <td v-text="customer.id"></td>
                </tr>
              </tbody>
            </table>
            <pagination :data="result.customers"
              v-on:pagination-change-page="fetchCustomers" class="pull-right">
            </pagination>
            <!-- End Customer list -->

            <!-- Start Invoice list -->
            <table class="table custom-table table-bordered"
              v-if="result.invoices && result.invoices.data && result.invoices.data.length">
              <tbody>
                <tr>
                  <th v-text="trans('common.Invoices')"></th>
                  <th v-text="trans('common.Client')"></th>
                  <th v-text="trans('common.Customer')"></th>
                  <th v-text="trans('common.Status')"></th>
                </tr>
                <tr v-for="(invoice, key) in result.invoices.data" :key="key">
                  <td v-text="invoice.id"></td>
                  <td>
                    <router-link
                      :to="{ name :'ClientInfo', params : { id : invoice.user_id}}"
                      class="backend-link">
                      <span v-if="invoice.first_name" v-text="invoice.first_name"></span>
                      <span v-if="invoice.last_name" v-text="invoice.last_name"></span>
                    </router-link>
                  </td>
                  <td>
                    <router-link
                      :to="{ name :'CustomerInfo', params : { id : invoice.customer_id}}"
                      class="backend-link">
                      <span v-text="invoice.customer_name"></span>
                    </router-link>
                  </td>
                  <td v-text="invoice.order_status_type_name"></td>
                </tr>
              </tbody>
            </table>
            <pagination :data="result.invoices"
              v-on:pagination-change-page="fetchInvoices" class="pull-right">
            </pagination>

            <!-- End Invoice list -->
          </div>
          <h4 v-else>
            <span v-if="result.clients || result.invoices || result.customers"
              v-text="trans('common.NoResultFound')">
            </span>
          </h4>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Search',

  computed: {
    searchInput() {
      return this.$store.state.adminModule.searchInput;
    },
    result() {
      return this.$store.state.adminModule.results;
    },
  },
  beforeCreate() {
    this.$store.commit('RESET_SEARCH_PAGE');
  },
  methods: {
    async search() {
      this.$store.dispatch('GET_SEARCH', { query: this.searchInput.query });
    },
    fetchClients(page = 1) {
      this.$store.dispatch('GET_SEARCH_CLIENTS', { query: this.searchInput.query, page }).then(() => {
        this.$store.dispatch('HANDLE_SEARCH_REQUEST_SUCCESS');
      });
    },
    fetchCustomers(page = 1) {
      this.$store.dispatch('GET_SEARCH_CUTOMERS', { query: this.searchInput.query, page }).then(() => {
        this.$store.dispatch('HANDLE_SEARCH_REQUEST_SUCCESS');
      });
    },
    fetchInvoices(page = 1) {
      this.$store.dispatch('GET_SEARCH_INVOICES', { query: this.searchInput.query, page }).then(() => {
        this.$store.dispatch('HANDLE_SEARCH_REQUEST_SUCCESS');
      });
    },
  },
};
</script>

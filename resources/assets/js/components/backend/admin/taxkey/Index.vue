<template>
  <div class="main-content">
    <div class="content-sec">
      <div class="taxInfo">
        <div class="tex-key-table">
          <div class="title-main">
            <h2 v-text="trans('common.TaxKeys')"></h2>
          </div>
          <div class="tax-setting-btn">
            <ul>
              <li>
                <button class="customBtn" @click.prevent="addKey =! addKey">
                  <span v-if="addKey" v-text="trans('common.remove_tax_key')"></span>
                  <span v-else v-text="trans('common.add_tax')"></span>
                </button>
              </li>
              <li v-if="addKey">
                <button class="customBtn" @click="saveform()"
                  v-text="trans('common.SAVE_CHANGES')">
                </button>
              </li>
            </ul>
          </div>
          <div class="table-responsive">
            <div class="col-lg-12">
              <div class="clientInfo" v-if="addKey">
                <form class="customForm" @submit.prevent='saveform()'>
                  <input type="hidden" v-model="key.id">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="custom-input-label"
                          for="name" v-text="trans('common.Name')">
                        </label>
                        <input type="text" v-model="key.name"
                          class="form-control custom-field-form custom-feild-control"
                          :placeholder="trans('common.Name')"
                        />
                        <error-component
                          class="errors"
                          :errors="errors.name">
                        </error-component>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="custom-input-label"
                          for="value" v-text="trans('common.Value')">
                        </label>
                        <input type="text" v-model="key.value"
                          class="form-control custom-field-form custom-feild-control"
                          :placeholder="trans('common.Value')"
                        />
                        <error-component
                          class="errors"
                          :errors="errors.value">
                        </error-component>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="custom-input-label"
                          for="fee" v-text="trans('common.FrilansFeePercentage')">
                        </label>
                        <input type="text" v-model="key.fee"
                          class="form-control custom-field-form custom-feild-control"
                          :placeholder="trans('common.Value')"
                        />
                        <error-component
                          class="errors"
                          :errors="errors.fee">
                        </error-component>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="custom-input-label"
                          for="tax" v-text="trans('common.tax_percentage')">
                        </label>
                        <input id="tax" type="text" v-model="key.tax"
                          class="form-control custom-field-form custom-feild-control"
                          :placeholder="trans('common.Value')"
                        />
                        <error-component
                          class="errors"
                          :errors="errors.tax">
                        </error-component>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="custom-input-label" for="payroll_tax"
                          v-text="trans('common.payroll_tax_percentage')">
                        </label>
                        <input type="text" v-model="key.payroll_tax"
                          id="payroll_tax"
                          class="form-control custom-field-form custom-feild-control"
                          :placeholder="trans('common.Value')"
                        />
                        <error-component
                          class="errors"
                          :errors="errors.payroll_tax">
                        </error-component>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="custom-input-label"
                          for="visibility" v-text="trans('common.Visibility')">
                        </label>
                        <select class="form-control custom-select" v-model="key.visibility">
                          <option value="0" v-text="trans('common.None')"></option>
                          <option value="1" v-text="trans('common.All')"></option>
                        </select>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <template v-if="taxKeys.data">
              <table class="table custom-table table-bordered">
                <tbody>
                  <tr>
                    <th width="20%">
                      <div class="tble_dte" v-text="trans('common.TaxKeys')"></div>
                    </th>
                    <th width="20%" v-text="trans('common.PublicName')"></th>
                    <th width="20%" v-text="trans('common.Value')"></th>
                    <th width="20%" v-text="trans('common.FrilansFee')"></th>
                    <th width="20%" v-text="trans('common.Visibility')"></th>
                  </tr>
                  <tr v-for="(taxKey, index) in taxKeys.data" :key="taxKey.id">
                    <td v-text="taxKeys.from + index "></td>
                    <td v-text="taxKey.name"></td>
                    <td v-text="taxKey.value"></td>
                    <td v-text="taxKey.fee"></td>
                    <td>
                      <span v-if="taxKey.visibility == 0" v-text="trans('common.None')"></span>
                      <span v-else v-text="trans('common.All')"></span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination :data="taxKeys"
              v-on:pagination-change-page="fetchData" class="pull-right">
              </pagination>
            </template>
            <h2 v-else v-text="trans('common.NoTaxKeyFound')"></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Taxkey',

  computed: {
    errors() {
      return this.$store.state.exceptionModule.error422;
    },
    taxKeys() {
      return this.$store.state.taxKeyModule.taxKeys;
    },
    key() {
      return this.$store.state.taxKeyModule.key;
    },
    addKey: {
      get() {
        return this.$store.state.taxKeyModule.addKey;
      },
      set(value) {
        return this.$store.commit('SET_ADD_KEY_VALUE', { value });
      },
    },
  },
  beforeCreate() {
    this.$store.commit('RESET_ADD_TAXKEY_FORM');
    this.$store.dispatch('GET_TAXKEY_DATA');
  },
  methods: {
    saveform() {
      this.$store.dispatch('STORE_TAXKEY', { app: this });
    },
    taxKeyValue(value) {
      return Number.parseFloat(value).toFixed(4);
    },
    fetchData(page) {
      this.$store.dispatch('GET_TAXKEY_DATA', page);
    },
  },
  watch: {
    addKey(v) {
      if (!v) this.$store.commit('RESET_ADD_KEY_VALUE');
      this.$store.commit('RESET_ERROR_422');
    },
  },
};
</script>

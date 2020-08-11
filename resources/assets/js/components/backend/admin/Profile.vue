<template>
  <div class="main-content">
    <div class="content-sec">
      <div class="clientInfo">
        <div class="row">
          <div class="col-lg-12">
            <div class="title-main">
              <h2 v-text="trans('common.PersonalInformation')"></h2>
              <h4 v-text="trans('common.HereYouCanChange')"></h4>
            </div>
          </div>
          <div class="col-lg-12">
            <form @submit.prevent="saveform()">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="custom-input-label" v-text="trans('common.First_Name')"></label>
                    <input :placeholder="trans('common.First_Name')"
                      class="form-control custom-field-form custom-feild-control"
                      v-model="profile.first_name" type="text"
                    />
                  </div>
                  <error-component block :errors="errors.first_name">
                  </error-component>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="custom-input-label" v-text="trans('common.Last_Name')"></label>
                    <input :placeholder="trans('common.Last_Name')"
                      v-model="profile.last_name"
                      class="form-control custom-field-form custom-feild-control" type="text"
                    />
                  </div>
                  <error-component block :errors="errors.last_name">
                  </error-component>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="custom-input-label" v-text="trans('common.Email')"></label>
                    <input :placeholder="trans('common.Email')"  v-model="profile.email"
                      class="form-control custom-field-form custom-feild-control" type="email"
                    />
                  </div>
                  <error-component block :errors="errors.email">
                  </error-component>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="custom-input-label" v-text="trans('common.Address')"></label>
                    <input :placeholder="trans('common.Address')" v-model="profile.address"
                      id="autocomplete"
                      class="form-control custom-field-form custom-feild-control" type="text"
                    />
                  </div>
                  <error-component block :errors="errors.address">
                  </error-component>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="custom-input-label" v-text="trans('common.PostalCode')"></label>
                    <input :placeholder="trans('common.PostalCode')" v-model="profile.postal_code"
                      id="postal_code"
                      class="form-control custom-field-form custom-feild-control" type="text"
                    />
                  </div>
                  <error-component block :errors="errors.postal_code">
                  </error-component>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="custom-input-label" v-text="trans('common.City')"></label>
                    <input :placeholder="trans('common.City')" id="locality"
                      v-model="profile.city"
                      class="form-control custom-field-form custom-feild-control" type="text"
                    />
                  </div>
                  <error-component block :errors="errors.city">
                  </error-component>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group" style="width: 100%;">
                    <label class="custom-input-label" v-text="trans('common.Country')"></label>
                    <select class="form-control custom-select country-sel" id="country"
                      @change="selectCountry($event)">
                      <option v-for="country in countries" :key="country.id"
                        :selected="profile.country == country.name"
                        :value="country.id" :data-name="country.name"
                        v-text="country.name">
                      </option>
                      <option></option>
                    </select>
                  </div>
                  <error-component block :errors="errors.country_id">
                  </error-component>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="custom-input-label" v-text="trans('common.CivicNumber')"></label>
                    <input :placeholder="trans('common.CivicNumber')"
                      class="form-control custom-field-form custom-feild-control"
                      v-model="profile.identity_data" type="text"
                    />
                  </div>
                  <error-component block :errors="errors.identity_data">
                  </error-component>
                </div>
              </div>
              <div class="form-group">
                <div class="frm_btns">
                  <button class="btn btn-primary" v-text="trans('common.UpdateSettings')"></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

export default{
  name: 'AdminProfile',

  computed: {
    profile() {
      return this.$store.state.profileModule.profile;
    },
    countries() {
      return this.$store.state.commonModule.countries;
    },
    errors() {
      return this.$store.state.exceptionModule.error422;
    },
  },
  beforeCreate() {
    this.$store.commit('RESET_ERROR_422');
    this.$store.dispatch('GET_ADMIN_PROFILE');
    this.$store.dispatch('GET_COUNTRIES');
  },
  methods: {
    selectCountry(event) {
      const el = event.target;
      this.profile.address_country_id = el.value;
      this.profile.country = el.options[el.selectedIndex].getAttribute('data-name');
    },
    saveform() {
      this.$store.dispatch('UPDATE_ADMIN_PROFILE', { profileData: this.profile });
    },
  },
};
</script>

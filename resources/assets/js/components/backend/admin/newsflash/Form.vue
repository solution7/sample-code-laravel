<template>
  <div class="main-content">
    <div class="content-sec">
      <div class="content-group backend-news-flash">
        <div class="row">
          <div class="col-lg-12">
            <div class="title-main">
              <h2 v-text="trans('common.news_flash')"></h2>
            </div>
          </div>
        </div>
        <form @submit.prevent="saveform()">
          <div class="row">
            <div class="col-sm-12 m-t-md">
              <div class="form-group checkbox-term">
                <input id="acceptTerms" type="checkbox" true-value="1" false-value="0"
                  v-model="newsFlash.enabled"
                >
                <label for="acceptTerms" class="labl-terms">
                  <label></label>
                  <span></span>
                  <label class="custom-input-label" v-text="trans('inputfields.Enabled')"></label>
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="" class="custom-input-label" v-text="trans('inputfields.Subject')">
                </label>
                <input type="text" class="form-control custom-field-form custom-feild-control"
                  v-model="newsFlash.subject"
                >
                <error-component class="errors" :errors="errors.subject">
                </error-component>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="" class="custom-input-label"
                  v-text="trans('inputfields.Description')">
                </label>
                <textarea type="text" class="form-control custom-field-form custom-feild-control"
                  rows="5" v-model="newsFlash.description">
                </textarea>
                <error-component class="errors" :errors="errors.description">
                </error-component>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <button class="btn btn-primary" @click="saveform"
                v-text="trans('common.SAVE_CHANGES')" type="button">
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NewsFlash',

  computed: {
    errors() {
      return this.$store.state.exceptionModule.error422;
    },
    newsFlash() {
      return this.$store.state.adminModule.newsFlash;
    },
  },
  beforeCreate() {
    this.$store.commit('RESET_ERROR_422');
    this.$store.dispatch('GET_NEWS_FLASH');
  },
  methods: {
    saveform() {
      this.$store.dispatch('STORE_NEWS_FLASH', this.newsFlash);
    },
  },
};
</script>

<template>
  <div>
    <section class="insurances-tabs">
      <div class="container logged-in-container">
        <div class="tabs custom-tabs">
          <div class="tab-selector" @click="selectList($event)">
            <div id="selected-tab"
              value="frilans-finans-basic"
              v-text="trans('services.Frilans_Finans_Basic')">
            </div>
            <div class="pull-right">
              <i id="selected-tab-icon" class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
            </div>
          </div>
          <ul class="nav nav-pills">
            <li class="active tab-li">
              <a :class="tabClass"
                @click="changeTab({ e: $event, mapper: 'frilans-finans-basic' })"
                data-toggle="pill"
                href="#frilans-finans-basic"
                v-text="trans('services.Frilans_Finans_Basic')" >
              </a>
            </li>
            <li class="tab-li">
              <a :class="tabClass"
                @click="changeTab({ e: $event, mapper: 'frilans-extra' })"
                data-toggle="pill"
                href="#frilans-extra"
                v-text="trans('services.Frilans_Extra')">
              </a>
            </li>
            <li class="tab-li">
              <a :class="tabClass"
                @click="changeTab({ e: $event, mapper: 'frilans-travel' })"
                data-toggle="pill"
                href="#frilans-travel"
                v-text="trans('services.Frilans_Travel')" >
              </a>
            </li>
          </ul>
          <div class="tab-content insurance-tab-content">
            <div id="frilans-finans-basic" class="tab-pane custom-ul-list fade in active"
            v-html="trans('services.Tab_1_description')">
            </div>
            <div id="frilans-extra" class="tab-pane custom-ul-list fade">
              <p v-html="trans('services.Tab_2_description')"></p>
            </div>
            <div id="frilans-travel" class="tab-pane custom-ul-list fade">
              <p v-html="trans('services.Tab_3_description')"></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { mapActions } from 'vuex';

export default {
  computed: {
    tabClass() {
      return (this.$route.name === 'Insurance') ? 'tab-btn' : 'tabs-btn';
    },
  },
  methods: {
    ...mapActions([
      'selectList',
      'changeTab',
    ]),
  },
};
</script>

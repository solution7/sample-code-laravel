<template>
  <div>
    <main-banner-component :my-banner="banner"></main-banner-component>
    <detail-component></detail-component>
    <simulator-component></simulator-component>
    <div class="pointer-divider"></div>
    <works-flow-component :workflow="workflow"></works-flow-component>
    <testimonial-slider-component></testimonial-slider-component>
    <advantage-component></advantage-component>
    <our-network-component v-if="networkEnabled"></our-network-component>

   <div class="row">
    <div class="modal fade" id="addInfo" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" data-backdrop="static"
     data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content add-padding">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body link-modal-content">
            <div class="modal-head-text">
              <h5 v-text="trans('client.add_information')"></h5>
            </div>
            <form class="form-control-group" @submit.prevent>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" value=""
                     id="firstName">
                    <label class="input__label--style" v-text="trans('inputfields.FirstName')"
                     for="firstName"></label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" value=""
                     id="lastName">
                    <label class="input__label--style" v-text="trans('inputfields.LastName')"
                     for="lastName"></label>
                 </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" id="mobilePhone">
                    <label class="input__label--style" v-text="trans('client.mobile_phone')"
                     for="mobilePhone"></label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" id="civicNumber">
                    <label class="input__label--style" v-text="trans('client.CivicNumber')"
                     for="civicNumber"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" value="" id="email">
                    <label class="input__label--style" v-text="trans('inputfields.Email')"
                      for="email"></label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" id="profession">
                    <label class="input__label--style" v-text="trans('inputfields.Profession')"
                     for="profession"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="password" class="form-control input__field--style" id="password">
                    <label class="input__label--style" v-text="trans('inputfields.Password')"
                     for="password">
                    </label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="password" class="form-control input__field--style"
                     id="repeatPassword">
                    <label class="input__label--style" for="repeatPassword"
                      v-text="trans('inputfields.RepeatPassword')">
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" id="street">
                    <label class="input__label--style" v-text="trans('client.Street')" for="street">
                    </label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" id="co">
                    <label class="input__label--style" v-text="trans('client.CO')" for="co">
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-group-style input input--style">
                        <input type="text" class="form-control input__field--style" id="zipCode">
                         <label class="input__label--style" v-text="trans('client.Zip_Code')"
                          for="zipCode"></label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group form-group-style input input--style">
                        <input type="text" class="form-control input__field--style" id="city">
                        <label class="input__label--style" v-text="trans('client.City')" for="city">
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                 <div class="form-group form-group-style select-custom-icon">
                    <label v-text="trans('client.Country')">
                    </label>
                    <select class="form-control">
                      <option v-text="'--'+trans('client.None')+'--'"></option>
                      <option v-for="(country, key) in header.countries" v-bind:value="country.id"
                      v-text="trans('common.'+country.name.replace(/\s/g, ''))" :key="key"></option>
                    </select>
                 </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-style input input--style">
                    <input type="text" class="form-control input__field--style" id="bank">
                    <label class="input__label--style" v-text="trans('client.Bank')" for="bank">
                    </label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="button-modal-link">
                    <button class="btn btn-primary" v-text="trans('common.create_account')">
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
   </div>
  </div>
</template>

<script>

import SimulatorComponent from './simulator/Simulator.vue';
import BannerComponent from './common/Banner.vue';
import DetailComponent from './index/Detail.vue';
import WorkFlowComponent from './common/WorkFlow.vue';
import TestimonialSliderComponet from './common/TestimonialSlider.vue';
import AdvantageComponet from './index/Advantage.vue';
import OurNetworkComponet from './index/OurNetwork.vue';

export default {
  data() {
    return {
      banner: {
        class: 'start-page-hero',
        bgImg: 'background-image: url(assets/images/ff_lisaa-11-1.jpg)',
        htext: window.trans('common.home_title'),
        link: {
          to: 'HowItWorks',
          text: window.trans('common.this_is_how_it_works'),
        },
      },
      workflow: {
        title: trans('common.landing_page_work_flow_title'),
        step_1: {
          image: trans('images_link.landing_page_work_flow_step1_image_link'),
          title: trans('common.landing_page_work_flow_step1_title'),
          description: trans('common.landing_page_work_flow_step1_description'),
        },
        step_2: {
          image: trans('images_link.landing_page_work_flow_step2_image_link'),
          title: trans('common.landing_page_work_flow_step2_title'),
          description: trans('common.landing_page_work_flow_step2_description'),
        },
        step_3: {
          image: trans('images_link.landing_page_work_flow_step3_image_link'),
          title: trans('common.landing_page_work_flow_step3_title'),
          description: trans('common.landing_page_work_flow_step3_description'),
        },
      },
    };
  },
  components: {
    'simulator-component': SimulatorComponent,
    'main-banner-component': BannerComponent,
    'detail-component': DetailComponent,
    'works-flow-component': WorkFlowComponent,
    'testimonial-slider-component': TestimonialSliderComponet,
    'advantage-component': AdvantageComponet,
    'our-network-component': OurNetworkComponet,
  },
  computed: {
    networkEnabled() {
      return this.$store.state.headerModule.header.networkEnabled;
    },
    header() {
      return this.$store.state.headerModule.header;
    },
  },
  mounted() {
    const app = this;
    app.$nextTick(() => {
      functions.initPlaceholderEffect();
    });
    $('#addInfo').modal('show');
    app.$store.dispatch('LOAD_HEADER_DATA');
  },
};
</script>

<template>
  <div :class="{'inner-section edit-custmor-sec-inner': this.$route.name === 'ClientInsurance' }">
    <div class="insurances-page">
      <banner-component :banner="banner"></banner-component>
      <info-component></info-component>
      <detail-tab-component></detail-tab-component>
      <letters-component v-if="insuranceLinkEnabled
        && this.$route.name === 'Insurance'">
      </letters-component>
      <contact-form-component type="insurance"
        v-if="this.$route.name === 'ClientInsurance'"
        :title="trans('help.Do_you_have_more_questions')">
      </contact-form-component>
      <contactus-form-component v-else type="insurance"
        :title="trans('help.Do_you_have_more_questions')">
      </contactus-form-component>

      <common-question-component v-if="insurancePageQuestionSectionEnabled">
      </common-question-component>
    </div>
  </div>
</template>
<script>
import BannerComponent from './../front/common/Banner.vue';
import InfoComponent from './insurance/Info.vue';
import DetailTabComponent from './insurance/DetailTab.vue';
import LettersComponent from './insurance/Letters.vue';
import CommonQuestionComponent from './../front/common/Questions.vue';
import ContactForm from './../front/common/ContactForm.vue';
import ClientContactUsForm from './../backend/client/common/ContactForm.vue';

export default{
  data() {
    return {
      banner: {
        class: 'page-hero',
        bgImg: 'background-image: url(assets/images/ff_camilla-2.jpg)',
        ptext: trans('services.Secure_with_Frilans_Finans'),
        htext: trans('services.Insurance'),
      },
    };
  },
  components: {
    'banner-component': BannerComponent,
    'info-component': InfoComponent,
    'detail-tab-component': DetailTabComponent,
    'letters-component': LettersComponent,
    'contactus-form-component': ContactForm,
    'common-question-component': CommonQuestionComponent,
    'contact-form-component': ClientContactUsForm,
  },
  computed: {
    insurancePageQuestionSectionEnabled() {
      return this.$store.state.headerModule.header.insurancePageQuestionSectionEnabled;
    },
    insuranceLinkEnabled() {
      return this.$store.state.headerModule.header.insuranceLinkEnabled;
    },
  },
};
</script>

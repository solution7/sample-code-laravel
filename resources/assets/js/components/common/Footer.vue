<template>
  <div>
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <h3 v-text="trans('common.Information')"></h3>
            <ul class="footer-list">
              <li>
                <router-link :to="{name:'AboutFrilansFinans'}"
                  v-text="trans('common.About_Frilans_Finans')">
                </router-link>
              </li>
              <li>
                <router-link :to="{name:'ContactUs'}"
                  v-text="trans('common.Contact_us')">
                </router-link>
              </li>
              <li v-if="showBusinessSolutionPage">
                <router-link :to="{name:'BusinessSolutions'}"
                  v-text="trans('common.Frilans_Finans_Business')">
                </router-link>
              </li>
              <li>
                <router-link :to="{name:'PrivacyPolicy'}"
                  v-text="trans('privacy.Privacy_Policy')">
                </router-link>
              </li>
            </ul>
          </div>
          <div class="col-sm-4">
            <h3 v-text="trans('common.Social_media')"></h3>
            <ul class="footer-list social-media-list">
              <li class="facebook">
                <svg-icon :icon="'facebook-circle'" :attr="attr"> </svg-icon>
                <a :href="trans('common.FACEBOOK_LINK')"
                  target="_blank" v-text="trans('common.Facebook')">
                </a>
              </li>
              <li class="twitter">
                <svg-icon :icon="'twitter-circle'" :attr="attr"> </svg-icon>
                <a :href="trans('common.TWITTER_LINK')"
                  target="_blank" v-text="trans('common.Twitter')">
                </a>
              </li>
              <li class="linkedin">
                <svg-icon :icon="'linkedin-circle'" :attr="attr"> </svg-icon>
                <a :href="trans('common.LINKEDIN_LINK')"
                  target="_blank" v-text="trans('common.LinkedIn')">
                </a>
              </li>
              <li class="instagram">
                <svg-icon :icon="'instagram-circle'" :attr="attr"> </svg-icon>
                <a :href="trans('common.INSTAGRAM_LINK')"
                  target="_blank" v-text="trans('common.Instagram')">
                </a>
              </li>
            </ul>
          </div>
          <div class="col-sm-4">
            <h3 v-text="trans('common.Contact')"></h3>
            <div class="footer-col-3-text">
              <ul class="footer-list">
                <li>
                  <a :href="'mailto:' + trans('common.our_office_email')"
                    v-text="trans('common.our_office_email')">
                  </a>
                </li>
                <li v-text="trans('common.our_office_contact_number')"></li>
                <li v-text="trans('common.Open_on_weekdays')"></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <p class="copywright">
            &copy;{{ new Date().getFullYear() }} {{ trans('common.Frilans_Finans_AB')}}
          </p>
          <router-link :to="{name : 'InformationCookies'}"
            v-text="trans('common.Information_about_cookies')">
          </router-link>
          <div class="footer-logo hide-mobile">
            <img src="assets/images/logos/egenanstallning.png"
              :alt="trans('common.SelfEmploymentOrganization')" class="egenanstallning"
            />
            <img src="assets/images/logos/gasellvinnare_2016_white.png"
              :alt="trans('common.Gasellvinnare2016')"
            />
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>

export default {
  data() {
    return {
      attr: {
        class: 'icon-light-blue',
        width: 20,
      },
    };
  },
  computed: {
    showBusinessSolutionPage() {
      return this.$store.state.headerModule.header.showBusinessSolutionPage;
    },
  },
};
</script>

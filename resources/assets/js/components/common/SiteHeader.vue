<template>
    <div>
        <header class="front-page-header sticky">
            <div class="container custom-conatiner-sec">
                <router-link :to="{ name: 'FrontIndex' }" class="logo logo-brand-header">
                    <img :src="header.countryLogo">
                </router-link>
                <div class="left-section left-section-backend">
                    <ul class="toggle-menu signed-out signed-outBack" role="menu"
                    v-if="!auth && showBusinessSolutionPage">
                        <li :class="{selected: !isActive('BusinessSolutions')}" role="menuitem">
                            <router-link :to="{ name: 'FrontIndex' }" class="logo logo-backend"
                             v-text="trans('common.Private_person')"></router-link>
                        </li>
                        <li role="menuitem" :class="{selected: isActive('BusinessSolutions')}">
                            <router-link :to="{ name: 'BusinessSolutions' }"
                            class="logo logo-backend"
                            v-text="trans('common.Company')"></router-link>
                        </li>
                    </ul>
                    <div class="left-menus left-header">
                        <ul class="select-list hide-mobile" role="menu"
                        @click="countryToggle($event)">
                            <li>
                                <span class="selected" v-if="header.SITE_COUNTRY_NAME"
                                 v-text="trans('common.'+header.SITE_COUNTRY_NAME)"></span>
                                <ul class="select-list-sub"
                                    v-bind:class="{'select-list-shown': headerCountryToggle}"
                                    role="menu" aria-hidden="true">
                                    <li role="menuitem" v-for="(country, key) in header.countries"
                                    :key="key">
                                        <a :href="country.publicSiteUrl"
                                        v-text="trans('common.'+country.name)"></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="select-list lang-menu hide-mobile" role="menu"
                            @click="langToggle($event)">
                            <li>
                                <span class="selected">
                                  <img v-if="activeLang"
                                  :src="'/assets/images/flags'+activeLang+'.png'" />
                                </span>
                                <ul class="select-list-sub"
                                    v-bind:class="{'select-list-shown': headerLangToggle}"
                                    role="menu" aria-hidden="true">
                                    <li role="menuitem"
                                     v-for="(appDefaultLang, key) in header.appDefaultLanguage"
                                     :key="key">
                                  <a v-on:click="changeLang(appDefaultLang)">
                                  <img v-if="appDefaultLang.flag"
                                  :src="'/assets/images/flags/'+appDefaultLang.flag+'.png'"/>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="select-list lang-menu hide-mobile" role="menu"
                          v-if="loggedInUser && isActive('Kate')">
                          <li>
                            <a v-text="loggedInUser.first_name+' '+loggedInUser.last_name"></a>
                          </li>
                        </ul>
                    </div>
                </div>
                <div class="right-section">
                    <div v-if="auth" class="right-inner-back-section hidden-xs">
                        <a @click.prevent="logout()" class="login  loginBackend logout"
                         v-text="trans('common.Logout')">
                        </a>
                        <a href="javascript:void(0)" v-if="isAdmin && isActive('Client')"
                            @click="changeProfile(1, 'Search')"
                            class="crte-btnn admin-mode">
                            <img src="/assets/backend/images/switch.svg">
                            <span v-text="trans('common.LOGGED_IN_MODE')"></span>
                        </a>
                        <template v-if="isActive('Client')">
                            <router-link :to="{name: 'ClientEconomyInvoiceTool'}"
                            v-if="!isActive('ClientEconomyInvoiceTool')" class="crte-btnn"
                            @click="resetInvoiceTool" v-text="trans('client.Create_invoice')">
                            </router-link>
                          <a v-else-if="isActive('ClientEconomyInvoiceTool')"
                            class="crte-btnn closeInvoiceTool" @click="closeInvoiceTool"
                            v-text="trans('client.closeInvoiceTool')">
                          </a>
                        </template>
                        <router-link :to="{name: myPageRedirect()}"
                          v-if="!isActive('Client') && !isActive('Kate')"
                          class="warning-button btn-warning-backend"
                          v-text="trans('common.My_pages')">
                        </router-link>
                    </div>
                    <div v-else class="right-inner-back-section hidden-xs">
                        <router-link :to="{name: 'Login'}" class="login bold-text loginBackend"
                        v-text="trans('common.Login')">
                        </router-link>
                        <router-link :to="{name: 'Register'}"
                        class="warning-button btn-warning-backend"
                        v-text="trans('common.Create_account')">
                        </router-link>
                    </div>
                    <button class="menu-btn open-menu" @click="toggleMenu($event)"
                    style="display: inline-block" v-if="menus.length">
                        <span class="hamburgerIcon hamburger-white">
                        <span></span>
                        <span></span>
                        <span></span>
                        </span>
                        <span class="menu-btn-text menuText" v-text="trans('common.Menu')"></span>
                        <span class="menu-btn-text menuCloseText"
                        v-text="trans('common.Close')"></span>
                    </button>
                    <button class="menu-btn close-menu" style="display:none">
                        <span class="sprite-image close-white"></span>
                        <span class="menu-btn-text" v-text="trans('common.Close')"></span>
                    </button>
                    <ul class="username-navbar-right navigation-nav visible-xs">
                        <li>
                            <div class="dropdown user-drop-Custom">
                                <div class="dropdown-toggle" id="menu2" type="button"
                                 data-toggle="dropdown" aria-expanded="false">
                                    <a href="#"><img src="/assets/images/user.png">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                </div>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu2">
                                    <li v-if="auth">
                                        <a @click.prevent="logout()"
                                        class="login bold-text loginBackend logout">
                                          &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-out"></i>
                                          <span v-text="trans('common.Logout')"></span></a>
                                        <a href="javascript:void(0)"
                                          v-if="isAdmin && isActive('Client')"
                                            @click="changeProfile(1, 'Search')"
                                            class="admin-mode">
                                            <span>
                                              <img src="/assets/backend/images/switch.svg">
                                            </span>
                                            <span v-text="trans('common.LOGGED_IN_MODE')"></span>
                                        </a>
                                        <template v-if="isActive('Client')">
                                            <router-link :to="{name: 'ClientEconomyInvoiceTool'}"
                                            v-if="!isActive('ClientEconomyInvoiceTool')"
                                            @click="resetInvoiceTool"
                                            v-text="trans('client.Create_invoice')">
                                            </router-link>
                                            <button v-else-if="isActive('ClientEconomyInvoiceTool')"
                                            class="closeInvoiceTool" @click="closeInvoiceTool">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <span v-text="trans('client.closeInvoiceTool')">
                                            </span>
                                            </button>
                                        </template>
                                        <router-link :to="{name: myPageRedirect()}"
                                          v-if="!isActive('Client') && !isActive('Kate')">
                                          &nbsp;&nbsp;&nbsp;&nbsp;
                                          <span v-text="trans('common.My_pages')"></span>
                                        </router-link>
                                    </li>
                                    <li v-else>
                                        <router-link :to="{name: 'Login'}"
                                        class="login bold-text loginBackend">
                                          &nbsp;&nbsp;&nbsp;
                                           <span v-text="trans('common.Login')"></span>
                                        </router-link>
                                        <br>
                                        <router-link :to="{name: 'Register'}"
                                         class="btn-warning-backend">
                                            &nbsp;&nbsp;&nbsp;
                                            <span v-text="trans('common.Create_account')"></span>
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="modal fade" id="closeInvoiceTool" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1-button">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-page-content">
                    <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title modal-title-heading" id="myModalLabel1-button"></h4>
                    </div>
                    <div class="modal-body modalCotnt">
                        <p v-text="trans('client.areYouSureYou')">
                        </p>
                        <div class="modal-footer custom-modal-footer no-borderTop bttn-right"
                        style="border-top:none !important;">
                            <button type="button" class="btn btn-primary outline-button"
                            data-dismiss="modal" aria-label="Close" v-text="trans('common.No')">
                            </button>
                            <button type="button"
                            class="btn btn-primary buttonPrimary sendInvoiceBtn"
                            @click="resetInvoiceTool" v-text="trans('common.Yes')">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hamburger-menu-component
         :header="header" :auth="auth"
         :activeLang="activeLang">
        </hamburger-menu-component>
    </div>
</template>
<style scoped>
  .logo-brand-header img {
    width: 131px;
  }
  .admin-mode {
      padding:15px 15px !important;
      margin-right: 5px;
  }
  .panel-border {
    border: none;
  }

  .admin-mode > span > img{
    max-width:26px;
    margin-right:10px;
  }
  .admin-mode  > img{
    max-width:20px;
    margin-right:6px;
  }
</style>
<script>
import { mapState, mapGetters } from 'vuex';
import HamburgerMenuComponent from './HamburgerMenu.vue';

export default {
  computed: {
    ...mapState({
      headerLangToggle: state => state.commonModule.headerLangToggle,
      headerCountryToggle: state => state.commonModule.headerCountryToggle,
      header: state => state.headerModule.header,
      menus: state => state.headerModule.menus,
      showBusinessSolutionPage: state => state.headerModule.header.showBusinessSolutionPage,
    }),
    ...mapGetters([
      'auth',
      'loggedInUser',
      'isAdmin',
      'isProjectAdministrator',
      'isProjectAdministrator',
      'isAccountAdministrator',
    ]),
    activeLang() {
      return `/${locale.split('_').pop()}`;
    },
  },
  mounted() {
    this.$store.dispatch('LOAD_HEADER_DATA');
  },
  components: {
    'hamburger-menu-component': HamburgerMenuComponent,
  },
  methods: {
    resetInvoiceTool() {
      this.$store.dispatch('RESET_INVOICE_TOOL');
      this.$router.push({ name: 'ClientActivities' });
      $('#closeInvoiceTool').modal('hide');
    },
    closeInvoiceTool() {
      $('#closeInvoiceTool').modal({ backdrop: 'static' });
    },
    toggleMenu(event) {
      event.stopPropagation();
      const isOpened = this.$store.state.commonModule.headerMenuToggle;
      if (isOpened) {
        this.$store.commit('SET_HEADER_MENU_TOGGLE', false);
      } else {
        this.$store.commit('SET_HEADER_MENU_TOGGLE', true);
      }
    },
    langToggle(event) {
      event.stopPropagation(event);
      const isOpened = this.headerLangToggle;
      if (isOpened) {
        this.$store.commit('SET_HEADER_LANG_TOGGLE', false);
      } else {
        this.$store.commit('SET_HEADER_LANG_TOGGLE', true);
      }
    },
    countryToggle(event) {
      event.stopPropagation();
      const isOpened = this.headerCountryToggle;
      if (isOpened) {
        this.$store.commit('SET_HEADER_COUNTRY_TOGGLE', false);
      } else {
        this.$store.commit('SET_HEADER_COUNTRY_TOGGLE', true);
      }
    },
    logout() {
      this.$store.dispatch('LOGOUT', this);
    },
    isActive(menuItem) {
      return this.$route.name && this.$route.name.indexOf(menuItem) !== -1;
    },
    myPageRedirect() {
      let redirect = null;
      if (this.$store.getters.isActiveAdminProfile) {
        redirect = this.$store.state.authModule.adminRedirect;
      } else if (this.$store.getters.isActiveClientProfile) {
        redirect = this.$store.state.authModule.clientRedirect;
      }

      if (this.isProjectAdministrator ||
        this.isAccountAdministrator) {
        redirect = 'KateDashboard';
      }

      return redirect;
    },
    setHeaders() {
      const app = this;
      const headerUrl = app.header.url;
      const shortCode = app.header.systemCountry.short_code;
      let lang = '';
      const path = this.$route.path.replace(`/${UrlLang}`, '');

      app.header.appDefaultLanguage.forEach((v) => {
        if (v.flag !== shortCode) {
          lang = `/${v.flag}`;
        }
        document.querySelector(`link[name=${v.flag}-lang]`).setAttribute('href', headerUrl + lang + path);
      });
    },
    changeLang(lang) {
      this.$store.dispatch('CHANGE_LANGUAGE', lang);
    },
    changeProfile(profileId, redirectRouteName) {
      this.$store.commit('SET_ACTIVE_PROFILE', profileId);
      this.$router.push({ name: redirectRouteName });
    },
  },
};

</script>

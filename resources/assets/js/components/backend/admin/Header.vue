<template>
  <div>
    <span id="nav-icon1" v-bind:class="{'tgleOpen': headerMenuToggle}"  @click="toggleMenu($event)">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <nav class="navbar_header">
      <div class="container-fluid">
        <div class="header-logo logo-brand">
          <router-link :to="{ name: 'FrontIndex' }">
            <img src="/assets/backend/images/logo.png" :alt="trans('common.FrilansFinansLogoType')">
          </router-link>
        </div>
        <div class="left-menus bk-dropdown hidden-xs">
          <ul class="select-list" role="menu" data-toggle="collapse"
          data-target="#countryDropDwn" @click="countryToggle($event)" >
            <li>
              <span v-if="header.SITE_COUNTRY_NAME"
                v-text="trans('common.'+header.SITE_COUNTRY_NAME )">
              </span>
              <ul class="select-list-sub collapse"  role="menu"
                aria-hidden="true" id="countryDropDwn"
                v-bind:class="{'select-list-shown': headerCountryToggle}">
                <li role="menuitem" v-for="country in header.countries" :key="country.id">
                  <a :href="'?setCountry='+country.id">
                    <span class="text-color" v-text="trans('common.'+country.name)"></span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="select-list language-list" role="menu" @click="langToggle($event)">
            <li>
              <span>
                <img v-if="activeLang" :src="'/assets/images/flags'+activeLang+'.png'"/>
              </span>
              <ul class="select-list-sub list-link"
                  v-bind:class="{'select-list-shown': headerLangToggle}"
                  role="menu"
                  aria-hidden="true" >
                <li role="menuitem" v-for="(appDefaultLang, key) in header.appDefaultLanguage"
                  :key="key">
                  <a v-on:click="changeLang(appDefaultLang)">
                    <img v-if="appDefaultLang.flag"
                      :src="'assets/images/flags/'+appDefaultLang.flag+'.png'"
                    />
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <ul class="navbar-right navbar-custom-nav navigation-nav">
          <li class="hidden-sm hidden-xs" v-if="this.$store.getters.isBoth">
            <a href="javascript:void(0)"
              @click="changeProfile(2, 'ClientActivities')"
              class="btn-logged-mode" >
              <span><img src="/assets/backend/images/switch.svg"></span>
              <label v-text="trans('common.LOGGED_IN_MODE')"></label>
            </a>
          </li>
          <li>
            <div class="dropdown cstm_drp">
              <button class="btn btn-primary dropdown-toggle dropDownBttn"
                id="menu1" type="button" data-toggle="dropdown">
                <a href="#">
                  <img src="/assets/backend/images/user.png">
                  <span v-text="header.currentUser"></span>
                </a>
                <span><i class="glyph-icon flaticon-down-arrow"></i></span>
              </button>
              <ul class="dropdown-menu menuOption" role="menu" aria-labelledby="menu1">
                <li class="visible-sm visible-xs img-switch-in" v-if="this.$store.getters.isBoth">
                  <a href="javascript:void(0)"
                    @click="changeProfile(2, 'ClientActivities')">
                    <img src="/assets/backend/images/switch2.svg">
                    <span v-text="trans('common.LOGGED_IN_MODE')"></span>
                  </a>
                </li>
                <li role="presentation">
                  <router-link :to="{ name: 'AdminProfile' }">
                    <i class="glyph-icon flaticon-user-1"></i>
                    <span v-text="trans('common.UpdateProfile')"></span>
                  </router-link>
                </li>
                <li role="presentation">
                  <router-link :to="{name : 'AdminChangePassword'}">
                    <i class="glyph-icon flaticon-padlock"></i>
                    <span v-text="trans('common.Change_Password')"></span>
                  </router-link>
                </li>
                <li class="visible-xs">
                  <a @click.prevent="logout()">
                    <i class="glyph-icon flaticon-logout-1"></i>
                    <span v-text="trans('common.Logout')"></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="hide-until-mobile hide-mobile-veiw">
            <a @click.prevent="logout()">
              <i class="glyph-icon flaticon-logout-1"></i>
              <span v-text="trans('common.Logout')"></span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  computed: {
    headerLangToggle() {
      return this.$store.state.commonModule.headerLangToggle;
    },
    headerMenuToggle() {
      return this.$store.state.commonModule.headerMenuToggle;
    },
    headerCountryToggle() {
      return this.$store.state.commonModule.headerCountryToggle;
    },
    header() {
      return this.$store.state.headerModule.header;
    },
    auth() {
      return this.$store.getters.auth;
    },
    activeLang() {
      return `/${locale.split('_').pop()}`;
    },
  },
  methods: {
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
      event.stopPropagation();
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
    changeLang(lang) {
      this.$store.dispatch('CHANGE_LANGUAGE', lang);
    },
    changeProfile(profileId, redirectRouteName) {
      this.$store.commit('SET_ACTIVE_PROFILE', profileId);
      this.$router.push({ name: redirectRouteName });
    },
  },
  mounted() {
    this.$store.dispatch('LOAD_HEADER_DATA');
  },
};
</script>

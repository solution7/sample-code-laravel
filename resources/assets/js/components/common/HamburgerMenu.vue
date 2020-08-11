<template>
  <div class="top-menu-wrapper" @click="$event.stopPropagation()">
    <div class="hide-until-mobile mobile-bottom-menus">
      <ul class="select-list" role="menu" @click="countryToggle($event)">
        <li>
          <span class="selected" v-text="trans('common.'+header.SITE_COUNTRY_NAME)"></span>
          <ul class="select-list-sub"
            v-bind:class="{'select-list-shown': headerCountryToggle}"
            role="menu"
            aria-hidden="true" >
            <li role="menuitem" v-for="country in header.countries" :key="country.id">
              <a :href="country.publicSiteUrl" v-text="trans('common.'+country.name)"></a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="select-list lang-menu hide-mobile" role="menu" @click="langToggle($event)">
        <li>
          <span class="selected">
            <img v-if="activeLang" :src="'assets/images/flags'+activeLang+'.png'" />
          </span>
          <ul class="select-list-sub"
            v-bind:class="{'select-list-shown': headerLangToggle}"
            role="menu"
            aria-hidden="true">
            <li role="menuitem"
              v-for="(appDefaultLang, key) in header.appDefaultLanguage" :key="key">
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
    <ul class="toggle-menu signed-out toggle-sign" role="menu" v-if="!auth">
      <li class="selected" role="menuitem">
        <router-link :to="{ name: 'FrontIndex' }" v-text="trans('common.Private_person')">
        </router-link>
      </li>
      <li role="menuitem" class="">
        <router-link :to="{ name: 'BusinessSolutions' }" v-text="trans('common.Company')">
        </router-link>
      </li>
    </ul>
    <div class="hide-until-mobile mobile-top-menu signed-in" v-if="auth">
      <router-link  class="btn white" :to="{name: 'ClientEconomyInvoiceTool'}"
        v-text="trans('common.Create_invoice')">
      </router-link>
    </div>
    <rightsidebar-component></rightsidebar-component>
  </div>
</template>

<script>
import RightsidebarComponent from './Rightsidebar.vue';

export default {
  props: [
    'header',
    'auth',
    'activeLang',
  ],
  components: {
    'rightsidebar-component': RightsidebarComponent,
  },
  computed: {
    headerLangToggle() {
      return this.$store.state.commonModule.headerLangToggle;
    },
    headerCountryToggle() {
      return this.$store.state.commonModule.headerCountryToggle;
    },
  },
  methods: {
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
    changeLang(lang) {
      this.$store.dispatch('CHANGE_LANGUAGE', lang);
    },
  },
};
</script>

<template>
  <div>
    <div class="sidebar my-page-inner mCustomScrollbar"
      v-bind:class="{'tgleOpen': headerMenuToggle}">
      <div class="sidebar-wrapper">
        <div class="hide-until-mobile mobile-bottom-menus client-section">
          <ul class="select-list client-ul" role="menu" @click="countryToggle($event)">
            <li>
              <span class="selected" v-text="trans('common.'+header.SITE_COUNTRY_NAME)"></span>
              <ul class="select-list-sub" role="menu"
                aria-hidden="true"
                v-bind:class="{'select-list-shown': headerCountryToggle}">
                <li role="menuitem" v-for="(country) in header.countries" :key="country.id">
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
              <ul class="select-list-sub" role="menu"
                v-bind:class="{'select-list-shown': headerLangToggle}"
                aria-hidden="true">
                <li role="menuitem" v-for="appDefaultLang in header.appDefaultLanguage"
                  :key="appDefaultLang.id">
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
        <ul class="nav">
          <li :class="{ active: isActive('Search') }">
            <router-link :to="{ name :'Search'}">
              <i class="glyph-icon flaticon-magnifying-glass"></i>
              <span v-text="trans('common.Search')"></span>
            </router-link>
          </li>
          <li :class="{ active: isActive('Invoice') }">
            <router-link :to="{ name :'Invoice'}">
              <i class="glyph-icon flaticon-invoice"></i>
              <span v-text="trans('common.Invoices')"></span>
            </router-link>
          </li>

          <li class="dropdown" id="calculation-dropdown"
            :class="{ active: (isActive('Taxkey') || isActive('Simulator')) ||
            isActive('AdminInvoiceTool') }">
            <a href="javascript:void(0)" @click="$event.stopPropagation()">
              <i class="glyph-icon flaticon-settings"></i>
              <span v-text="trans('common.TAX_SETTING')"></span>
            </a>
            <ul class="dropdown-menu hidden-content slide-up">
              <li :class="{ active: isActive('Taxkey') }">
                <router-link :to="{ name :'Taxkey'}">
                  <i class="glyph-icon flaticon-down-arrow"></i>
                  <span v-text="trans('common.TaxKeys')"></span>
                </router-link>
              </li>
              <li :class="{ active: isActive('Simulator') }">
                <router-link :to="{ name :'Simulator'}">
                  <i class="glyph-icon flaticon-down-arrow"></i>
                  <span v-text="trans('common.Simulator')"></span>
                </router-link>
              </li>
              <li :class="{ active: isActive('AdminInvoiceTool') }">
                <router-link :to="{ name :'AdminInvoiceTool'}">
                  <i class="glyph-icon flaticon-down-arrow"></i>
                  <span v-text="trans('client.InvoiceTool')"></span>
                </router-link>
              </li>
            </ul>
          </li>
          <li :class="{ active: isActive('NewsFlash') }">
            <router-link :to="{ name :'NewsFlash'}">
              <i class="glyph-icon flaticon-invoice"></i>
              <span v-text="trans('common.news_flash')"></span>
            </router-link>
          </li>
          <li :class="{ active: isActive('Jobs') }">
            <router-link :to="{ name :'Jobs'}">
              <i class="glyphicon glyphicon-briefcase"></i>
              <span v-text="trans('client.Jobs')"></span>
            </router-link>
          </li>
          <li :class="{ active: isActive('NewUser') }">
            <router-link :to="{ name :'NewUser'}">
              <i class="glyph-icon flaticon-user"></i>
              <span v-text="trans('common.new_users')"></span>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<style scoped>
.slide-down {
    max-height: 20em;
}
.dropdown-menu.hidden-content {
    display: block;
    padding: 0;
}
.hidden-content li:first-child {
  margin-top: 20px;
}
.hidden-content li:last-child {
  margin-bottom: 20px;
}
@media screen and (max-width: 768px) {
  ul.nav {
      background-color: transparent !important;
      padding: 5px;
  }
}
</style>
<script>
export default {
  computed: {
    header() {
      return this.$store.state.headerModule.header;
    },
    auth() {
      return this.$store.getters.auth;
    },
    activeLang() {
      return `/${locale.split('_').pop()}`;
    },
    headerMenuToggle() {
      return this.$store.state.commonModule.headerMenuToggle;
    },
    headerLangToggle() {
      return this.$store.state.commonModule.headerLangToggle;
    },
    headerCountryToggle() {
      return this.$store.state.commonModule.headerCountryToggle;
    },
  },
  methods: {
    isActive(menuItem) {
      return this.$route.name === menuItem;
    },
    calculationDropdown() {
      const parentElement = document.getElementById('calculation-dropdown');
      const childElement = document.querySelector('.sidebar .nav > li.dropdown > a');
      const hiddenElement = document.getElementsByClassName('hidden-content')[0];

      if (childElement) {
        childElement.addEventListener('click', () => {
          hiddenElement.classList.toggle('slide-up');
          hiddenElement.classList.toggle('slide-down');
        });
      }

      if (parentElement && parentElement.classList.contains('active')) {
        hiddenElement.classList.add('slide-down');
        hiddenElement.classList.remove('slide-up');
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
    changeLang(lang) {
      this.$store.dispatch('CHANGE_LANGUAGE', lang);
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
  },
  mounted() {
    this.$nextTick(() => {
      this.calculationDropdown();
    });
  },
};
</script>

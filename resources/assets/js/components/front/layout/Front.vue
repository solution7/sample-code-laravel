<template>
  <div>
    <cookie-component></cookie-component>
    <div class="page-wrapper" v-bind:class="{'menu-open': headerMenuToggle}">
      <site-header-component></site-header-component>
      <div :class="{'middle-section': isActive('InvoiceTool')}">
        <router-view></router-view>
      </div>
    </div>
    <footer-component></footer-component>
    <internal-server-error-component></internal-server-error-component>
    <alerts></alerts>
  </div>
</template>
<style scoped>
  .middle-section {
    padding-top: 0px;
  }
</style>
<script>
import CookieConsent from '../CookieConsent.vue';

export default {
  components: {
    'cookie-component': CookieConsent,
  },
  computed: {
    headerMenuToggle() {
      return this.$store.state.commonModule.headerMenuToggle;
    },
  },
  methods: {
    isActive(menuItem) {
      return this.$route.name && this.$route.name.indexOf(menuItem) !== -1;
    },
  },
};
</script>

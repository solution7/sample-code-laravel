<template>
    <div class="page-wrapper  padding-top-none" v-bind:class="{'menu-open': headerMenuToggle}">
        <site-header-component></site-header-component>
        <page-not-found-component v-if="error404" ></page-not-found-component>
        <div class="middle-section" v-else >
            <client-sidebar-component  v-if="!isActive('ClientEconomyInvoiceTool')">
            </client-sidebar-component>
            <div class="main-container">
              <router-view></router-view>
            </div>
        </div>
        <footer-component></footer-component>
        <internal-server-error-component></internal-server-error-component>
        <alerts></alerts>
    </div>
</template>
<script>
import Sidebar from './../Sidebar.vue';

export default {
  components: {
    'client-sidebar-component': Sidebar,
  },
  computed: {
    error404() {
      return this.$store.state.exceptionModule.error404;
    },
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

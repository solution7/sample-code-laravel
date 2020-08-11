<template>
  <div class="wrapper" v-bind:class="{'menu-open': headerMenuToggle}">
    <header-component></header-component>
    <page-not-found-component v-if="error404" ></page-not-found-component>
    <template v-else >
      <sidebar-component></sidebar-component>
      <div class="main-panel">
        <router-view></router-view>
      </div>
    </template>
    <internal-server-error-component></internal-server-error-component>
    <alerts></alerts>
  </div>
</template>
<script>

import Header from './../../../../components/backend/admin/Header.vue';
import Sidebar from './../../../../components/backend/admin/Sidebar.vue';

export default {
  computed: {
    error404() {
      return this.$store.state.exceptionModule.error404;
    },
    headerMenuToggle() {
      return this.$store.state.commonModule.headerMenuToggle;
    },
  },
  components: {
    'header-component': Header,
    'sidebar-component': Sidebar,
  },
};
</script>

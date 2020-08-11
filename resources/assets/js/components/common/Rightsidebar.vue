<template>
  <div>
    <div v-if="menus.length" v-for="(menu, key) in menus" :key="key">
      <p class="menu-name">{{trans(menu.name)}}</p>
      <ul class="menu-list" v-if="menu.name == 'common.Social_Media'">
          <li v-for="(submenu, index ) in menu.submenu" :key="index" class="social-media-menu">
            <p v-for="(menuName, index ) in submenu" :key="index" @click="toggleMenu">
              <a :href="trans(index)" > {{trans(menuName)}} </a>
            </p>
          </li>
      </ul>
      <ul class="menu-list" v-else>
          <li v-for="(submenu, index ) in menu.submenu" :key="index">
            <p v-for="(menuName, index ) in submenu" :key="index" @click="toggleMenu">
              <template v-if="index == 'Network'">
                <router-link :to="{name : index}" v-if="networkEnabled" >
                  {{trans(menuName)}}
                </router-link>
              </template>
              <router-link :to="{name : index}" v-else> {{trans(menuName)}} </router-link>
            </p>
          </li>
      </ul>
    </div>
   </div>
</template>


<script>

export default {
  beforeCreate() {
    this.$store.dispatch('GET_MENU_LIST');
  },
  computed: {
    networkEnabled() {
      return this.$store.state.headerModule.header.networkEnabled;
    },
    menus() {
      return this.$store.state.headerModule.menus;
    },
  },
  methods: {
    toggleMenu() {
      const isOpened = this.$store.state.commonModule.headerMenuToggle;
      if (isOpened) {
        this.$store.commit('SET_HEADER_MENU_TOGGLE', false);
      }
    },
  },
};
</script>

<template>
  <div>
    <alert-slot v-if="defaultAlert.show" :icon="defaultAlert.icon">
      <div slot="body" class="text-center">
        <h4 class="alert-title" v-if="defaultAlert.title" v-html="defaultAlert.title"></h4>
        <div class="alert-text" v-if="defaultAlert.text" v-html="defaultAlert.text"></div>
      </div>
      <div slot="footer" class="text-right">
        <button class="btn btn-sm " @click="hideDefaultAlert">
          {{trans('common.Ok')}}
        </button>
      </div>
    </alert-slot>
    <alert-slot v-if="confirmAlert.show" :icon="confirmAlert.icon">
      <div slot="body" class="text-center">
        <h4 class="alert-title" v-if="confirmAlert.title" v-html="confirmAlert.title"></h4>
        <div class="alert-text" v-if="confirmAlert.text" v-html="confirmAlert.text"></div>
      </div>
      <div slot="footer" class="text-center">
        <div>
          <button type="button" class="btn btn-sm btn-default" @click="cancelConfirmAlert">
            {{trans('common.Cancel')}}
          </button>
          <button type="button" class="btn btn-sm confirm-btm" @click="confirmedAlert">
            {{trans('common.Confirm')}}
          </button>
        </div>
      </div>
    </alert-slot>
  </div>
</template>
<style scoped>
.btn-sm {
  padding: 10px 20px;
  margin: 5px;
}
h4 {
  font-size: 28px;
  margin-bottom: 5px;
}
.alert-text {
  color: #2e2e2e;
  font-size: 18px;
}
.btn.btn-default {
  border: 2px solid #00587c;
}
.btn-sm.confirm-btm {
  border: 2px solid #00587c;
}
</style>
<script>
import AlertSlot from './../slots/Alert.vue';

export default {
  components: {
    'alert-slot': AlertSlot,
  },
  computed: {
    defaultAlert() {
      return this.$store.state.alertModule.defaultAlert;
    },
    confirmAlert() {
      return this.$store.state.alertModule.confirmAlert;
    },
  },
  methods: {
    hideDefaultAlert() {
      this.$store.commit('HIDE_DEFAULT_ALERT');
    },
    cancelConfirmAlert() {
      this.$store.dispatch('CANCEL_CONFIRM_ALERT');
    },
    confirmedAlert() {
      this.$store.commit('CONFIRMED_ALERT');
    },
  },
};
</script>

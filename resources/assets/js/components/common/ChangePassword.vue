<template>
    <div class="inner-section">
        <div class="inner-content-password">
            <h3 v-text="trans('common.Change_Password')"></h3>
            <div class="row">
                <div class="col-sm-12">
                    <p class="gray-18" v-text="trans('client.You_have_enter_to_a_password')"></p>
                </div>
            </div>
            <div class="custom-group-form">
                <form @submit.prevent="saveform()">
                    <div class="row">
                        <div class="col-sm-10 col-md-6">
                            <div class="form-group form-group-style input input--style down-margin"
                             v-bind:class="{ 'input--filled': user.current_password }">
                                <input class="form-control input__field--style" type="password"
                                 v-model="user.current_password" id="current-password"
                                 autocomplete="off"/>
                                <label class="input__label--style" for="current-password"
                                 v-text="trans('client.Current_password')">
                                </label>
                            </div>
                            <error-component :errors="errors.current_password"></error-component>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-md-6">
                            <div class="form-group form-group-style input input--style down-margin"
                             v-bind:class="{ 'input--filled': user.password }">
                                <input class="form-control input__field--style" type="password"
                                 v-model="user.password" id="new-password" autocomplete="off"/>
                                <label class="input__label--style" for="new-password"
                                 v-text="trans('client.New_password')">
                                </label>
                            </div>
                            <error-component :errors="errors.password"></error-component>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-md-6">
                            <div class="form-group form-group-style input input--style down-margin"
                             v-bind:class="{ 'input--filled': user.password_confirmation }">
                                <input class="form-control input__field--style" type="password"
                                 v-model="user.password_confirmation" id="repeat-password"
                                 autocomplete="off"/>
                                <label class="input__label--style" for="repeat-password"
                                 v-text="trans('client.Repeat_password')">
                                </label>
                            </div>
                           <error-component  :errors="errors.password_confirmation">
                           </error-component>
                        </div>
                    </div>
                   <button class="btn btn-primary btn-block-mobile" type="submit"
                    v-text="trans('client.Save_setting')"></button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  computed: {
    errors() {
      return this.$store.state.exceptionModule.error422;
    },
    user() {
      return this.$store.state.profileModule.user;
    },
  },
  beforeCreate() {
    this.$store.commit('RESET_ERROR_422');
    this.$store.commit('RESET_CHANGE_PASSWORD_FORM');
  },
  methods: {
    saveform() {
      this.$store.dispatch('CHANGE_PASSWORD', { credentials: this.user });
    },
  },
  created() {
    this.$nextTick(() => {
      functions.initPlaceholderEffect();
    });
  },
};


</script>

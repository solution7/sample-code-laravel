<template>
  <transition name="modal">
    <div class="mask" @click="$emit('close')">
      <div class="modal-component-wrapper">
        <div class="modal-component-container" @click.stop>
            <div class="top-buttons">
              <button class="default-button" @click="$emit('close')">×</button>
            </div>
            <div v-if="loading" class="modal-component-content">
              <spinner></spinner>
            </div>
            <div v-if="!loading" class="modal-component-content">
              <slot></slot>
            </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>

import Spinner from './Spinner.vue';

export default {
  name: 'Modal',
  props: {
    htmlContent: String,
    customClass: String,
    isLoading: Boolean,
    shouldConfirm: Boolean,
  },
  components: {
    spinner: Spinner,
  },
  watch: {
    isLoading() {
      this.loading = this.isLoading;
    },
  },
  data() {
    return {
      loading: this.isLoading,
    };
  },
};
</script>

<!-- If raw html is provided, make sure to use the customClass property
 to provide a style handle for global styling -->
<style scoped>
  .mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity .3s ease;
  }

  .modal-component-wrapper {
    display: inline-block;
  }

  .modal-component-container {
    max-width: 60vw;
    max-height: 80vh;
    min-width: 300px;
    min-height: 150px;
    overflow-y: scroll;
    margin: 0px auto;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
  }

  .modal-component-content {
    padding: 30px 30px 45px;
  }

  .top-buttons {
    width: 100%;
    text-align: right;
  }

  .default-button {
    font-size: 40px !important;
    font-weight: 700;
    color: #286090;
    padding: 0 10px;
  }

  /*
   * The following styles are auto-applied to elements with
   * transition="modal" when their visibility is toggled
   * by Vue.js.
   *
   * You can easily play with the modal transition by editing
   * these styles.
   */

  .modal-enter {
    opacity: 0;
  }

  .modal-leave-active {
    opacity: 0;
  }

  .modal-enter .modal-component-container,
  .modal-leave-active .modal-component-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }
</style>

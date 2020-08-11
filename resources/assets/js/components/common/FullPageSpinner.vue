<template>
  <div class="spinner-wrapper">
    <spinner :size=100></spinner>
  </div>
</template>

<script>
import Spinner from './Spinner.vue';

export default {
  name: 'FullPageSpinner',
  components: {
    spinner: Spinner,
  },
};
</script>

<style scoped>
  .spinner-wrapper {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
</style>

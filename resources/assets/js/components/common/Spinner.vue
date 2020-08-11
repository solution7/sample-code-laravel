<template>
  <div class="spinner" :style="style"></div>
</template>

<script>
export default {
  name: 'Spinner',
  props: {
    size: Number,
  },
  computed: {
    style() {
      return {
        width: this.size ? `${this.size}px` : '50px',
        height: this.size ? `${this.size}px` : '50px',
      };
    },
  },
};
</script>

<style scoped>
  .spinner {
    margin: 10px auto;
    -webkit-animation: rotation .7s infinite linear;
    -moz-animation: rotation .7s infinite linear;
    -o-animation: rotation .7s infinite linear;
    animation: rotation .7s infinite linear;
    border-left: 3px solid rgba(0,0,0,.3);
    border-right: 3px solid rgba(0,0,0,.3);
    border-bottom: 3px solid rgba(0,0,0,.3);
    border-top: 3px solid rgba(0,0,0,.9);
    border-radius: 100%;
  }

  @-webkit-keyframes rotation {
    from {-webkit-transform: rotate(0deg);}
    to {-webkit-transform: rotate(359deg);}
  }

  @-moz-keyframes rotation {
    from {-moz-transform: rotate(0deg);}
    to {-moz-transform: rotate(359deg);}
  }

  @-o-keyframes rotation {
    from {-o-transform: rotate(0deg);}
    to {-o-transform: rotate(359deg);}
  }

  @keyframes rotation {
    from {transform: rotate(0deg);}
    to {transform: rotate(359deg);}
  }
</style>

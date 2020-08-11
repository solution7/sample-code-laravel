<template>
  <svg viewBox="0 0 100 100" :class="`${attr.class} ${icon}-icon`" :width="`${attr.width}`">
    <use v-bind:xlink:href="`/assets/images/sprites/sprite.svg#${icon}`"></use>
  </svg>
</template>

<script>
export default {
  props: {
    icon: [String],
    attr: {
      type: Object,
      default() {
        return {
          class: 'bottom-m-10 icon-light-blue',
          width: 34,
        };
      },
    },
  },
};
</script>

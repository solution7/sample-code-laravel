<template>
  <div class="plain-text">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'PlainText',
};
</script>

<style scoped>
  .plain-text {
    line-height: 1.4em;
    margin: 40px 20px;
  }
  @media (min-width: 740px) {
    .plain-text {
      margin: 40px auto;
      width: 700px;
    }
  }
</style>

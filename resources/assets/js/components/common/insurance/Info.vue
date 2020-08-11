<template>
  <div>
    <section class="insurances-text">
      <div class="container logged-in-container">
        <div class="row">
          <div :class="(this.$route.name === 'Insurance')?'col-sm-8 col-sm-push-2':
            'col-sm-10 col-sm-push-1'">
              <p v-for="(n, key) in 4" :key="key"
              v-html="trans(`services.Insurance_description_${n}`)"><br/>
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<style scoped>
.insurances-page .insurances-text p{
  text-align: left;
}
</style>

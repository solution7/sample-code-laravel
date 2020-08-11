<template>
  <div>
    <div class="start-network">
      <div class="container">
        <div class="col-sm-12">
          <router-link :to="{ name: 'Network' }">
            <h2 v-text="trans('common.Our_Network_for_those_who_are_umbrella')">
            </h2>
          </router-link>
          <p v-text="trans('common.Via_our_Network_you_have')"></p>
        </div>
      </div>
    </div>
  </div>
</template>

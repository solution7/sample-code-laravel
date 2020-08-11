<template>
  <div>
    <div class="start-puffs">
      <div class="container puff-slider">
        <div class="col-sm-4 start-puff">
          <img :src="trans('images_link.get_paid_faster_icon')" alt="">
          <h2>
            <router-link :to="{name: 'HowItWorks'}"
              v-text="trans('common.second_start_puff_number')">
            </router-link>
          </h2>
          <p v-text="trans('common.umbrella_employed_contractors')"></p>
        </div>
        <div class="col-sm-4 start-puff">
          <img :src="trans('images_link.company_was_founded_icon')" alt="">
          <h2>
            <router-link :to="{name: 'HowItWorks'}"
              v-text="trans('common.first_start_puff_number')">
            </router-link>
          </h2>
          <p v-text="trans('common.Frilans_first_umbrella_company_was_founded')"></p>
        </div>
        <div class="col-sm-4 start-puff">
          <img :src="trans('images_link.see_opportunities_anywhere_icon')" alt="">
          <h2>
            <router-link :to="{name: 'HowItWorks'}"
              v-text="trans('common.third_start_puff_number')">
            </router-link>
          </h2>
          <p v-text="trans('common.people_working_in_Client_Support')"></p>
        </div>
      </div>
    </div>
  </div>
</template>

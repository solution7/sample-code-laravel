<template>
  <div>
    <div class="start-perks">
      <div class="container">
        <div class="col-sm-12">
          <h2 v-html="trans('common.The_advantages_with_Frilans')"></h2>
        </div>
      </div>
      <div class="container perks-slider">
        <div class="col-md-4 col-sm-6">
          <svg-icon :icon="'euro'"> </svg-icon>
          <h3 v-html="trans('common.Get_paid_within_five')"></h3>
          <p v-html="trans('common.In_the_ordinary_case_you_receive_your_wages_within')"></p>
        </div>
        <div class="col-md-4 col-sm-6">
          <svg-icon :icon="'news'"> </svg-icon>
          <h3 v-html="trans('common.Eliminate_all_the_administration')"></h3>
          <p v-html="trans('common.The_only_thing_you_need_to_do_is_to')"></p>
        </div>
        <div class="col-md-4 col-sm-6">
          <svg-icon :icon="'heart'"> </svg-icon>
          <h3 v-html="trans('common.Security')"></h3>
          <p v-html="trans('common.Our_umbrella_employed_contractors_are')"></p>
        </div>
        <div class="col-md-4 col-sm-6">
          <svg-icon :icon="'user'"> </svg-icon>
          <h3 v-html="trans('common.Personal_service')"></h3>
          <p v-html="trans('common.Contact_us_at_Client_Support_if')"></p>
        </div>
        <div class="col-md-4 col-sm-6">
          <svg-icon :icon="'like'"> </svg-icon>
          <h3><span class="frelans-fee"></span><span v-html="trans('common.fee')"></span></h3>
          <p v-html="trans('common.The_service_costs_only_6')"></p>
        </div>
        <div class="col-md-4 col-sm-6">
          <svg-icon :icon="'settings'"> </svg-icon>
          <h3 v-html="trans('common.Customised_invoicing_tool')"></h3>
          <p v-html="trans('common.RUT_household_services_and_RMI')"></p>
        </div>
      </div>

      <div class="container">
        <div class="btn-wrapper">
          <router-link :to="{name: 'HowItWorks'}" class="start-hero-btn btn"
            v-text="trans('common.this_is_how_it_works')"></router-link>
        </div>
      </div>
    </div>
  </div>
</template>

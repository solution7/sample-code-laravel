<template>
  <section class="insurances-letters">
    <div class="container logged-in-container">
      <div class="row">
        <div class="col-sm-12 button-wrapper center">
          <button class="btn toggle-element"
            data-toggle="collapse"
            data-target="#insurances-letter-box"
            v-text="trans('services.Our_insurance')">
          </button>
        </div>
        <div class="collapse insurances-letter-box col-sm-6 col-sm-push-3"
          id="insurances-letter-box">
          <p>
            <a :href="trans('services.Group_Insurance_General_link')" target="_blank"
            v-text="trans('services.Group_Insurance_General')">
            </a>
          </p>
          <p>
            <a :href="trans('services.Insurance_contract_link')"
             target="_blank" v-text="trans('services.Insurance_contract')">
            </a>
          </p>
          <p>
            <a :href="trans('services.Policy_Technical_Consultants_link')"
              target="_blank" v-text="trans('services.Policy_Technical_Consultants')">
            </a>
          </p>
          <p>
            <a :href="trans('services.Insurance_advisory_computer_link')"
             target="_blank" v-text="trans('services.Insurance_advisory_computer')">
            </a>
          </p>
          <p>
            <a :href="trans('services.Travel_insurance_link')"
             target="_blank" v-text="trans('services.Travel_insurance')">
           </a>
         </p>
          <p>
            <a :href="trans('services.Travel_insurance_good_link')"
             target="_blank" v-text="trans('services.Travel_insurance_good')">
            </a>
          </p>
          <p>
            <a :href="trans('services.Travel_insurance_terms_link')"
               target="_blank" v-text="trans('services.Travel_insurance_terms')">
            </a>
          </p>
          <p>
            <a :href="trans('services.Insurance_Information_link')"
             target="_blank" v-text="trans('services.Insurance_Information')">
            </a>
          </p>
          <p>
            <a :href="trans('services.Insurance_Conditions_link')"
             target="_blank" v-text="trans('services.Insurance_Conditions')">
           </a><br/>
            <a :href="trans('services.Occupational_link')"
             target="_blank" v-text="trans('services.Occupational')">
           </a>
          </p>
          <p>
            <a :href="trans('services.Occupational_pension_terms_link')"
             target="_blank" v-text="trans('services.Occupational_pension_terms')">
          </a>
        </p>
        </div>
      </div>
    </div>
  </section>
</template>

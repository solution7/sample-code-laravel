<template>
  <div>
    <div v-bind:class="{ 'inner-section': this.$route.name === 'ClientQuestionsAndAnswers' }">
      <div class="faq-page">
        <div class="container container-control-section questions-container">
          <div class="row">
            <div class="col-sm-10 col-sm-push-1 center">
              <h1 v-text="trans('help.Questions_and_answers')"></h1>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-10 col-sm-push-1">
              <div class="search-wrapper" data-no-results="No results found" id="searchFormDiv">
                <input type="text" id="autocomplete-field" @keypress="onEnterEvent($event)"
                :placeholder="trans('help.Search_among_questions_and_answers')" autocomplete="off">
                <input type="hidden"  id="question_id" value="">
                <button class="search" id="questionSearchButton"><div></div></button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-10 col-sm-push-1">
              <dl class="accordion" >
                <div class="accordion-child" v-for="(categories, key) in questionAndAnswers"
                v-if="stringTrim(categories.category) != ''
                && Object.keys(categories.questions).length > 0" :key="key">
                <dt> <a href="" v-text="categories.category"></a> </dt>
                <dd>
                  <dl class="accordion">
                    <div class="accordion-child"
                      v-for="(categoryQuestion, qusKey) in categories.questions"
                      v-if="stringTrim(categoryQuestion.question) !== ''" :key="qusKey">
                    <dt><a v-bind:href="'/'+ locale + categoryQuestion.link"
                      v-bind:data-qa-id="camelCaseToDash(qusKey)"
                      v-text="categoryQuestion.question">
                    </a></dt>
                    <dd>
                      <p v-for="(answer, index) in categoryQuestion.answers"
                        v-if="(index != 'unorderList' && index != 'unorderList1')"
                        v-html="answer" :key="index"></p>
                      <ul v-else>
                        <li v-if="index == 'unorderList'" v-for="(ans, key) in answer.unorderList"
                          v-html="ans" :key="key"></li>
                        <li v-if="index == 'unorderList1'" v-for="(ans, key) in answer.unorderList1"
                          v-html="ans" :key="key"></li>
                      </ul>
                    </dd>
                  </div>
                </dl>
              </dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
    <contact-form-component v-if="this.$route.name === 'ClientQuestionsAndAnswers'"
      :title="trans('help.Do_you_have_more_questions')"
      type="questions-and-answers"></contact-form-component>
    <contactus-form-component
      v-else
      :title="trans('help.Do_you_have_more_questions')"
      type="questions-and-answers"
    ></contactus-form-component>
    </div>
  </div>
</div>
</template>
<style scoped>
.search-wrapper .search {
    height: 47px !important;
}
</style>
<script>
import ClientContactUsForm from './../backend/client/common/ContactForm.vue';
import ContactForm from './../front/common/ContactForm.vue';

export default{
  computed: {
    questionAndAnswers() {
      return this.$store.state.faqModule.filteredQuestionsAnswers;
    },
  },
  beforeCreate() {
    this.$store.dispatch('FILTER_QUESTION_ARRAY');
  },
  components: {
    'contact-form-component': ClientContactUsForm,
    'contactus-form-component': ContactForm,
  },
  methods: {
    stringTrim(string) {
      return $.trim(string);
    },
    camelCaseToDash(string) {
      return string.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
    },
    onEnterEvent(event) {
      if (event.keyCode === 13) {
        document.getElementById('autocomplete-field').blur();
        document.getElementById('questionSearchButton').click();
      }
    },
    makeClickHandler(e, node) {
      e.preventDefault();

      if (node === 'child') {
        e.stopImmediatePropagation();
      }
      return this.$store.state.faqModule.initialiseAccordian.toggleAccordion(e.target, node);
    },
  },
  mounted() {
    const faq = this.$store.state.faqModule;

    if (this.$route.params.id) {
      faq.initialiseAccordian.findQAParam(this.$route.params.id);
    }

    this.$nextTick(() => {
      faq.initialiseAccordian.init();

      const elements = document.querySelectorAll('.accordion div > dt, .accordion div > dt > a');
      if (elements.length) {
        elements.forEach((element) => {
          const type = element.nodeName === 'DT' ? 'parent' : 'child';
          element.addEventListener('click', (e) => {
            this.makeClickHandler(e, type);
          });
        });
      }
    });
  },
};
</script>

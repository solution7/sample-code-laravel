const FrontLayout = () => import('./../components/front/layout/Front.vue');

const FrontIndex = () => import('./../components/front/Index.vue');

const Loader = () => import('./../components/front/common/Loader.vue');

const Login = () => import('./../components/front/Login.vue');

const Register = () => import('./../components/front/Register.vue');

const ForgotPassword = () => import('./../components/front/ForgotPassword.vue');

const ResetPassword = () => import('./../components/front/ResetPassword.vue');

const HowItWorks = () => import('./../components/front/Howitworks.vue');

const ContactUs = () => import('./../components/front/Contactus.vue');

const Network = () => import('./../components/front/Network.vue');

const LearnMoreAboutDeducations = () => import('./../components/front/network/event/LearnMoreAboutDeducations.vue');

const BuildYourOwnWebsite = () => import('./../components/front/network/event/BuildYourOwnWebsite.vue');

const CreateFacebookPage = () => import('./../components/front/network/event/CreateFacebookPage.vue');

const LearnBussinessInsurance = () => import('./../components/front/network/event/LearnBussinessInsurance.vue');

const PutTheRightPrices = () => import('./../components/front/network/event/PutTheRightPrices.vue');

const Insurance = () => import('./../components/common/Insurance.vue');

const QuestionsAndAnswers = () => import('./../components/common/QuestionsAndAnswers.vue');

const BusinessSolutions = () => import('./../components/front/BusinessSolutions.vue');

const PrivacyPolicy = () => import('./../components/front/PrivacyPolicy.vue');

const UmbrellaContractors = () => import('./../components/front/UmbrellaContractors.vue');

const UmbrellaMembers = () => import('./../components/front/common/UmbrellaMembers.vue');

const UmbrellaEmployment = () => import('./../components/front/UmbrellaEmployment.vue');

const AboutFrilansFinans = () => import('./../components/front/About.vue');

const InformationCookies = () => import('./../components/front/InformationCookies.vue');

const News = () => import('./../components/front/News.vue');

const VerifyCoworker = () => import('./../components/front/VerifyCoworker.vue');

const InvoiceTool = () => import('./../components/backend/client/economy/invoice_tool/Index.vue');

const Impersonate = () => import('./../components/front/impersonate/Index.vue');

const InviteRegister = () => import('./../components/front/InviteRegister.vue');

const routes = [
  {
    path: `/${UrlLang}`,
    component: FrontLayout,
    children:
    [
      {
        path: '', component: FrontIndex, meta: { title: trans('title_description.Index_title'), metaTags: [{ name: 'description', content: trans('title_description.Index_description') }] }, name: 'FrontIndex',
      },
      {
        path: 'login', component: Login, meta: { title: trans('title_description.Login_title'), metaTags: [{ name: 'description', content: trans('title_description.Login_description') }] }, name: 'Login',
      },
      {
        path: 'register', component: Register, meta: { title: trans('title_description.Register_title'), metaTags: [{ name: 'description', content: trans('title_description.Register_description') }] }, name: 'Register',
      },
      {
        path: 'register/:token', component: InviteRegister, meta: { title: trans('title_description.Register_title'), metaTags: [{ name: 'description', content: trans('title_description.Register_description') }] }, name: 'InviteRegister',
      },
      {
        path: 'password-reset', component: ForgotPassword, meta: { title: trans('title_description.Forgot_password_title'), metaTags: [{ name: 'description', content: trans('title_description.Forgot_password_description') }] }, name: 'ForgotPassword',
      },
      {
        path: 'request-password-reset/:token', component: ResetPassword, meta: { title: trans('title_description.Reset_password_title'), metaTags: [{ name: 'description', content: trans('title_description.Reset_password_description') }] }, name: 'ResetPassword',
      },
      {
        path: 'frilans-finans-business-solutions', component: BusinessSolutions, meta: { title: trans('title_description.Business_solutions_title'), metaTags: [{ name: 'description', content: trans('title_description.Business_solutions_description') }] }, name: 'BusinessSolutions',
      },
      {
        path: 'privacy-policy', component: PrivacyPolicy, meta: { title: trans('title_description.Privacy_policy_title'), metaTags: [{ name: 'description', content: trans('title_description.Privacy_policy_description') }] }, name: 'PrivacyPolicy',
      },
      {
        path: 'activation/:token', component: Loader, name: 'Loader',
      },
      {
        path: 'verify-co-worker', component: VerifyCoworker, meta: { title: trans('title_description.Verify_coworker_description'), metaTags: [{ name: 'description', content: trans('title_description.Verify_coworker_description') }] }, name: 'VerifyCoworker',
      },
      {
        path: 'invoice-tool', component: InvoiceTool, meta: { title: trans('client.InvoiceTool') }, name: 'InvoiceTool',
      },
      {
        path: 'impersonate', component: Impersonate, meta: { title: trans('client.Impersonate') }, name: 'Impersonate',
      },

      // Services route section
      {
        path: 'services',
        component: {
          render(c) { return c('router-view'); },
        },
        children:
          [
            {
              path: 'insurance', component: Insurance, meta: { title: trans('title_description.Insurance_title'), metaTags: [{ name: 'description', content: trans('title_description.Insurance_description') }] }, name: 'Insurance',
            },
            // Network route section
            {
              path: 'network',
              component: {
                render(c) { return c('router-view'); },
              },
              children:
              [
                {
                  path: '', component: Network, meta: { title: trans('title_description.Network_title'), metaTags: [{ name: 'description', content: trans('title_description.Network_description') }] }, name: 'Network',
                },
                {
                  path: 'learn-more-about-deductions', component: LearnMoreAboutDeducations, meta: { title: trans('title_description.Learn_more_about_deducations_title'), metaTags: [{ name: 'description', content: trans('title_description.Learn-more_about_deducations_description') }] }, name: 'LearnMoreAboutDeducations',
                },
                {
                  path: 'build-your-own-website', component: BuildYourOwnWebsite, meta: { title: trans('title_description.Build_your_own_website_title'), metaTags: [{ name: 'description', content: trans('title_description.Build_your_own_website_description') }] }, name: 'BuildYourOwnWebsite',
                },
                {
                  path: 'create-a-facebook-page', component: CreateFacebookPage, meta: { title: trans('title_description.Create_facebook_page_title'), metaTags: [{ name: 'description', content: trans('title_description.Create_facebook_page_description') }] }, name: 'CreateFacebookPage',
                },
                {
                  path: 'learn-business-insurance', component: LearnBussinessInsurance, meta: { title: trans('title_description.Learn_bussiness_insurance_title'), metaTags: [{ name: 'description', content: trans('title_description.Learn_bussiness_insurance_description') }] }, name: 'LearnBussinessInsurance',
                },
                {
                  path: 'put-the-right-prices', component: PutTheRightPrices, meta: { title: trans('title_description.Put_the_right_prices_title'), metaTags: [{ name: 'description', content: trans('title_description.Put_the_right_prices_description') }] }, name: 'PutTheRightPrices',
                },

              ],
            },
          ],
      },
      // Help route section
      {
        path: 'help',
        component: {
          render(c) { return c('router-view'); },
        },
        children:
          [
            {
              path: '', component: HowItWorks, meta: { title: trans('title_description.How_it_works_title'), metaTags: [{ name: 'description', content: trans('title_description.How_it_works_description') }] },
            },
            {
              path: 'how-it-works', component: HowItWorks, meta: { title: trans('title_description.How_it_works_title'), metaTags: [{ name: 'description', content: trans('title_description.How_it_works_description') }] }, name: 'HowItWorks',
            },
            {
              path: 'questions-and-answers/:id?', component: QuestionsAndAnswers, meta: { title: trans('title_description.Questions_and_answers_title'), metaTags: [{ name: 'description', content: trans('title_description.Questions_and_answers_description') }] }, name: 'QuestionsAndAnswers',
            },
            {
              path: 'meet-our-umbrella-contractors', component: UmbrellaContractors, meta: { title: trans('title_description.Umbrella_contractors_title'), metaTags: [{ name: 'description', content: trans('title_description.Umbrella_contractors_description') }] }, name: 'UmbrellaContractors',
            },
            {
              path: 'umbrella-members/:name',
              component: UmbrellaMembers,
              meta: {
                title: {
                  'malin-holmer': trans('help.Arborist'), 'lisa-svanstrom': trans('help.Singing_Teacher'), 'michael-eyre': trans('help.Translator'), 'mast-westerberg': trans('help.Testimonial_user_Mats_Westerberg_name'), 'lisa-anckarman': trans('help.Testimonial_user_Lisa_Anckarman_name'), 'mats-jungmyren': trans('help.Testimonial_user_Mats_Jungmyren_name'),
                },
              },
              name: 'UmbrellaMember',
            },
            {
              path: 'umbrella-employment', component: UmbrellaEmployment, meta: { title: trans('title_description.Umbrella_employment_title'), metaTags: [{ name: 'description', content: trans('title_description.Umbrella_employment_description') }] }, name: 'UmbrellaEmployment',
            },
          ],
      },
      // About route section
      {
        path: 'about',
        component: {
          render(c) { return c('router-view'); },
        },
        children:
          [
            {
              path: '', component: AboutFrilansFinans, meta: { title: trans('title_description.About_frilans_finans_title'), metaTags: [{ name: 'description', content: trans('title_description.About_frilans_finans_description') }] },
            },
            {
              path: 'frilans-finans', component: AboutFrilansFinans, meta: { title: trans('title_description.About_frilans_finans_title'), metaTags: [{ name: 'description', content: trans('title_description.About_frilans_finans_description') }] }, name: 'AboutFrilansFinans',
            },
            {
              path: 'contact-us', component: ContactUs, meta: { title: trans('title_description.Contact_us_title'), metaTags: [{ name: 'description', content: trans('title_description.Contact_us_description') }] }, name: 'ContactUs',
            },
            {
              path: 'information-cookies', component: InformationCookies, name: 'InformationCookies',
            },
            {
              path: 'news', component: News, name: 'News',
            },
          ],
      },
    ],
  },
];

export default routes;

const Search = () => import('./../components/backend/admin/search/Index.vue');
const Invoice = () => import('./../components/backend/admin/invoice/Index.vue');
const Taxkey = () => import('./../components/backend/admin/taxkey/Index.vue');
const Simulator = () => import('./../components/backend/admin/simulator/Index.vue');
const CustomerInfo = () => import('./../components/backend/admin/common/CustomerInfo.vue');
const AdminChangePassword = () => import('./../components/backend/admin/ChangePassword.vue');
const AdminProfile = () => import('./../components/backend/admin/Profile.vue');
const AdminLayout = () => import('./../components/backend/admin/Layout/Default.vue');
const AdminInvoiceTool = () => import('./../components/backend/admin/invoicetool/Index.vue');
const NewsFlash = () => import('./../components/backend/admin/newsflash/Form.vue');
const Jobs = () => import('./../components/backend/admin/jobposition/Index.vue');
const NewUser = () => import('./../components/backend/admin/newuser/Index.vue');

const ClientLayout = () => import('./../components/backend/client/layouts/Default.vue');
const ClientInfo = () => import('./../components/backend/admin/common/ClientInfo.vue');
const ClientInsurance = () => import('./../components/common/Insurance.vue');
const ClientCustomerIndex = () => import('./../components/backend/client/customer/Index.vue');
const PreregisteredOrders = () => import('./../components/backend/client/economy/preregistered_orders/PreregisteredOrders.vue');
const PreregisteredOrderDetails = () => import('./../components/backend/client/economy/preregistered_orders/PreregisteredOrderDetails.vue');
const ClientEconomyDeduction = () => import('./../components/backend/client/economy/Deduction.vue');
const ClientEconomyInvoice = () => import('./../components/backend/client/economy/Invoices.vue');
const ClientQuestionsAndAnswers = () => import('./../components/common/QuestionsAndAnswers.vue');
const ClientBankInfo = () => import('./../components/backend/client/setting/BankInfo.vue');
const ClientChangePassword = () => import('./../components/common/ChangePassword.vue');
const ClientPersonalInfo = () => import('./../components/backend/client/setting/PersonalInfo.vue');
const ClientEconomyInvoiceTool = () => import('./../components/backend/client/economy/invoice_tool/Index.vue');
const ClientActivities = () => import('./../components/backend/client/activities/Index.vue');
const ClientCustomerEditForm = () => import('./../components/backend/client/customer/Form.vue');
const ClientInvoiceSetting = () => import('./../components/backend/client/setting/InvoiceSetting.vue');
const ClientEconomyContracts = () => import('./../components/backend/client/economy/contracts/Contracts.vue');
const ClientEconomyContract = () => import('./../components/backend/client/economy/contracts/Contract.vue');
const ClientEconomyInvoiceDetail = () => import('./../components/backend/client/economy/InvoiceDetail.vue');
const SalaryPageComponent = () => import('./../components/backend/client/salary/SalaryPageComponent.vue');
const ClientNewsComponent = () => import('./../components/front/News.vue');
const ClientCoworkersComponent = () => import('./../components/backend/client/coworkers/Index.vue');

const routes = [

  {
    path: `/${UrlLang}`,
    component: {
      render(c) { return c('router-view'); },
    },
    children:
      [
        // Admin Section route
        {
          path: 'admin',
          component: AdminLayout,
          children:
          [
            {
              path: 'search', component: Search, meta: { title: trans('title_description.Search_title'), metaTags: [{ name: 'description', content: trans('title_description.Search_description') }] }, name: 'Search',
            },
            {
              path: 'invoice', component: Invoice, meta: { title: trans('title_description.Invoice_title'), metaTags: [{ name: 'description', content: trans('title_description.Invoice_description') }] }, name: 'Invoice',
            },
            {
              path: 'taxkey', component: Taxkey, meta: { title: trans('title_description.Taxkey_title'), metaTags: [{ name: 'description', content: trans('title_description.Taxkey_description') }] }, name: 'Taxkey',
            },
            {
              path: 'simulator', component: Simulator, meta: { title: trans('title_description.Simulator_title'), metaTags: [{ name: 'description', content: trans('title_description.Simulator_description') }] }, name: 'Simulator',
            },
            {
              path: 'profile', component: AdminProfile, meta: { title: trans('title_description.Profile_title'), metaTags: [{ name: 'description', content: trans('title_description.Profile_description') }] }, name: 'AdminProfile',
            },
            {
              path: 'change-password', component: AdminChangePassword, meta: { title: trans('title_description.Change_password_title'), metaTags: [{ name: 'description', content: trans('title_description.Change_password_description') }] }, name: 'AdminChangePassword',
            },
            {
              path: 'customer/:id', component: CustomerInfo, name: 'CustomerInfo',
            },
            {
              path: 'client/:id', component: ClientInfo, name: 'ClientInfo',
            },
            {
              path: 'invoice-tool', component: AdminInvoiceTool, name: 'AdminInvoiceTool',
            },
            {
              path: 'news-flash', component: NewsFlash, meta: { title: trans('title_description.News_title'), description: trans('title_description.News_description') }, name: 'NewsFlash',
            },
            {
              path: 'users', component: NewUser, meta: { title: trans('title_description.New_user_title'), description: trans('title_description.New_user_description') }, name: 'NewUser',
            },
            {
              path: 'jobs', component: Jobs, name: 'Jobs',
            },
          ],
        },

        // Client Section route
        {
          path: 'client',
          component: ClientLayout,
          children:
            [
              {
                path: 'activities', component: ClientActivities, meta: { title: trans('title_description.Activities_title'), metaTags: [{ name: 'description', content: trans('title_description.Activities_description') }] }, name: 'ClientActivities',
              },
              {
                path: 'activities/calculator', component: ClientActivities, meta: { title: trans('title_description.Activities_calculator_title'), metaTags: [{ name: 'description', content: trans('title_description.Activities_calculator_description') }] }, name: 'ClientActivitiesCalculator',
              },
              {
                path: 'invoice', component: ClientEconomyInvoice, meta: { title: trans('title_description.Economy_invoice_title'), metaTags: [{ name: 'description', content: trans('title_description.Economy_invoice_description') }] }, name: 'ClientEconomyInvoice',
              },
              {
                path: 'salaries', component: SalaryPageComponent, meta: { title: trans('title_description.Salary_page_title'), metaTags: [{ name: 'description', content: trans('title_description.Salary_page_description') }] }, name: 'ClientSalaries',
              },
              {
                path: 'contracts', component: ClientEconomyContracts, meta: { title: trans('title_description.Contracts_title'), metaTags: [{ name: 'description', content: trans('title_description.Contracts_description') }] }, name: 'ClientEconomyContracts',
              },
              {
                path: 'deduction', component: ClientEconomyDeduction, meta: { title: trans('title_description.Deduction_title'), metaTags: [{ name: 'description', content: trans('title_description.Deduction_description') }] }, name: 'ClientEconomyDeduction',
              },
              {
                path: 'invoice-tool/:id?', component: ClientEconomyInvoiceTool, meta: { title: trans('title_description.Invoice_tool_title'), metaTags: [{ name: 'description', content: trans('title_description.Invoice_tool_description') }] }, name: 'ClientEconomyInvoiceTool',
              },
              {
                path: 'preregistered-orders', component: PreregisteredOrders, meta: { title: trans('title_description.Preregistered_invoices_title'), metaTags: [{ name: 'description', content: trans('title_description.Preregistered_invoices_description') }] }, name: 'ClientPreregisteredOrders',
              },
              {
                path: 'preregistered-orders/:id', component: PreregisteredOrderDetails, meta: { title: trans('title_description.Preregistered_invoice_details_title'), metaTags: [{ name: 'description', content: trans('title_description.Preregistered_invoice_details_description') }] }, name: 'ClientPreregisteredOrderDetails',
              },
              {
                path: 'customer', component: ClientCustomerIndex, meta: { title: trans('title_description.Customer_title'), metaTags: [{ name: 'description', content: trans('title_description.Customer_description') }] }, name: 'ClientCustomerIndex',
              },
              {
                path: 'customer/edit/:id', component: ClientCustomerEditForm, meta: { title: trans('title_description.Customer_form_title'), metaTags: [{ name: 'description', content: trans('title_description.Customer_form_description') }] }, name: 'ClientCustomerEditForm',
              },
              {
                path: 'personal-information', component: ClientPersonalInfo, meta: { title: trans('title_description.Personal_info_title'), metaTags: [{ name: 'description', content: trans('title_description.Personal_info_description') }] }, name: 'ClientPersonalInfo',
              },
              {
                path: 'bank-information', component: ClientBankInfo, meta: { title: trans('title_description.Bank_info_title'), metaTags: [{ name: 'description', content: trans('title_description.Bank_info_description') }] }, name: 'ClientBankInfo',
              },
              {
                path: 'invoice-setting', component: ClientInvoiceSetting, meta: { title: trans('title_description.Invoice_setting_title'), metaTags: [{ name: 'description', content: trans('title_description.Invoice_setting_description') }] }, name: 'ClientInvoiceSetting',
              },
              {
                path: 'change-password', component: ClientChangePassword, meta: { title: trans('title_description.Change_password_title'), metaTags: [{ name: 'description', content: trans('title_description.Change_password_description') }] }, name: 'ClientChangePassword',
              },
              {
                path: 'insurance', component: ClientInsurance, meta: { title: trans('title_description.Insurance_title'), metaTags: [{ name: 'description', content: trans('title_description.Insurance_description') }] }, name: 'ClientInsurance',
              },
              {
                path: 'questions-and-answers/:id?', component: ClientQuestionsAndAnswers, meta: { title: trans('title_description.Questions_and_answers_title'), metaTags: [{ name: 'description', content: trans('title_description.Questions_and_answers_description') }] }, name: 'ClientQuestionsAndAnswers',
              },
              {
                path: 'news', component: ClientNewsComponent, meta: { title: trans('title_description.News_title'), metaTags: [{ name: 'description', content: trans('title_description.News_description') }] }, name: 'ClientNews',
              },
              {
                path: 'invoice/:id', component: ClientEconomyInvoiceDetail, meta: { title: trans('title_description.Invoice_detail_title'), metaTags: [{ name: 'description', content: trans('title_description.Invoice_detail_description') }] }, name: 'ClientEconomyInvoiceDetail',
              },
              {
                path: 'colleague', component: ClientCoworkersComponent, meta: { title: trans('title_description.Coworkers_title'), metaTags: [{ name: 'description', content: trans('title_description.Coworkers_description') }] }, name: 'ClientCoworkers',
              },
            ],
        },
        {
          path: 'client/contract/:id', component: ClientEconomyContract, meta: { title: trans('title_description.Contracts_title'), metaTags: [{ name: 'description', content: trans('title_description.Contracts_description') }] }, name: 'ClientEconomyContract',
        },
      ],
  },
];

export default routes;

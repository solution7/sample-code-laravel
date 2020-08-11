import store from './../store/store';

const adminRoutes = [
  'Search',
  'Invoice',
  'Taxkey',
  'Simulator',
  'AdminProfile',
  'AdminChangePassword',
  'CustomerInfo',
  'ClientInfo',
  'AdminInvoiceTool',
  'NewsFlash',
  'NewUser',
];

const clientRoutes = [
  'ClientActivities',
  'ClientActivitiesCalculator',
  'ClientEconomyInvoice',
  'ClientSalaries',
  'ClientEconomyContracts',
  'ClientEconomyDeduction',
  'ClientPreregisteredOrders',
  'ClientPreregisteredOrderDetails',
  'ClientCustomerIndex',
  'ClientCustomerEditForm',
  'ClientPersonalInfo',
  'ClientBankInfo',
  'ClientInvoiceSetting',
  'ClientChangePassword',
  'ClientInsurance',
  'ClientQuestionsAndAnswers',
  'ClientNews',
  'ClientEconomyInvoiceDetail',
  'ClientEconomyInvoiceTool',
  'ClientCoworkers',
];

// project administrator and account administrator both have permission to access routes
const kateCommonRoutes = [
  'KateDashboard',
  'KateChangePassword',
  'KateWorkOrder',
  'KateAdministrator',
  'KateCoworker',
  'KateProjects',
  'KateContactDetail',
  'KateNotification',
];
// account administrator have permission to access routes
const accountAdministratorsRouts = [
  'KateBillingAddress',
];

const lang = window.UrlLang ? `/${window.UrlLang}` : '';

const aclMiddleware = {
  handle(to, next) {
    let redirect = null;

    if (adminRoutes.includes(to.name)) {
      if (!store.getters.auth) {
        redirect = '/login';
      } else if (!store.getters.isActiveAdminProfile) {
        redirect = '/';
      }
    }

    if (clientRoutes.includes(to.name)) {
      if (!store.getters.auth) {
        redirect = '/login';
      } else if (!store.getters.isActiveClientProfile) {
        redirect = '/';
      }
    }

    if (kateCommonRoutes.includes(to.name)) {
      if (!store.getters.auth) {
        redirect = '/login';
      } else if (!store.getters.isActiveAccountAdministratorProfile &&
      !store.getters.isActiveProjectAdministratore) {
        redirect = '/';
      }
    }


    if (accountAdministratorsRouts.includes(to.name)) {
      if (!store.getters.auth) {
        redirect = '/login';
      } else if (!store.getters.isActiveAccountAdministratorProfile) {
        redirect = '/';
      }
    }

    if (store.getters.isActiveAdminProfile && ['InvoiceTool'].includes(to.name)) {
      redirect = '/';
    }

    if (store.getters.isActiveClientProfile && ['InvoiceTool'].includes(to.name)) {
      redirect = 'client/invoice-tool';
    }

    if (['/login'].includes(redirect)) {
      RememberLoggedInLink = to.name;
    }

    if (redirect) {
      next({ path: lang + redirect });
    }
  },
};

export default aclMiddleware;

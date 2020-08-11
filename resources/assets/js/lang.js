import _ from 'lodash';

let lang = process.env.MIX_LANG || 'fr_en';
const shortCode = process.env.MIX_COUNTRY || 'fi';
const NodeEnv = process.env.NODE_ENV;

const UrlLang = window.location.href.split('/')[3];

let urlLang = '';

if (UrlLang === 'en' && process.env.MIX_OPTIONAL_LANG) {
  urlLang = UrlLang;
  lang = `${shortCode}_${UrlLang}`;
}

window.locale = lang;
window.UrlLang = urlLang;
window.shortCode = shortCode;

const LangLibrary = require(`./../../lang/${locale}.json`);

window.trans = key => ((_.has(LangLibrary, key, key)) ? _.get(LangLibrary, key, key) : ((NodeEnv == 'production') ? null : key));

window.strToTrans = str => str.split('.')[0]

  .replace('_id', '')
  .replace(/_/g, ' ')
  .toLowerCase()
  .replace(/\b[a-z]/g, letter => letter.toUpperCase())
  .replace(/\s/g, '');

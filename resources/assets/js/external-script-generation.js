/* eslint-disable func-names */
(function () {
  if (process && process.env && (process.env.NODE_ENV === 'production' || process.env.NODE_ENV === 'staging') && document.getElementsByName('production-scripts-inserted').length === 0) {
    /* eslint-disable no-param-reassign */
    /* eslint-disable prefer-rest-params */
    // hotjar

    if (process.env.MIX_HOTJAR_ID) {
      (function (h, o, t, j, a, r) {
        h.hj = h.hj || function () { (h.hj.q = h.hj.q || []).push(arguments); };
        h.hjSettings = { hjid: process.env.MIX_HOTJAR_ID, hjsv: 6 };
        const headFirstTag = o.getElementsByTagName('head')[0];
        a = headFirstTag;
        r = o.createElement('script'); r.async = 1;
        r.src = t + h.hjSettings.hjid + j + h.hjSettings.hjsv;
        a.appendChild(r);
      }(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv='));
    }

    // google webfonts
    (function (d) {
      const wf = d.createElement('script');
      const s = d.scripts[0];
      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
      wf.async = true;
      s.parentNode.insertBefore(wf, s);
    }(document));

    // add meta tag to prevent double rendering
    (function (d) {
      const m = d.createElement('meta');
      m.name = 'production-scripts-inserted';
      m.content = true;
      d.getElementsByTagName('head')[0].appendChild(m);
    }(document));

    // google tag manager backup
    (function (w, d, c, ns, f, i) {
      const j = d.getElementsByTagName(c)[0];
      const k = d.createElement(ns);
      j.insertBefore(k, j.firstChild);
      const l = d.createElement(f);
      l.src = `https://www.googletagmanager.com/ns.html?id=${i}`;
      l.height = '0';
      l.width = '0';
      l.style.cssText = 'display:none;visibility:hidden';

      k.appendChild(l);
    }(window, document, 'body', 'noscript', 'iframe', 'GTM-TMW4K9S'));
  }
}());

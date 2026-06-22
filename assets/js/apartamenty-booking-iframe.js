(function () {
  var HOTEL_GUID = 'ebc0d25d-07bc-487c-87d5-ae18b86fd11a';

  function buildSrc() {
    var lang = (document.documentElement.lang || 'pl').toLowerCase().split('-')[0];
    return 'https://be.guestsage.com/' + lang + '/' + HOTEL_GUID + '/apartments';
  }

  function boot() {
    var iframe = document.getElementById('zarezerwuj');
    if (!iframe) return;

    iframe.src = buildSrc();

    if (typeof window.iFrameResize === 'function') {
      window.iFrameResize(
        { log: false, autoResize: true, sizeWidth: false },
        '#zarezerwuj'
      );
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();

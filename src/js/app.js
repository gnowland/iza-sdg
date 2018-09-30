const app = (() => {

  function activate(gp, el, now) {
    const was = sdgs.getAttribute('data-now');
    // remove .active from all slice
    for (let i = 0; i < gp.length; i++) {
      gp[i].classList.remove('active');
    }
    // add .active to focused slice
    el.classList.add('active');

  }

  function init() {
    const svg = document.getElementById('iza-sdg');
    const sdgs = document.getElementById('sdgs');
    const sdgi = sdgs.getElementsByTagName('g');

    // add .loaded
    setTimeout(() => {
      svg.classList.add('loaded');
      sdgs.setAttribute('data-now', 1);
    }, 200);

    // add tabindex to slices
    for (let i = 0; i < sdgi.length; i++) {
      const el = sdgi[i];
      const ix = i+1; // current number
      el.setAttribute('tabindex', 0);
      el.setAttribute('focusable', 'true');

      // Focus slice
      // Click
      el.addEventListener('click', function () {
        activate(sdgi, el, ix);
      });
      // Enter
      el.addEventListener('keyup', function (e) {
        if (e.keyCode === 13) {
          activate(sdgi, el, ix);
        }
      });
    }
  }

  return {
    init,
  };
})();

module.exports = app;

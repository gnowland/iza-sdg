const app = (() => {
  function init() {
    var svg = document.getElementById("iza-sdg"),
        sdgs = document.getElementById("sdgs"),
        sdgn = sdgs.getElementsByTagName("g");

    // add .loaded
    setTimeout(() => {
      svg.classList.add("loaded");
    }, 200);

    // add tabindex to slices
    for (let i = 0; i < sdgn.length; i++) {
      const el = sdgn[i];
      el.setAttribute('tabindex', 3);
    }
  }

  return {
    init,
  };
})();

module.exports = app;

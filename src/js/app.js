const app = (() => {

  const sdgs = document.getElementById('sdgs');

  // sdgs.addEventListener("transitionend", function (event) {
  //   if (event.srcElement.id == 'sdgs') {
  //     sdgs.classList.add('turnt');
  //   }
  // }, false);

  function setContent(num) {
    // remove visible from all infos
    const info = document.getElementById('sdg-info'); 
    const infa = info.getElementsByTagName('div');
    for (let i = 0; i < infa.length; i++) {
      infa[i].classList.toggle("visible", i == num);
    }
    if( num > 0 ) {
      info.classList.add('pop');
    }
  }

  function activate(gp, el, now) {
    // remove .active from all slices
    for (let i = 0; i < gp.length; i++) {
      gp[i].classList.remove('active');
    }
    // add .active to focused slice
    el.classList.add('active');
    // remove at-x from sdgs
    let sdgsCl = sdgs.classList;
    for (let i = sdgsCl.length; i > 0; i--) {
      sdgsCl.remove(sdgsCl[0]);
    }

    // Left or right?
    // if (was > now) {
    //   console.log(was + ', ' + now);
    // }

    // add new at-x to sdgs
    sdgsCl.add('neg', 'at-' + now);

    // Set content
    setContent(now);

  }

  function init() {
    const svg  = document.getElementById('iza-sdg');
    const sdgi = sdgs.getElementsByTagName('g');

    // add .loaded
    setTimeout(() => {
      svg.classList.add('loaded');
      // Rotate to 1
      sdgs.classList.add('neg', 'at-1');
    }, 200);

    // Load content from 0
    setContent(0);

    // foreach slice
    for (let i = 0; i < sdgi.length; i++) {
      const el = sdgi[i];
      const ix = i+1; // current number

      // add tabindex, focusable to slices
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

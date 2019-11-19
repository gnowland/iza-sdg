const app = (() => {

  const cont = document.getElementById('iza-sdg-app');
  const svg = document.getElementById('iza-sdg');
  const sdgs  = document.getElementById('sdgs');
  const wedge = sdgs.getElementsByTagName('g');
  const infoc = document.getElementById('sdg-info');
  const infos = infoc.getElementsByTagName('div');

  function showContent(num) {
    // toggle visible on info blocks
    for (let i = 0; i < infos.length; i++) {
      infos[i].classList.toggle('visible', i == num);
    }
  }

  function setBackground(num) {
    let color = infos[num].getAttribute('data-color');
    svg.getElementById('globe').style.fill = color;
  }

  function activate(num) {
    // add .active to focused slice
    wedge[num - 1].classList.add('active');

    // set #sdg - info data - visible attribute
    infoc.setAttribute('data-visible', num);

    // scroll to the top of the content
    window.scrollTo({ 'behavior': 'smooth', 'left': 0, 'top': cont.getBoundingClientRect().top + window.scrollY - 12 });

    // Set globe background
    setBackground(num);

    // Set content
    showContent(num);
  }

  function rotateTo(num, act) {
    // remove .active from all slices
    for (let i = 0; i < wedge.length; i++) {
      wedge[i].classList.remove('active');
    }

    // remove at-x from sdgs
    let sdgsCl = sdgs.classList;
    for (let i = sdgsCl.length; i > 0; i--) {
      sdgsCl.remove(sdgsCl[0]);
    }

    // add new at-x to sdgs
    sdgsCl.add('at-' + num);

    if (act === true) {
      activate(num);
    }
  }

  function load() {
    // Spin to 1
    rotateTo(1);

    // Load content from 0
    showContent(0);

    // remove .loading, add .loaded
    setTimeout(() => {
      cont.classList.remove('loading');
      cont.classList.add('loaded');
    }, 1000);

    // foreach content block
    for (let i = 0; i < infos.length; i++) {
      let headingTwo = infos[i].querySelectorAll('h2');
      if(headingTwo.length > 0 ){
        headingTwo[0].style.backgroundColor = infos[i].getAttribute('data-color');
      }
    }

    // foreach slice
    for (let i = 0; i < wedge.length; i++) {
      const el = wedge[i];
      const num = i + 1; // current number

      // add tabindex, focusable to slices
      el.setAttribute('tabindex', 0);
      el.setAttribute('focusable', 'true');

      // Focus slice
      // Click
      el.addEventListener('click', function () {
        rotateTo(num, true);
      });
      // Enter
      el.addEventListener('keyup', function (e) {
        if (e.keyCode === 13) {
          rotateTo(num, true);
        }
      });
    }
  }

  function init() {
    setTimeout(() => {
      cont.style.opacity = 1; // 200ms
      cont.classList.add('loading');
      svg.style.opacity = 1; // 0ms
      load();
    }, 200);
  }

  return {
    init
  };
})();

module.exports = app;

const app = (() => {

  const cont = document.getElementById('iza-sdg-app');
  const svg = document.getElementById('iza-sdg');
  const sdgs  = document.getElementById('sdgs');
  const wedge = sdgs.getElementsByTagName('g');
  const infoc = document.getElementById('sdg-info');
  const infos = infoc.getElementsByTagName('div');

  // sdgs.addEventListener('transitionend', function (event) {
  //   if (event.srcElement.id == 'sdgs') {
  //     sdgs.classList.add('turnt');
  //   }
  // }, false);

  function setBackground(num) {
    // let color = cont.style.backgroundColor;
    // if (color.length !== 0 ) {
    //   const oldColor = color;
    // }
    let color = infos[num].getAttribute('data-color');
    cont.style.backgroundColor = color;
  }

  function showContent(num) {
    // toggle visible on info blocks
    for (let i = 0; i < infos.length; i++) {
      infos[i].classList.toggle('visible', i == num);
    }
    if( num > 0 ) {
      infoc.classList.add('pop');
    }
  }

  function activate(num) {
    // remove .active from all slices
    for (let i = 0; i < wedge.length; i++) {
      wedge[i].classList.remove('active');
    }
    // add .active to focused slice
    wedge[num-1].classList.add('active');
    // remove at-x from sdgs
    let sdgsCl = sdgs.classList;
    for (let i = sdgsCl.length; i > 0; i--) {
      sdgsCl.remove(sdgsCl[0]);
    }

    // Left or right?
    // if (was > num) {
    //   console.log(was + ', ' + num);
    // }

    // scroll to top of container
    window.scrollTo({
      'behavior': 'smooth',
      'left': 0,
      'top': cont.offsetTop - 80
    });

    // add new at-x to sdgs
    sdgsCl.add('neg', 'at-' + num);

    // Set content
    showContent(num);

    //change background
    setBackground(num);

  }

  function init() {
    // add .loaded
    setTimeout(() => {
      svg.classList.add('loaded');
      // Rotate to 1
      sdgs.classList.add('neg', 'at-1');
    }, 200);

    // Load content from 0
    showContent(0);

    // foreach slice
    for (let i = 0; i < wedge.length; i++) {
      const el = wedge[i];
      const num = i+1; // current number

      // add tabindex, focusable to slices
      el.setAttribute('tabindex', 0);
      el.setAttribute('focusable', 'true');

      // Focus slice
      // Click
      el.addEventListener('click', function () {
        activate(num);
      });
      // Enter
      el.addEventListener('keyup', function (e) {
        if (e.keyCode === 13) {
          activate(num);
        }
      });

    }
  }

  return {
    init,
  };
})();

module.exports = app;

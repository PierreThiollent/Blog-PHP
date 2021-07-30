(function () {
  'use strict';

  var menuToggle = document.querySelectorAll('.js-menu-toggle');
  var mTog;
  menuToggle.forEach(mtoggle => {
    mTog = mtoggle;
    mtoggle.addEventListener('click', e => {
      if (document.body.classList.contains('offcanvas-menu')) {
        document.body.classList.remove('offcanvas-menu');
        mtoggle.classList.remove('active');
        mTog.classList.remove('active');
      } else {
        document.body.classList.add('offcanvas-menu');
        mtoggle.classList.add('active');
        mTog.classList.add('active');
      }
    });
  });
})();

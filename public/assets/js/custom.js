(function () {
  'use strict';

  var tinyslider = function () {
    var heroSlider = document.querySelectorAll('.hero-slide');
    var propertySlider = document.querySelectorAll('.property-slider');
    var imgPropertySlider = document.querySelectorAll('.img-property-slide');
    var mostPopularCenter = document.querySelectorAll('.most-popular-slider');
    var postsSlide = document.querySelectorAll('.posts-slide');

    if (heroSlider.length > 0) {
      var tnsHeroSlider = tns({
        container: '.hero-slide',
        mode: 'carousel',
        speed: 700,
        autoplay: true,
        controls: false,
        nav: false,
        autoplayButtonOutput: false,
        controlsContainer: '#hero-nav',
      });
    }

    if (imgPropertySlider.length > 0) {
      var tnsPropertyImageSlider = tns({
        container: '.img-property-slide',
        mode: 'carousel',
        speed: 700,
        items: 1,
        autoplay: true,
        controls: false,
        nav: true,
        autoplayButtonOutput: false,
      });
    }

    if (propertySlider.length > 0) {
      var tnsSlider = tns({
        container: '.property-slider',
        mode: 'carousel',
        speed: 700,
        items: 3,
        autoplay: true,
        autoplayButtonOutput: false,
        controlsContainer: '#property-nav',
        responsive: {
          0: {
            items: 1,
          },
          700: {
            items: 2,
          },
          900: {
            items: 3,
          },
        },
      });
    }

    if (postsSlide.length > 0) {
      var tnsPostsSlider = tns({
        container: '#posts-slide',
        mode: 'carousel',
        speed: 700,
        items: 1,
        autoplay: true,
        controls: false,
        nav: true,
        autoplayButtonOutput: false,
      });
    }

    if (mostPopularCenter.length > 0) {
      var mostPopularSlider = tns({
        container: '#most-popular-center',
        items: 1,
        startIndex: 1,
        mode: 'carousel',
        slideBy: 'page',
        nav: false,
        controls: true,
        gutter: 50,
        edgePadding: 0,
        center: true,
        controlsContainer: '#most-popular-nav',
        loop: false,
        swipeAngle: false,
        speed: 700,

        responsive: {
          350: {
            edgePadding: 0,
          },
          500: {
            edgePadding: 0,
          },
          700: {
            edgePadding: 150,
          },
          1000: {
            edgePadding: 300,
          },
        },
      });
    }
  };
  tinyslider();

  // Ajout de l'id de larticle a supprimer dans la modale de suppression
  document.querySelector('.delete-article').addEventListener('click', function () {
    const articleId = this.getAttribute('data-article-id');
    const thumbnailUrl = this.getAttribute('data-thumbnailUrl');
    document.querySelector('.articleId').setAttribute('value', articleId);
    document.querySelector('.thumbnailUrl').setAttribute('value', thumbnailUrl);
  });
})();

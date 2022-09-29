// import Swiper JS
import Swiper from '../vendor/swiper';

const swiper = new Swiper('.swiper', {
  loop: true,

  autoplay: {
    delay: 5000,
  },

  pagination: {
    el: '.swiper-pagination',
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});

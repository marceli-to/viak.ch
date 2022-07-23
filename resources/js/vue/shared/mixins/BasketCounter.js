export default {

  data() {
    return {

      // HTML elements
      menu: null,
      icon: null,
      counter: null,

      // Selector for html elements
      selectors: {
        menu: '.js-basket',
        icon: '.js-basket-counter',
        counter: '.js-basket-counter > em'
      }
    };
  },

  mounted() {
    this.menu    = document.querySelector(this.selectors.menu);
    this.icon    = document.querySelector(this.selectors.icon);
    this.counter = document.querySelector(this.selectors.counter);
  },

  methods: {

    updateCounter(count) {

      if (count > 0) {
        this.counter.innerHTML = count;
        this.icon.classList.add('has-items');
        this.menu.classList.remove('!hide');
      }
      else {
        this.counter.innerHTML = '';
        this.icon.classList.remove('has-items');
        this.menu.classList.add('!hide');
      }
    },
  },

};
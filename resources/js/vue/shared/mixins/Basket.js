import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import BasketCounter from "@/shared/mixins/BasketCounter";

export default {

  mixins: [ErrorHandling, i18n, BasketCounter],

  props: {
    uuid: {
      type: String,
      default: null,
    },

    exists: {
      type: Number,
      default: 0,
    }
  },

  data() {
    return {

      // Basket items
      basket: {
        events: [],
      },

      // Item state
      inBasket: false,

      // Routes
      routes: {
        basket: {
          get: '/api/basket',
          add: '/api/basket',
          delete: '/api/basket'
        }
      },
    };
  },
  
  mounted() {
    this.inBasket = this.$props.exists;
  },

  methods: {

    getBasket() {
      NProgress.start();
      this.isLoaded = false;
      this.axios.get(`${this.routes.basket.get}`).then(response => {
        this.basket = response.data;
        this.isLoaded = true;
        NProgress.done();
      });
    },

    addToBasket(uuid) {
      NProgress.start();
      this.axios.put(`${this.routes.basket.add}/${uuid}`).then(response => {
        this.updateBasketCounter(response.data.count);
        this.inBasket = true;
        this.$refs.notification.init({
          message: 'Der Kurs wurde im Warenkorb abgelegt.',
          type: 'dialog',
          style: 'success',
          autohide: false,
        });
        NProgress.done();
      });
    },

    removeFromBasket(uuid, reload = false) {
      NProgress.start();
      this.axios.delete(`${this.routes.basket.delete}/${uuid}`).then(response => {
        this.updateBasketCounter(response.data.count);
        this.inBasket = false;
        this.$refs.notification.init({
          message: 'Der Kurs wurde aus dem Warenkorb gelöscht.',
          type: 'toast',
          style: 'success',
        });

        if (reload) {
          this.getBasket();
          return;
        }
        NProgress.done();
      });
    },
  }

};
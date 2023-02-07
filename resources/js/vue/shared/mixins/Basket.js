import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import i18n from "@/shared/mixins/i18n";
import BasketCounter from "@/shared/mixins/BasketCounter";

export default {

  mixins: [Validation, i18n, BasketCounter],

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
      this.$store.commit('isLoading', true);
      this.axios.get(`${this.routes.basket.get}`).then(response => {
        this.basket = response.data;
        this.isLoaded = true;
        this.$store.commit('isLoading', false);
        NProgress.done();
      });
    },

    addToBasket(uuid) {
      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.put(`${this.routes.basket.add}/${uuid}`).then(response => {
        this.updateBasketCounter(response.data.count);
        this.inBasket = true;
        this.$refs.notification.init({
          message: 'Der Kurs wurde im Warenkorb abgelegt.',
          type: 'dialog',
          style: 'success',
        });
        this.$store.commit('isLoading', false);
        NProgress.done();
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    removeFromBasket(uuid, reload = false) {
      NProgress.start();
      this.$store.commit('isLoading', true);
      this.axios.delete(`${this.routes.basket.delete}/${uuid}`).then(response => {
        this.updateBasketCounter(response.data.count);
        this.inBasket = false;
        this.$store.commit('isLoading', false);
        NProgress.done();
        this.$toast.open(this.__('Der Kurs wurde aus dem Warenkorb gelöscht.'));
        if (reload) {
          this.getBasket();
          return;
        }
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },
  }

};
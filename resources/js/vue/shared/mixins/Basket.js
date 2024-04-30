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
    },

    rentals: {
      type: [Boolean, String, Number],
      default: 0,
    }
  },

  data() {
    return {

      // Basket items
      basket: {
        events: [],
      },

      // Temp. event uuid
      eventUuid: null,

      // Item state
      inBasket: false,

      // Rentals
      hasRentals: false, 

      // Routes
      routes: {
        basket: {
          get: '/api/basket',
          add: '/api/basket',
          delete: '/api/basket',
          rental: {
            delete: '/api/basket/rental',
          }
        }
      },
    };
  },
  
  mounted() {
    this.inBasket = this.$props.exists;
    this.hasRentals = this.$props.rentals;
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

    addToBasket(uuid, rental = false) {
      NProgress.start();
      this.$store.commit('isLoading', true);
      const uri = rental ? `${this.routes.basket.add}/${uuid}/${rental}` : `${this.routes.basket.add}/${uuid}`;
      this.axios.put(uri).then(response => {
        this.updateBasketCounter(response.data.count);
        this.inBasket = true;
        this.$refs.notification.init({
          message: 'Der Kurs wurde im Warenkorb abgelegt.',
          type: 'dialog',
          style: 'success',
        });
        this.$store.commit('isLoading', false);
        NProgress.done();
        this.getBasket();
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

    removeRentalFromBasket(uuid, reload = false) {
      this.$store.commit('isLoading', true);
      this.axios.delete(`${this.routes.basket.rental.delete}/${uuid}`).then(response => {
        this.$store.commit('isLoading', false);
        NProgress.done();
        this.$toast.open(this.__('Der Mietcomputer wurde aus dem Warenkorb gelöscht.'));
        if (reload) {
          // reload the current page
          this.$router.go();
          return;
        }
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    showRentalDialog(uuid) {
      this.eventUuid = uuid;
      this.$refs.dialog_rental.init({
        message: 'Computer mieten',
        type: 'dialog',
        style: 'confirmation',
      });
    },
  }

};
<template>
<div>
  <notification ref="notification" />
  <a href="" class="btn-primary btn-auto-w" @click.prevent="add()" v-if="!inBasket">
    {{ __('Buchen') }}
  </a>
  <a href="" class="btn-secondary btn-auto-w" @click.prevent="remove()" v-else>
    {{ __('Entfernen') }}
  </a>
</div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import BasketCounter from "@/shared/mixins/BasketCounter";

export default {

  components: {
    NProgress,
  },

  mixins: [ErrorHandling, i18n, BasketCounter],


  data() {
    return {

      // Item state
      inBasket: false,

      // Routes
      routes: {
        put: '/api/basket',
        delete: '/api/basket'
      },
    }
  },

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

  mounted() {
    this.inBasket = this.$props.exists;
  },

  methods: {

    add() {
      NProgress.start();
      this.axios.put(`${this.routes.put}/${this.$props.uuid}`).then(response => {
        this.updateCounter(response.data.count);
        this.inBasket = true;
        this.$refs.notification.init({
          message: 'Der Kurs wurde im Warenkorb abgelegt.',
          type: 'toast',
          style: 'success',
        });
        NProgress.done();
      });
    },

    remove() {
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.$props.uuid}`).then(response => {
        this.updateCounter(response.data.count);
        this.inBasket = false;
        this.$refs.notification.init({
          message: 'Der Kurs wurde aus dem Warenkorb gelöscht.',
          type: 'toast',
          style: 'success',
        });
        NProgress.done();
      });
    },

  },
}
</script>

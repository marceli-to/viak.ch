<template>
<div>
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
        alert('Der Kurs wurde im Warenkorb abgelegt.');
        NProgress.done();
      });
    },

    remove() {
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.$props.uuid}`).then(response => {
        this.updateCounter(response.data.count);
        this.inBasket = false;
        alert('Der Kurs wurde aus dem Warenkorb gelöscht.');
        NProgress.done();
      });
    },

  },
}
</script>

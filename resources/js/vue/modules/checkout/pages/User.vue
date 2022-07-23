<template>
  <div v-if="isLoaded">
    <checkout-header>
      <template #title>
        {{ __('Kontaktangaben') }}
      </template>
      <template #step>
        {{ __('Schritt') }} 2/4
      </template>
    </checkout-header>

    <article class="card-checkout" data-touch>
      <div>
        <div class="span-3">
          <strong>Kursteilnehmer</strong>
        </div>
        <div class="span-9">
          Hans Muster
        </div>
      </div>
    </article>

    <article class="card-checkout" data-touch>
      <div>
        <div class="span-3">
          <strong>Rechnungsadresse</strong>
        </div>
        <div class="span-9">
          Musterfirma AG<br>
          Letzigraben 149<br>
          8047 Zürich
        </div>
      </div>
    </article>

    <checkout-footer>
      <div>
        <router-link :to="{ name: 'checkout-basket' }" class="btn-previous">
          <icon-arrow-left />
          <span>{{ __('Zurück') }}</span>
        </router-link>
      </div>
      <div>
        <router-link :to="{ name: 'checkout-payment' }" class="btn-next">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </router-link>
      </div>
    </checkout-footer>
  </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import CheckoutHeader from "@/modules/checkout/components/Header.vue";
import CheckoutFooter from "@/modules/checkout/components/Footer.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";

export default {

  components: {
    NProgress,
    CheckoutHeader,
    CheckoutFooter,
    IconArrowRight,
    IconArrowLeft,
  },

  mixins: [ErrorHandling, i18n],

  data() {
    return {

      // States
      isLoaded: true,
    }
  },

  mounted() {
  },

  methods: {

  },
}
</script>
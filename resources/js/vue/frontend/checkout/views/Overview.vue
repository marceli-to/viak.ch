<template>
<div>
  <stacked-list-container v-if="isLoaded">
    <template v-if="basket.events.length > 0">
      <stacked-list-header>
        <template #title>
          <h2>{{ __('Übersicht') }}</h2>
        </template>
        <template #step>
          <strong>{{ __('Schritt') }} 1/4</strong>
        </template>
      </stacked-list-header>
      <stacked-list-event 
        v-for="event in basket.events" 
        :key="event.uuid" 
        :event="event"
        :is_basket="true">
        <template #action>
          <a href="" class="btn-secondary btn-auto-w" @click.prevent="removeFromBasket(event.uuid, true)">
            {{ __('Entfernen') }}
          </a>
        </template>
      </stacked-list-event>
      <stacked-list-footer>
        <router-link :to="{ name:  `${_getLocale()}-checkout-user` }" class="btn-next btn-next-wide span-12">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </router-link>
      </stacked-list-footer>
    </template>
    <template v-else>
      <div class="checkout-basket-empty">
        {{ __('Dein Warenkorb ist leer...') }}
      </div>
    </template>
  </stacked-list-container>
</div>
</template>
<script>
import NProgress from 'nprogress';
import i18n from "@/shared/mixins/i18n";
import Basket from "@/shared/mixins/Basket";
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    StackedListContainer,
    StackedListEvent,
    StackedListHeader,
    StackedListFooter,
    IconArrowRight
  },

  mixins: [i18n, Basket],

  data() {
    return {
      isLoaded: false,
    }
  },

  mounted() {
    this.getBasket();
  },
}
</script>
<template>
<div>
  <notification ref="notification">
    <template #actions>
      <a :href="`/${_getLocale()}/checkout/basket`" class="btn-success">
        {{ __('Warenkorb anzeigen') }}
      </a>
      <a href="javascript:;" @click="$refs.notification.hide()">
        {{ __('Schliessen') }}
      </a>
    </template>
  </notification>
  <a href="" class="btn-primary btn-auto-w" @click.prevent="addToBasket($props.uuid)" v-if="!inBasket">
    {{ __('Buchen') }}
  </a>
  <a href="" class="btn-secondary btn-auto-w" @click.prevent="removeFromBasket($props.uuid)" v-else>
    {{ __('Entfernen') }}
  </a>
</div>
</template>
<script>
import Basket from "@/shared/mixins/Basket";
import i18n from "@/shared/mixins/i18n";
export default {
  mixins: [Basket, i18n],
}
</script>

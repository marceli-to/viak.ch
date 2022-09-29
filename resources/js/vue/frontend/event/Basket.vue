<template>
<div>
  <notification ref="notification" />
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
export default {
  mixins: [Basket],
}
</script>

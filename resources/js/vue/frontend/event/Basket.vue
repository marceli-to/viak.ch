<template>
<div>
  <notification ref="notification">
    <template #actions>
      <a :href="`/${_getLocale()}/checkout/basket`" class="btn-success">
        {{ __('Warenkorb') }}
      </a>
      <a href="javascript:;" @click="$refs.notification.hide()" class="btn-success is-outline">
        {{ __('Schliessen') }}
      </a>
    </template>
  </notification>

  <notification ref="dialog_rental">
    <template #text>
      {{ __('Falls Du keinen Laptop hast, oder dieser den Anforderungen nicht genügt, kannst Du bei uns einen Computer mieten. Die Kosten dafür belaufen sich auf CHF 80.– (exkl. MwSt.)\n\n(Du kannst dies auch später noch anpassen)') }}
    </template>
    <template #actions>
      <a href="javascript:;" @click.prevent="addToBasket(eventUuid, true)" class="btn-primary !max-w-none">
        {{ __('Ja gerne') }}
      </a>
      <a href="javascript:;" @click.prevent="addToBasket(eventUuid, false)" class="btn-secondary is-outline !max-w-none">
        {{ __('Nein, ich bringe meinen eigenen Laptop') }}
      </a>
    </template>
  </notification>
  <template v-if="!inBasket">
    <a href="javascript:;" class="btn-primary btn-auto-w" @click.prevent="showRentalDialog($props.uuid)" v-if="hasRentals == 1">
      {{ __('Buchen') }}
    </a>
    <a href="javascript:;" class="btn-primary btn-auto-w" @click.prevent="addToBasket($props.uuid, false)" v-else>
      {{ __('Buchen') }}
    </a>
  </template>
  <template v-else>
    <a href="javascript:;" class="btn-secondary btn-auto-w" @click.prevent="removeFromBasket($props.uuid)">
      {{ __('Entfernen') }}
    </a>
  </template>
</div>
</template>
<script>
import Basket from "@/shared/mixins/Basket";
import i18n from "@/shared/mixins/i18n";
export default {
  mixins: [Basket, i18n],
}
</script>

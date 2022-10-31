<template>
  <div>
    <div v-if="$props.closed">
      <em>
        <template v-if="$props.dashboard">
          {{ __('Kurs abgeschlossen') }}
        </template>
        <template v-else>
          {{ __('Kurs ist abgeschlossen') }}
        </template>

      </em>
    </div>
    
    <div v-else-if="$props.confirmed && !$props.cancelled">
      <em class="text-success">

        <template v-if="$props.dashboard">
          {{ __('Kurs bestätigt') }}
        </template>
        <template v-else>
          {{ __('Kurs findet statt') }}
        </template>

      </em>
    </div>

    <div v-else-if="$props.cancelled">
      <em class="text-danger">

        <template v-if="$props.dashboard">
          {{ __('Kurs abgesagt') }}
        </template>
        <template v-else>
          {{ __('Kurs wurde abgesagt') }}
        </template>

      </em>
    </div>

    <div v-else>
      <em class="text-warning">

        <template v-if="$props.dashboard">
          {{ __('Kurs nicht bestätigt') }}
        </template>
        <template v-else>
          {{ __('Kurs offen, wird bestätigt') }}
        </template>

      </em>
    </div>
  </div>
</template>
<script>
import i18n from "@/shared/mixins/i18n";
import { mounted } from "vue2-dropzone";

export default {
  
  mixins: [i18n],

  props: {

    closed: {
      type: [Number, Boolean],
      default: false,
    },

    confirmed: {
      type: [Number, Boolean],
      default: false,
    },

    cancelled: {
      type: [Number, Boolean],
      default: false,
    },

    dashboard: {
      type: [Number, Boolean],
      default: false,
    }

  }
}
</script>
<template>
  <article class="stacked-list-event" data-touch>
    <template v-if="$props.event.isBooked">
      <strong class="error-message">Du hast bereits eine Buchung für diesen Kurs!</strong>
    </template>
    <div>
      <div class="stacked-list__col">
        <div :class="[$props.hasIcon ? 'sm:flex' : '']">
          <div class="stacked-list__icon" v-if="$props.hasIcon">
            <icon-checkmark />
          </div>
          <div>
            <h2>{{ $props.event.course.title }}</h2>
            <template v-if="$props.event.dates">
              <template v-if="$props.event.dates.length == 1">
                {{ $props.event.dates[0].date }}<br>{{ $props.event.dates[0].time_start }} – {{ $props.event.dates[0].time_end }} {{ __('Uhr') }}
              </template>
              <template v-else>
                <div v-for="(date, index) in $props.event.dates" :key="index">
                  {{ date.date }}<br>{{ date.time_start }} – {{ date.time_end }} {{ __('Uhr') }}
                </div>
              </template>
            </template>
          </div>
        </div>
      </div>
      <div class="stacked-list__col">
        <template v-if="$props.event.experts">
          <div>{{ $props.event.experts }}</div>
        </template>
        <template v-if="$props.event.online">
          {{ __('Online') }}
        </template>
        <template v-else-if="$props.event.location && $props.event.location.description">
          {{ $props.event.location.description }}
        </template>
      </div>
      <div class="stacked-list__col stacked-list__col--action">
        <div>
          CHF {{ $props.event.fee}}
        </div>
        <div class="stacked-list__action" v-if="$slots.action">
          <slot name="action" />
        </div>
      </div>
    </div>
  </article>
</template>
<script>
import i18n from "@/shared/mixins/i18n";
import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";

export default {

  components: {
    IconCheckmark
  },

  mixins: [i18n],

  props: {
    event: Object,
    hasIcon: {
      type: Boolean,
      default: false,
    }
  },

}
</script>
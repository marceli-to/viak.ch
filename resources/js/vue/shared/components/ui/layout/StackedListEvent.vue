<template>
  <div>

    <article 
      class="stacked-list-event" 
      data-touch 
      v-if="$props.dashboard">
      <div>
        <div class="stacked-list__col">
          <div>
            <!-- <h2>
              <span>{{ $props.event.course.title }}</span>
            </h2> -->
            <template v-if="$props.event.dates">
              <template v-if="$props.event.dates.length == 1">
                {{ $props.event.dates[0].date_short }}<span class="sm:hide !md:inline-block">, {{ $props.event.dates[0].time_start }} – {{ $props.event.dates[0].time_end }} {{ __('Uhr') }}</span>
              </template>
              <template v-else>
                <div v-for="(date, index) in $props.event.dates" :key="index">
                  {{ date.date_short }}<span class="sm:hide !md:inline-block">, {{ date.time_start }} – {{ date.time_end }} {{ __('Uhr') }}</span>
                </div>
              </template>
            </template>
          </div>
        </div>
        <div class="stacked-list__col">
          <template v-if="$props.event.online">
            {{ __('Online') }}
          </template>
          <template v-else-if="$props.event.location && $props.event.location.description">
            {{ $props.event.location.description }}
          </template>
          <template v-if="$props.event.experts">
            <div>{{ __('mit') }} {{ $props.event.experts }}</div>
          </template>
        </div>
        <div class="stacked-list__col stacked-list__col--action">
          <div>CHF {{ $props.event.fee }}</div>
          <div class="stacked-list__action">
            <slot name="action" />
          </div>
        </div>
      </div>
    </article>

    <article 
      :class="[$props.event.isBooked ? 'is-booked-error' : '', 'stacked-list-event']" 
      data-touch 
      v-else>
      <template v-if="$props.event.isBooked">
        <strong class="error-message !block mb-3x">Du hast bereits eine Buchung für diesen Kurs!</strong>
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
                  {{ $props.event.dates[0].date_short }}<br>{{ $props.event.dates[0].time_start }} – {{ $props.event.dates[0].time_end }} {{ __('Uhr') }}
                </template>
                <template v-else>
                  <div v-for="(date, index) in $props.event.dates" :key="index">
                    {{ date.date_short }}<br>{{ date.time_start }} – {{ date.time_end }} {{ __('Uhr') }}
                  </div>
                </template>
              </template>
            </div>
          </div>
        </div>
        <div class="stacked-list__col">
          <template v-if="$props.event.online">
            {{ __('Online') }}
          </template>
          <template v-else-if="$props.event.location && $props.event.location.description">
            {{ $props.event.location.description }}
          </template>
          <template v-if="$props.event.experts">
            <div>{{ __('mit') }} {{ $props.event.experts }}</div>
          </template>
        </div>
        <div :class="[!$slots.action ? 'justify-end' : '', 'stacked-list__col stacked-list__col--action']">
          <div>
            CHF {{ $props.event.fee}}
          </div>
          <div class="stacked-list__action" v-if="$slots.action">
            <slot name="action" />
          </div>
        </div>
      </div>
    </article>

  </div>
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
    },
    
    dashboard: {
      type: Boolean,
      default: false,
    }
  },
}
</script>
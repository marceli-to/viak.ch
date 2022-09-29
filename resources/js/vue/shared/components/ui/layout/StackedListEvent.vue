<template>
<div>
  
  <article v-if="$props.isAdmin"
    class="stacked-list-event" 
    data-touch>
    <div>
      <div class="stacked-list__col">
        <div>
          <template v-if="$props.event.dates">
            <template v-if="$props.event.dates.length == 1">
              {{ $props.event.dates[0].date_short }}
              <span class="sm:hide !md:inline-block">, {{ $props.event.dates[0].time_start }} – {{ $props.event.dates[0].time_end }} {{ __('Uhr') }}</span>
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
        <div>CHF {{ $props.event.fee ? $props.event.fee : $props.event.course.fee }}</div>
        <div class="stacked-list__action">
          <slot name="action" />
        </div>
      </div>
    </div>
  </article>

  <article v-else
    :class="[$props.event.isBooked ? 'is-booked-error' : '', 'stacked-list-event']" 
    data-touch>
    <template v-if="$props.event.isBooked">
      <strong class="error-message !block mb-3x">{{ __('Du hast bereits eine Buchung für diesen Kurs!') }}</strong>
    </template>
    <div>

      <div class="stacked-list__col">
        <div :class="[$slots.icon ? 'sm:flex' : '']">
          <div class="stacked-list__icon" v-if="$slots.icon">
            <slot name="icon" />
          </div>
          <div>
            <h2>{{ $props.event.course.title }}</h2>
            <template v-if="$props.event.dates">
              <template v-if="$props.event.dates.length == 1">
                {{ $props.event.dates[0].date_short }}, {{ $props.event.dates[0].time_start }} – {{ $props.event.dates[0].time_end }} {{ __('Uhr') }}
              </template>
              <template v-else>
                <div v-for="(date, index) in $props.event.dates" :key="index">
                  {{ date.date_short }}, {{ date.time_start }} – {{ date.time_end }} {{ __('Uhr') }}
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
        <template v-if="$props.event.experts && $props.showExperts">
          <div>{{ __('mit') }} {{ $props.event.experts }}</div>
        </template>
      </div>

      <div :class="[!$slots.action ? 'justify-end' : '', 'stacked-list__col stacked-list__col--action']">
        
        <div v-if="$props.showFee">
          CHF {{ $props.event.fee}}
        </div>
        
        <div v-if="$props.showBookingCount">
          Buchungen<br>
          <strong>{{ $props.event.bookings}}</strong>
        </div>

        <div class="stacked-list__action" v-if="$slots.action">
          <slot name="action" />
        </div>
      </div>
    </div>
  </article>

  <notification ref="notification" />
  
</div>
</template>
<script>
import NProgress from 'nprogress';
import i18n from "@/shared/mixins/i18n";
import Bookmark from "@/shared/mixins/Bookmark";

export default {

  components: {
    NProgress,
  },

  mixins: [i18n, Bookmark],

  props: {

    event: Object,

    booking: {
      type: Object,
      default: null,
    },

    bookmark: {
      type: Object,
      default: null,
    },
    
    isAdmin: {
      type: Boolean,
      default: false,
    },

    showExperts: {
      type: Boolean,
      default: true,
    },
    
    showFee: {
      type: Boolean,
      default: true,
    },
    
    showBookingCount: {
      type: Boolean,
      default: false
    }
  },
}
</script>
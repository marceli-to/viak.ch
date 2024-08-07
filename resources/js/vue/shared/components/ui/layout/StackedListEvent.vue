<template>
<div>
  <article v-if="$props.dashboard" class="stacked-list-event" data-touch>
    <div>
      <div class="stacked-list__col">
        <div>
          <template v-if="$props.event.dates">
            <template v-if="$props.event.dates.length == 1">
              <strong>{{ $props.event.dates[0].date_long }}</strong><br>{{ $props.event.dates[0].time_start }} – {{ $props.event.dates[0].time_end }} {{ __('Uhr') }}
            </template>
            <template v-else>
              <div v-for="(date, index) in $props.event.dates" :key="index">
                <strong>{{ date.date_long }}</strong><br>{{ date.time_start }} – {{ date.time_end }} {{ __('Uhr') }}
              </div>
            </template>
          </template>
        </div>
      </div>
      <div class="stacked-list__col">
        <template v-if="$props.event.online">
          {{ __('Onlinekurs') }}
        </template>
        <template v-else-if="$props.event.location && $props.event.location.description">
          <a :href="$props.event.location.map" target="_blank" :title="__('Karte öffnen')" v-if="$props.event.location.map">
            {{ $props.event.location.description }}
          </a>
          <span v-else>
            {{ $props.event.location.description }}
          </span>
        </template>
        <template v-if="$props.event.experts">
          <div>{{ __('mit') }} {{ $props.event.experts }}</div>
        </template>
        <event-state :event="$props.event" :dashboard="true" />
      </div>
      <div class="stacked-list__col stacked-list__col--action">
        <div>
          <div :class="[$props.event.bookings >= $props.event.max_participants ? 'text-success' : '', '']">
            {{ $props.event.bookings }}&thinsp;/&thinsp;{{ $props.event.max_participants }} Teilnehmer
          </div>
          <template v-if="$props.event.rentals_available">
            {{ $props.event.rentals_booked }}&thinsp;/&thinsp;{{ $props.event.rentals_available }} Mietcomputer
          </template>
        </div>
        <div class="stacked-list__action">
          <slot name="action" />
        </div>
      </div>
    </div>
  </article>
  
  <article :class="`stacked-list-event ${marked}`" data-touch v-else>

    <template v-if="$props.event.isBooked">
      <div class="error-message error-message--booking">
        <strong>{{ __('Du hast bereits eine Buchung für diesen Kurs!') }}</strong>
      </div>
    </template>

    <div>
      <div class="stacked-list__col">

        <div :class="[$slots.icon ? 'sm:flex' : '']">
          <div class="stacked-list__icon" v-if="$slots.icon">
            <slot name="icon" />
          </div>
          <div>
            <h2>
              <a :href="`/${_getLocale()}/${__('kurs')}/${$props.event.course.slug}/${$props.event.course.uuid}`" :title="$props.event.course.title">
                {{ $props.event.course.title }}
              </a>
            </h2>
            <template v-if="$props.event.dates">
              <template v-if="$props.event.dates.length == 1">
                <strong>{{ $props.event.dates[0].date_long }}</strong><br>{{ $props.event.dates[0].time_start }} – {{ $props.event.dates[0].time_end }} {{ __('Uhr') }}
              </template>
              <template v-else>
                <div v-for="(date, index) in $props.event.dates" :key="index">
                  <strong>{{ date.date_long }}</strong><br>{{ date.time_start }} – {{ date.time_end }} {{ __('Uhr') }}
                </div>
              </template>
            </template>
          </div>
        </div>
      </div>
      
      <div class="stacked-list__col">
        
        <template v-if="$props.event.online">
          {{ __('Onlinekurs') }}
        </template>

        <template v-else-if="$props.event.location && $props.event.location.description">
          <a :href="$props.event.location.map" target="_blank" :title="__('Karte öffnen')" v-if="$props.event.location.map">
            {{ $props.event.location.description }}
          </a>
          <span v-else>
            {{ $props.event.location.description }}
          </span>
        </template>

        <template v-if="$props.event.experts && $props.showExperts">
          <div>{{ __('mit') }} {{ $props.event.experts }}</div>
        </template>
        <event-state :event="$props.event" v-if="!$props.is_basket" />
      </div>

      <div :class="[!$slots.action ? 'justify-end' : '', 'stacked-list__col stacked-list__col--action']">
        <div>
          <template v-if="showBookings">
            <div>
              {{ $props.event.bookings }}&thinsp;/&thinsp;{{ $props.event.max_participants }} Teilnehmer
            </div>
          </template>
          <div v-if="$props.showFee">
            <template v-if="$props.event.free_of_charge">
              {{ __('kostenlos') }}
            </template>
            <template v-else>
              <template v-if="$props.booking">
                CHF {{ $props.event.fee - $props.booking.discount_amount | currency }}
              </template>
              <template v-else>
                CHF {{ $props.event.fee | currency }}
              </template>
            </template>
          </div>
        </div>
        <div class="stacked-list__action" v-if="$slots.action">
          <slot name="action" />
        </div>
      </div>

      <!-- Additional row in basket for booked rentals -->
      <template v-if="$props.event.has_rental">
        <div class="stacked-list__col">
          <strong>{{ __('Mietcomputer') }}</strong>
        </div>
        <div class="stacked-list__col">&nbsp;</div>
        <div :class="[!$slots.action ? 'justify-end' : '', 'stacked-list__col stacked-list__col--action']">
          <div>
            <div>CHF 80.00</div>
          </div>
          <div class="stacked-list__action" v-if="$slots.action">
            <a href="" class="btn-secondary btn-auto-w" @click.prevent="removeRentalFromBasket(event.uuid, true)">
              {{ __('Entfernen') }}
            </a>
          </div>
        </div>
      </template>

      <!-- Additional row in basket for rental booking -->
      <template v-if="$slots.rental_booking_action && $props.event.has_rentals && ($props.booking && !$props.booking.has_rental)">
        <div class="span-12">
          <slot name="rental_booking_action" />
        </div>
      </template>

      <!-- Additional row in dashboard for booked rentals -->
      <template v-if="$props.booking && $props.booking.has_rental">
        <div class="stacked-list__col">
          <div :class="[$slots.icon ? 'sm:flex' : '']">
            <div class="stacked-list__icon" v-if="$slots.icon">
              <slot name="icon" />
            </div>
            <div>
              <h2>{{ __('Mietcomputer') }}</h2>
            </div>
          </div>
        </div>
        <div class="stacked-list__col">&nbsp;</div>
        <div class="stacked-list__col flex justify-between">
          <div>CHF 80.00</div>
          <div>
            <div class="stacked-list__action" v-if="$slots.rental_cancel_action">
              <slot name="rental_cancel_action" />
            </div>
          </div>
        </div>
      </template>
      
    </div>
  </article>

</div>
</template>
<script>
import NProgress from 'nprogress';
import i18n from "@/shared/mixins/i18n";
import Helpers from "@/shared/mixins/Helpers";
import Bookmark from "@/shared/mixins/Bookmark";
import Basket from "@/shared/mixins/Basket";
import EventState from "@/shared/components/ui/misc/EventState";
import Notification from "@/shared/components/ui/misc/Notification";
import { template } from 'lodash';

export default {

  components: {
    NProgress,
    EventState,
    Notification
  },

  mixins: [i18n, Bookmark, Helpers, Basket],

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
    
    dashboard: {
      type: [Number, Boolean],
      default: false,
    },

    is_basket: {
      type: [Number, Boolean],
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
    
    showBookings: {
      type: Boolean,
      default: false
    },

    showState: {
      type: Boolean,
      default: false,
    }
  },

  computed: {
    marked() {
      if (this.$props.event.isBooked) {
        return 'has-booking';
      }
    }
  }
}
</script>
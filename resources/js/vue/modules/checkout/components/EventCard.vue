<template>
  <article class="card-event-booking" data-touch>
    <div>
      <div class="card-event__col">
        <div>
          <h2>{{ $props.event.course.title }}</h2>

          <template v-if="$props.event.dates">
            <template v-if="$props.event.dates.length == 1">
              {{ $props.event.dates[0].date }}<span class="sm:hide !md:inline-block">, {{ $props.event.dates[0].time_start }} – {{ $props.event.dates[0].time_end }}</span>
            </template>
            <template v-else>
              <div v-for="(date, index) in $props.event.dates" :key="index">
                {{ date.date }}<span class="sm:hide !md:inline-block">, {{ date.time_start }} – {{ date.time_end }}</span>
              </div>
            </template>
          </template>
          <template v-if="$props.event.experts">
            <div>{{ $props.event.experts }}</div>
          </template>
        </div>
      </div>
      <div class="card-event__col">
        <template v-if="$props.event.online">
          {{ __('Online') }}
        </template>
        <template v-else-if="$props.event.location.description">
          {{ $props.event.location.description }}
        </template>
      </div>
      <div class="card-event__col card-event__col--action">
        <div>
          CHF {{ $props.event.fee}}
        </div>
        <div class="card-event__action">
          <slot />
        </div>
      </div>
    </div>
  </article>
</template>
<script>
import i18n from "@/shared/mixins/i18n";

export default {

  mixins: [i18n],

  props: {
    event: Object,
  },

}
</script>
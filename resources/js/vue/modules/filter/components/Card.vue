<template>
  <article>
    <a href="">
      <header>
        <div class="card__category">
          {{ data.categories }}
        </div>
        <h2 class="card__heading">
          {{ data.title }}
        </h2>
      </header>
      <figure>
        <div>
          <template v-if="data.upcoming">
            <h3>{{ __('Übersicht') }}:</h3>
            <div class="mb-4x sm:mb-6x">
              <ul>
                <li>{{ __('Experte') }}: {{ data.experts}}</li>
                <li>{{ __('ab') }} {{ data.date }}</li>
                <li v-if="data.online">{{ __('Online Schulung')}}</li>
                <li>CHF {{ data.fee }}</li>
              </ul>
            </div>
          </template>
          <div>
            {{ __('Weitere Informationen') }}
          </div>
        </div>
        <img src="/media/dummy-1.png" class="is-responsive">
      </figure>
    </a>
  </article>
</template>
<script>
import i18n from "@/shared/mixins/i18n";

export default {

  mixins: [i18n],

  props: {
    data: {
      type: Object,
      default: false,
    },
  },
}
</script>
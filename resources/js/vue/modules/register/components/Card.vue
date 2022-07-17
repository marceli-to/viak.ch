<template>
  <article>
    <a :href="`/kurs/${data.slug}/${data.uuid}`" :title="data.title">
      <header>
        <div class="card-teaser__category">
          {{ data.categories }}
        </div>
        <h2 class="card-teaser__heading">
          {{ data.title }}
        </h2>
      </header>
      <figure>
        <div>
          <template v-if="data.upcoming">
            <h3>{{ __('Übersicht') }}:</h3>
            <div class="card-teaser__list">
              <ul>
                <li>{{ __('Experte') }}: {{ data.experts}}</li>
                <li>{{ __('ab') }} {{ data.date }}</li>
                <li v-if="data.online">{{ __('Online Schulung')}}</li>
                <li>CHF {{ data.fee }}</li>
              </ul>
            </div>
          </template>
          <div class="card-teaser__more">
            {{ __('Weitere Informationen') }}
          </div>
        </div>
        <img src="/media/dummy-1.jpg" height="600" width="600" class="is-responsive" :alt="data.title">
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
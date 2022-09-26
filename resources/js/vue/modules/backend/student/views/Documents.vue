<template>
  <div>
    <article-text v-if="isFetched">
      <template #aside>
        <h1 class="xs:hide">{{ __('Meine Dokumente') }}</h1>
        <div class="sm:mt-5x md:mt-10x">
          <router-link :to="{ name: 'student-profile' }" class="icon-arrow-right:below" :title="__('Zurück')">
            <span>{{ __('Zurück') }}</span>
            <icon-arrow-right />
          </router-link>
        </div>
      </template>
    </article-text>
  
    <collapsible-container>
      <collapsible>
        <template #title>
          {{ __('Dokumente') }}
        </template>
        <template #content>
          <stacked-list-item>
            <div>
              <div class="sm:span-4">
                <strong>Rechnung 0000094</strong><br>
                06. Juni 2022
              </div>
              <div class="sm:span-4">
                Blender Animationskurs
              </div>
              <div class="sm:span-4">
                <div class="flex justify-between">
                  <div>CHF 960.00</div>
                  <div>
                    <a href="/pdf/rechnung?v=1659123592" target="_blank" class="btn-primary is-outline">Download</a>
                  </div>
                </div>
              </div>
            </div>
          </stacked-list-item>
          <stacked-list-item>
            <div>
              <div class="sm:span-4">
                <strong>Rechnung 0000086</strong><br>
                13. Mai 2022
              </div>
              <div class="sm:span-4">
                Blender Einführungskurs
              </div>
              <div class="sm:span-4">
                <div class="flex justify-between">
                  <div>CHF 700.00</div>
                  <div>
                    <a href="/pdf/rechnung?v=1659123592" target="_blank" class="btn-primary is-outline">Download</a>
                  </div>
                </div>
              </div>
            </div>
          </stacked-list-item>
          <stacked-list-item>
            <div>
              <div class="sm:span-4">
                <strong>Kursbestätigung</strong><br>
                25. Mai 2022
              </div>
              <div class="sm:span-4">
                Blender Einführungskurs
              </div>
              <div class="sm:span-4">
                <div class="flex justify-end">
                  <div>
                    <a href="/pdf/kurs-bestaetigung?v=1659123592" target="_blank" class="btn-primary is-outline">Download</a>
                  </div>
                </div>
              </div>
            </div>
          </stacked-list-item>
        </template>
      </collapsible>
    </collapsible-container>
   </div>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    ArticleText,
    CollapsibleContainer,
    Collapsible,
    StackedListItem,
    IconArrowRight,
  },

  mixins: [ErrorHandling, i18n],

  data() {
    return {
      isFetched: true,

      routes: {
      },
    };
  },

  mounted() {

  },

  methods: {

  },
}
</script>
  
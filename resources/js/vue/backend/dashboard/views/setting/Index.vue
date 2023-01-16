<template>
<div v-if="isLoaded">
  <content-list-header class="flex">
    <h1>Einstellungen</h1>
  </content-list-header>
  <collapsible-container>

    <!-- Categories -->
    <collapsible :expanded="$route.params.type == 'categories' ? true : false" :uuid="'dashboard-settings-categories'">
      <template #title>Kategorien</template>
      <template #content>
        <template v-if="data['categories'].length">
          <stacked-list-item v-for="category in data['categories']" :key="category.id" class="relative">
            <router-link :to="{ name: 'settings-category-edit', params: { id: category.id } }" class="icon-edit mt-3x">
              <icon-edit />
            </router-link>
            <div>
              <div class="span-4">
                {{ category.description.de }}
              </div>
              <div class="span-4" v-if="category.description.en">
                {{ category.description.en }}
              </div>
            </div>
          </stacked-list-item>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Kategorien vorhanden.</p>
        </template>
        <div class="flex justify-start mt-6x">
          <router-link :to="{ name: 'settings-category-create' }" class="icon-plus">
            <icon-plus />
          </router-link>
        </div>
      </template>
    </collapsible>
  
    <!-- Languages -->
    <collapsible :expanded="$route.params.type == 'languages' ? true : false" :uuid="'dashboard-settings-languages'">
      <template #title>Sprachen</template>
      <template #content>
        <template v-if="data['languages'].length">
          <stacked-list-item v-for="language in data['languages']" :key="language.id" class="relative">
          <router-link :to="{ name: 'settings-language-edit', params: { id: language.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              {{ language.description.de }}
            </div>
            <div class="span-4" v-if="language.description.en">
              {{ language.description.en }}
            </div>
          </div>
        </stacked-list-item>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Sprachen vorhanden.</p>
        </template>
        <div class="flex justify-start mt-6x">
          <router-link :to="{ name: 'settings-language-create' }" class="icon-plus">
            <icon-plus />
          </router-link>
        </div>
      </template>
    </collapsible>

    <!-- Levels -->
    <collapsible :expanded="$route.params.type == 'levels' ? true : false" :uuid="'dashboard-settings-levels'">
      <template #title>Levels</template>
      <template #content>
        <template v-if="data['levels'].length">
          <stacked-list-item v-for="levels in data['levels']" :key="levels.id" class="relative">
          <router-link :to="{ name: 'settings-level-edit', params: { id: levels.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              {{ levels.description.de }}
            </div>
            <div class="span-4" v-if="levels.description.en">
              {{ levels.description.en }}
            </div>
          </div>
        </stacked-list-item>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Levels vorhanden.</p>
        </template>
        <div class="flex justify-start mt-6x">
          <router-link :to="{ name: 'settings-level-create' }" class="icon-plus">
            <icon-plus />
          </router-link>
        </div>
      </template>
    </collapsible>

    <!-- Software -->
    <collapsible :expanded="$route.params.type == 'software' ? true : false" :uuid="'dashboard-settings-software'">
      <template #title>Software</template>
      <template #content>
        <template v-if="data['software'].length">
          <stacked-list-item v-for="software in data['software']" :key="software.id" class="relative">
          <router-link :to="{ name: 'settings-software-edit', params: { id: software.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              {{ software.description.de }}
            </div>
            <div class="span-4" v-if="software.description.en">
              {{ software.description.en }}
            </div>
          </div>
        </stacked-list-item>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Software vorhanden.</p>
        </template>
        <div class="flex justify-start mt-6x">
          <router-link :to="{ name: 'settings-software-create' }" class="icon-plus">
            <icon-plus />
          </router-link>
        </div>
      </template>
    </collapsible>

    <!-- Tags -->
    <collapsible :expanded="$route.params.type == 'tags' ? true : false" :uuid="'dashboard-settings-tags'">
      <template #title>Tags</template>
      <template #content>
        <template v-if="data['tags'].length">
          <stacked-list-item v-for="tag in data['tags']" :key="tag.id" class="relative">
          <router-link :to="{ name: 'settings-tag-edit', params: { id: tag.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              {{ tag.description.de }}
            </div>
            <div class="span-4" v-if="tag.description.en">
              {{ tag.description.en }}
            </div>
          </div>
        </stacked-list-item>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Tags vorhanden.</p>
        </template>
        <div class="flex justify-start mt-6x">
          <router-link :to="{ name: 'settings-tag-create' }" class="icon-plus">
            <icon-plus />
          </router-link>
        </div>
      </template>
    </collapsible>

    <!-- Locations -->
    <collapsible :expanded="$route.params.type == 'locations' ? true : false" :uuid="'dashboard-settings-locations'">
      <template #title>Locations</template>
      <template #content>
        <template v-if="data['locations'].length">
          <stacked-list-item v-for="location in data['locations']" :key="location.id" class="relative">
          <router-link :to="{ name: 'settings-location-edit', params: { id: location.id } }" class="icon-edit mt-3x">
            <icon-edit />
          </router-link>
          <div>
            <div class="span-4">
              {{ location.description.de }}
            </div>
            <div class="span-4" v-if="location.description.en">
              {{ location.description.en }}
            </div>
          </div>
        </stacked-list-item>
        </template>
        <template v-else>
          <p class="no-results">Es sind keine Locations vorhanden.</p>
        </template>
        <div class="flex justify-start mt-6x">
          <router-link :to="{ name: 'settings-location-create' }" class="icon-plus">
            <icon-plus />
          </router-link>
        </div>
      </template>
    </collapsible>

  </collapsible-container>
</div>
</template>
<script>
import NProgress from 'nprogress';
import ContentListHeader from "@/shared/components/ui/layout/ContentListHeader.vue";
import SearchContainer from "@/shared/components/ui/form/Search.vue";
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";

export default {

  components: {
    NProgress,
    ContentListHeader,
    SearchContainer,
    StackedListContainer,
    StackedListItem,
    StackedListHeader,
    StackedListFooter,
    CollapsibleContainer,
    Collapsible,
    IconEdit,
    IconPlus
  },

  mixins: [],

  data() {
    return {

      data: {},


      // Routes
      routes: {
        categories: {
          get: '/api/dashboard/settings/categories',
          store: '/api/dashboard/settings/category',
          delete: '/api/dashboard/settings/category',
        },
        languages: {
          get: '/api/dashboard/settings/languages',
          store: '/api/dashboard/settings/language',
          delete: '/api/dashboard/settings/language',
        },
        levels: {
          get: '/api/dashboard/settings/levels',
          store: '/api/dashboard/settings/levels',
          delete: '/api/dashboard/settings/levels',
        },
        software: {
          get: '/api/dashboard/settings/softwares',
          store: '/api/dashboard/settings/software',
          delete: '/api/dashboard/settings/software',
        },
        tags: {
          get: '/api/dashboard/settings/tags',
          store: '/api/dashboard/settings/tags',
          delete: '/api/dashboard/settings/tags',
        },
        locations: {
          get: '/api/dashboard/settings/locations',
          store: '/api/dashboard/settings/locations',
          delete: '/api/dashboard/settings/locations',
        },
      },

      // States
      isLoaded: false,

      // Messages
      messages: {
        emptyData: 'Es sind noch keine Daten vorhanden...',
        confirm: 'Bitte löschen bestätigen.',
        updated: 'Daten aktualisiert',
      }
    };
  },

  created() {
    this.fetch();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.isLoaded = false;
      this.axios.all([
        this.axios.get(this.routes.categories.get),
        this.axios.get(this.routes.languages.get),
        this.axios.get(this.routes.levels.get),
        this.axios.get(this.routes.software.get),
        this.axios.get(this.routes.tags.get),
        this.axios.get(this.routes.locations.get),
      ]).then(axios.spread((...responses) => {
        this.data = {
          categories: responses[0].data.data,
          languages: responses[1].data.data,
          levels: responses[2].data.data,
          software: responses[3].data.data,
          tags: responses[4].data.data,
          locations: responses[5].data.data,
        };
        this.isLoaded = true;
        NProgress.done();
      }));
    },
  },

}
</script>
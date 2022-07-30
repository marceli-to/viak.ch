<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide" v-html="title"></h1>
      <div class="sm:mt-6x">
        <router-link :to="{ name: 'courses' }" class="icon-arrow-right:below is-small">
          <span>Zurück</span>
          <icon-arrow-right :size="'sm'" />
        </router-link>
      </div>
    </template>
    <template #content>

      <!-- Event -->
      <form-group :label="'Deadline Anmeldung'" :required="true" :error="errors.registration_until">
        <the-mask
          type="text"
          mask="##.##.####"
          :masked="true"
          name="registration_until"
          placeholder="dd.mm.YYYY"
          v-model="data.registration_until">
        </the-mask>
      </form-group>
      <grid class="sm:grid-cols-12">
        <form-group :label="'min. Teilnehmer'" :required="true" :error="errors.min_participants" class="span-6">
          <input 
            type="number" 
            v-model="data.min_participants"
            required 
            @focus="removeError('min_participants')" />
        </form-group>
        <form-group :label="'max. Teilnehmer'" :required="true" :error="errors.max_participants" class="span-6">
          <input 
            type="number" 
            v-model="data.max_participants"
            required 
            @focus="removeError('max_participants')" />
        </form-group>
      </grid>
      <form-group :label="'Kosten'">
        <input 
          type="number" 
          v-model="data.fee" />
      </form-group>
      <form-group class="has-underline flex mt-8x">
        <div class="mr-16x md:mr-20x">
          <div class="form-group__checkbox">
            <input type="checkbox" id="online" name="online" :value="1" v-model="data.online">
            <label for="online">Online</label>
          </div>
        </div>
        <div>
          <div class="form-group__checkbox">
            <input type="checkbox" id="publish" name="publish" :value="1" v-model="data.publish">
            <label for="publish">Publizieren</label>
          </div>
        </div>
      </form-group>
      <form-group 
        :label="'Ort'" 
        :required="true" 
        :error="errors.location_id"
        v-if="isFetchedSettings">
        <div class="select-wrapper">
          <select v-model="data.location_id" @change="removeError('location_id')">
            <option 
              v-for="(option) in settings.locations" 
              :key="option.id" 
              :value="option.id">
              {{option.description.de}}
            </option>
          </select>
        </div>
      </form-group>

      <!-- Event dates -->
      <form-group-header class="mt-8x" :error="errors.dates">
        <h3><strong>Veranstaltungsdaten</strong></h3>
      </form-group-header>
      <div v-for="(date, index) in data.dates" :key="date.id">
        <grid class="flex items-center justify-between">
          <form-group :label="'Datum'" class="mr-8x">
            <the-mask
              type="text"
              mask="##.##.####"
              :masked="true"
              placeholder="dd.mm.YYYY"
              v-model="data.dates[index].date_short">
            </the-mask>
          </form-group>
          <form-group :label="'von'" class="mr-8x">
            <the-mask
              type="text"
              mask="##.##"
              :masked="true"
              placeholder="hh.mm"
              v-model="data.dates[index].time_start">
            </the-mask>
          </form-group>
          <form-group :label="'bis'" class="mr-8x">
            <the-mask
              type="text"
              mask="##.##"
              :masked="true"
              placeholder="hh.mm"
              v-model="data.dates[index].time_end">
            </the-mask>
          </form-group>
          <div class="flex justify-end">
            <a href="" class="icon-trash mb-3x" @click.prevent="removeDate(index)">
              <icon-trash />
            </a>
          </div>
        </grid>
      </div>
      <form-group class="flex justify-center has-underline">
        <a href="" class="icon-plus" @click.prevent="addDate()">
          <icon-plus :size="'lg'" />
        </a>
      </form-group>

      <!-- Event experts -->
      <form-group-header class="mt-8x">
        <h3><strong>Experten</strong></h3>
      </form-group-header>
      <form-group class="has-underline grid-cols-12 grid-row-gap-none" v-if="isFetchedSettings" :error="errors.expert_ids">
        <div class="form-group__checkbox span-6" v-for="(expert, index) in sorted(settings.experts, 'firstname', 'asc')" :key="index">
          <input type="checkbox" :id="`expert-${expert.id}`" :name="`expert-${expert.id}`" :value="expert.id" v-model="data.expert_ids">
          <label :for="`expert-${expert.id}`">
            {{ expert.fullname }}
          </label>
        </div>
      </form-group>
      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
          Speichern
        </a>
      </form-group>
      <div class="form-danger-zone" v-if="$props.type == 'edit'">
        <h2>Veranstaltung löschen</h2>
        <p>Mit dieser Aktion wird die Veranstaltung gelöscht. Für den Kurs angemeldete Studenten werden per Mail informiert.</p>
        <a href="" class="btn-danger" @click.prevent="destroy()">Löschen</a>
      </div>
    </template>
  </article-text>
</form>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import { TheMask } from "vue-the-mask";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconTrash from "@/shared/components/ui/icons/Trash.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";

export default {
  components: {
    NProgress,
    ArticleText,
    FormGroup,
    FormGroupHeader,
    IconArrowRight,
    IconTrash,
    IconPlus,
    CollapsibleContainer,
    Collapsible,
    Grid,
    GridCol,
    TheMask
  },

  mixins: [ErrorHandling],

  props: {

    type: {
      type: String,
      default: 'create',
    },

    courseId: {
      type: [Number, String],
      default: null,
    }
  },

  data() {
    return {
      
      // Model
      data: {
        registration_until: null,
        min_participants: null,
        max_participants: null,
        fee: null,
        dates: [],
        location_id: 1,
        expert_ids: [],
      },

      // Validation
      errors: {
        min_participants: null,
        max_participants: null,
        expert_ids: null,
        dates: null,
      },

      // Settings
      settings: {
        experts: [],
        locations: [],
      },

      // Routes
      routes: {
        find: '/api/dashboard/event',
        store: '/api/dashboard/event',
        update: '/api/dashboard/event',
        delete: '/api/dashboard/event',
        settings: '/api/dashboard/event-settings',
      },

      // States
      isFetched: false,
      isFetchedSettings: false,
      isLoading: false,

      // Messages
      messages: {
        emptyData: 'Es sind noch keine Daten vorhanden...',
        stored: 'Daten erfasst!',
        updated: 'Daten aktualisiert!',
      },
    };
  },

  created() {
    if (this.$props.type == 'edit') {
      this.fetch();
    }
    if (this.$props.type == 'create') {
      this.isFetched = true;
    }
    this.fetchSettings();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.axios.get(`${this.routes.find}/${this.$route.params.eventId}`).then(response => {
        this.data = response.data;
        this.isFetched = true;
        NProgress.done();
      });
    },

    fetchSettings() {
      this.isFetchedSettings = false;
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.settings = response.data;
        this.isFetchedSettings = true;
      });
    },

    submit() {
      if (this.$props.type == 'edit') {
        this.update();
      }

      if (this.$props.type == 'create') {
        this.store();
      }
    },

    store() {
      NProgress.start();
      this.isLoading = true;
      this.data.course_id = this.$route.params.courseId;
      this.axios.post(this.routes.store, this.data).then(response => {
        this.$router.push({ name: "courses"});
        NProgress.done();
        this.isLoading = true;
      });
    },

    update() {
      this.axios.put(`${this.routes.update}/${this.$route.params.eventId}`, this.data).then(response => {
        this.$router.push({ name: "courses"});
      });
    },

    destroy() {
      if (confirm('Sicher?')) {
        this.isLoading = true;
        NProgress.start();
        this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
          this.$router.push({ name: 'courses'});
          this.isLoading = false;
          NProgress.done();
        });
      }
    },

    addDate() {
      this.data.dates.push({
        event_id: this.data.id,
        date_short: null,
        time_start: null,
        time_end: null
      });
    },

    removeDate(index) {
      this.data.dates.splice(index, 1);
    },

    sorted(data, by, dir){
      return _.orderBy(data, by, dir);
    }
  },

  computed: {
    title() {
      return this.$props.type == 'edit' ? `Veranstaltung für<br>${this.data.course.title.de}` : "Veranstaltung hinzufügen";
    },
  }
};
</script>

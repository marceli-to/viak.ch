<template>
<form @submit.prevent="submit" v-if="isFetched">
  <article-text>
    <template #aside>
      <h1 class="xs:hide" v-html="title"></h1>
      <template v-if="$route.params.referrer">
        <div class="sm:mt-5x md:mt-10x">
          <router-link :to="{ name: 'events', params: { courseUuid: data.course.uuid }  }" class="icon-arrow-right">
            <span>{{ __('Zurück') }}</span>
            <icon-arrow-left />
          </router-link>
        </div>
      </template>
      <template v-else>
        <back-link :route="'courses'"></back-link>
      </template>
    </template>
    <template #content>

      <form :class="[data.is_past ? 'is-disabled' : '']">

        <!-- Event -->
        <form-group :label="'Deadline Anmeldung'">
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
              @focus="removeValidationError('min_participants')" />
          </form-group>
          
          <form-group :label="'max. Teilnehmer'" :required="true" :error="errors.max_participants" class="span-6">
            <input 
              type="number" 
              v-model="data.max_participants"
              required 
              @focus="removeValidationError('max_participants')" />
          </form-group>
        </grid>

        <form-group :label="'Verfügbare Mietcomputer'">
          <input 
            type="number" 
            v-model="data.rentals_available" />
        </form-group>

        <form-group :label="'Kosten'">
          <input 
            type="number" 
            v-model="data.fee" />
        </form-group>

        <form-group class="line-after flex mt-8x">
          <div class="mr-16x md:mr-20x">
            <div class="form-group__checkbox">
              <input type="checkbox" id="online" name="online" :value="1" v-model="data.online">
              <label for="online">Onlinekurs</label>
            </div>
          </div>
          <div class="mr-16x md:mr-20x">
            <div class="form-group__checkbox">
              <input type="checkbox" id="free_of_charge" name="free_of_charge" :value="1" v-model="data.free_of_charge">
              <label for="free_of_charge">Gratiskurs</label>
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
            <select v-model="data.location_id" @change="removeValidationError('location_id')">
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
        <form-group class="flex justify-center line-after">
          <a href="" class="icon-plus" @click.prevent="addDate()">
            <icon-plus :size="'lg'" />
          </a>
        </form-group>

        <!-- Event experts -->
        <form-group-header class="mt-8x">
          <h3><strong>Experten</strong></h3>
        </form-group-header>
        <form-group class="line-after grid-cols-12 grid-row-gap-none" v-if="isFetchedSettings" :error="errors.expert_ids">
          <div class="form-group__checkbox span-6" v-for="(expert, index) in sorted(settings.experts, 'firstname', 'asc')" :key="index">
            <input type="checkbox" :id="`expert-${expert.id}`" :name="`expert-${expert.id}`" :value="expert.id" v-model="data.expert_ids">
            <label :for="`expert-${expert.id}`">
              {{ expert.fullname }}
            </label>
          </div>
        </form-group>
        <form-group>
          <a href="" @click.prevent="submit()" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary']">
            Speichern
          </a>
        </form-group>
      </form>

      <template v-if="$props.type == 'edit'">
        <template v-if="data.is_cancelled">

          <danger-zone :type="'warning'">
            <template #content>
              <h2>Veranstaltung abgesagt</h2>
              <p>Diese Veranstaltung wurde am {{ data.cancelled_at }} abgesagt.</p>
            </template>
          </danger-zone>

        </template>
        <template v-else>

          <danger-zone :type="'success'">
            <template #content v-if="data.is_confirmed">
              <h2>Veranstaltung bestätigt</h2>
              <p>Diese Veranstaltung wurde am {{ data.confirmed_at }} bestätigt.</p>
            </template>
            <template #content v-else>
              <h2>Veranstaltung bestätigen</h2>
              <p>Mit dieser Aktion wird die Durchführung der Veranstaltung bestätigt. Die Teilnehmer und Experten werden per E-Mail informiert.</p>
              <a href="" class="btn-success" @click.prevent="confirmConfirmation()">Bestätigen</a>
            </template>
          </danger-zone>

          <danger-zone :type="'success'" v-if="data.is_past" class="mb-6x">
            <template #content v-if="data.is_closed">
              <h2>Veranstaltung abgeschlossen</h2>
              <p>Diese Veranstaltung wurde am {{ data.closed_at }} abgeschlossen.</p>
            </template>
            <template #content v-else>
              <h2>Veranstaltung abschliessen</h2>
              <p>Mit dieser Aktion wird die Veranstaltung bestätigt geschlossen. Die Teilnehmer und Experten werden per E-Mail informiert und erhalten eine Teilnahmebestätigung.</p>
              <a href="" class="btn-success" @click.prevent="confirmClosing()">Schliessen</a>
            </template>
          </danger-zone>

          <danger-zone :type="'warning'" v-if="!data.is_past">
            <template #content>
              <h2>Veranstaltung absagen</h2>
              <p>Mit dieser Aktion wird die Veranstaltung abgesagt. Für den Kurs angemeldete Studenten werden per Mail informiert.</p>
              <a href="" class="btn-warning" @click.prevent="confirmCancellation()">Absagen</a>
            </template>
          </danger-zone>

          <danger-zone :type="'danger'" v-if="!data.is_past">
            <template #content v-if="data.bookings.length">
              <h2>Veranstaltung löschen</h2>
              Diese Veranstaltng kann nicht gelöscht werden, da 
              <router-link :to="{ name: 'event-show', params: { uuid: data.uuid } }"><strong>{{ data.bookings.length }}</strong> Buchung(en)</router-link>
              vorhanden sind.
            </template>
            <template #content v-else>
              <h2>Veranstaltung löschen</h2>
              <p>Mit dieser Aktion wird die Veranstaltung gelöscht.</p>
              <a href="" class="btn-danger" @click.prevent="confirmDestroy()">Löschen</a>
            </template>
          </danger-zone>

        </template>
      </template>

    </template>
  </article-text>

  <notification ref="notification">
    <template #actions>
      <a href="javascript:;" @click="confirm()" class="btn-primary">Bestätigen</a>
      <a href="javascript:;" @click="$refs.notification.hide()" class="btn-secondary">Abbrechen</a>
    </template>
  </notification>
</form>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import i18n from "@/shared/mixins/i18n";
import Helpers from "@/shared/mixins/Helpers";
import { TheMask } from "vue-the-mask";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import DangerZone from "@/shared/components/ui/form/DangerZone.vue";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconTrash from "@/shared/components/ui/icons/Trash.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";
import BackLink from "@/shared/components/ui/misc/BackLink.vue";

export default {
  components: {
    NProgress,
    ArticleText,
    FormGroup,
    FormGroupHeader,
    DangerZone,
    BackLink,
    IconTrash,
    IconPlus,
    IconArrowLeft,
    CollapsibleContainer,
    Collapsible,
    Grid,
    GridCol,
    TheMask
  },

  mixins: [Validation, Helpers, i18n],

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
        rentals_available: 0,
        fee: null,
        free_of_charge: 0,
        dates: [],
        location_id: 1,
        expert_ids: [],
        bookings: [],
        confirmed: 0,
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
        confirm: '/api/dashboard/event/confirm',
        cancel: '/api/dashboard/event/cancel',
        close: '/api/dashboard/event/close',
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
      this.axios.get(`${this.routes.find}/${this.$route.params.uuid}`).then(response => {
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
      this.$store.commit('isLoading', true); 
      this.data.course_id = this.$route.params.courseId;
      this.axios.post(this.routes.store, this.data).then(response => {
        this.$router.push({ name: 'courses' });
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    update() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.update}/${this.$route.params.uuid}`, this.data).then(response => {
        this.$router.push({ name: 'courses' });
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    destroyEvent() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.delete(`${this.routes.delete}/${this.data.id}`).then(response => {
        this.$router.push({ name: 'courses' });
        this.actionToBeConfirmed = null;  
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    confirmEvent() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.confirm}/${this.$route.params.uuid}`, this.data).then(response => {
        this.$toast.open(this.__('Die Veranstaltung ist bestätigt'));
        this.data.is_confirmed = 1;
        this.actionToBeConfirmed = null;  
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    cancelEvent() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.cancel}/${this.$route.params.uuid}`, this.data).then(response => {
        this.$toast.open(this.__('Die Veranstaltung ist abgesagt'));
        this.data.is_cancelled = 1;
        this.actionToBeConfirmed = null;  
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    closeEvent() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.close}/${this.$route.params.uuid}`, this.data).then(response => {
        this.$toast.open(this.__('Die Veranstaltung ist geschlossen'));
        this.data.is_closed = 1;
        this.actionToBeConfirmed = null;  
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    confirm() {
      if (this.actionToBeConfirmed == 'destroy') {
        this.destroyEvent();
      }
      if (this.actionToBeConfirmed == 'cancel') {
        this.cancelEvent();
      }
      if (this.actionToBeConfirmed == 'confirm') {
        this.confirmEvent();
      }
      if (this.actionToBeConfirmed == 'close') {
        this.closeEvent();
      }
    },

    confirmDestroy() {
      this.actionToBeConfirmed = 'destroy';
      this.$refs.notification.init({
        message: 'Bitte «Veranstaltung löschen» bestätigen!',
        type: 'dialog',
        style: 'info',
      });
    },
    
    confirmConfirmation() {
      this.actionToBeConfirmed = 'confirm';
      this.$refs.notification.init({
        message: 'Bitte «Veranstaltung bestätigen» bestätigen!',
        type: 'dialog',
        style: 'info',
      });
    },

    confirmCancellation() {
      this.actionToBeConfirmed = 'cancel';
      this.$refs.notification.init({
        message: 'Bitte «Veranstaltung absagen» bestätigen!',
        type: 'dialog',
        style: 'info',
      });
    },

    confirmClosing() {
      this.actionToBeConfirmed = 'close';
      this.$refs.notification.init({
        message: 'Bitte «Veranstaltung schliessen bestätigen!',
        type: 'dialog',
        style: 'info',
      });
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

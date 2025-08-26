<template>
  <div v-if="isFetched">
    <article-text class="content-text">
      <template #aside>
        <h1>{{ data.event.course.title }}</h1>
        <template v-if="$route.params.referrer">
          <div class="sm:mt-5x md:mt-10x">
            <router-link :to="{ name: 'events', params: { courseUuid: data.event.course.uuid }  }" class="icon-arrow-right">
              <span>{{ __('Zurück') }}</span>
              <icon-arrow-left />
            </router-link>
          </div>
        </template>
        <template v-else>
          <back-link :route="'courses'"></back-link>
        </template>
      </template>
    </article-text>

    <collapsible-container>
      <collapsible :expanded="true" :uuid="'dashboard-course-event-info'">
        <template #title>
          {{ __('Informationen') }}
        </template>
        <template #content>
          <stacked-list-event 
            :event="data.event" 
            :showFee="false"
            :showState="true"
            :dashboard="true">
          </stacked-list-event>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible :items="data.participants" :expanded="false" :uuid="'dashboard-course-event-participants'">
        <template #title>
          {{ __('Teilnehmer') }}
        </template>
        <template #content>
          <template v-if="data.participants.length">
            <div class="flex justify-end mt-3x sm:mt-6x" v-if="!data.event.is_cancelled">
              Teilgenommen?
            </div>
            <stacked-list-item v-for="(participant, index) in data.participants" :key="index" :class="[index == 0 ? 'mt-2x sm:mt-2x md:mt-3x' : '', '']">
              <div>
                <div class="sm:span-3 md:span-2">{{ participant.fullname }}</div>
                <div class="sm:span-2 md:span-2">{{ participant.city }}</div>
                <div class="sm:span-2 md:span-2">
                  <template v-if="participant.company">
                    {{ participant.company }}
                  </template>
                  <template v-else-if="participant.invoice_address && participant.invoice_address.company">
                    {{ participant.invoice_address.company }}
                  </template>
                </div>
                <div class="sm:span-3 md:span-3">
                  <a :href="`mailto:${participant.email}`">{{ participant.email }}</a>
                </div>
                <div class="sm:span-1">
                  <template v-if="participant.hasRental">
                    Mietcomputer
                  </template>
                </div>
                <div class="sm:span-1 md:span-2 flex justify-end mr-2x">
                  <template v-if="!data.event.is_cancelled">
                    <div class="form-group__checkbox" v-if="!data.event.is_closed">
                      <input type="checkbox" :id="participant.uuid" :name="participant.uuid" :checked="participant.hasParticipated ? true : false" :value="1" @change="updateAttendance(participant.uuid)">
                    </div>
                    <div v-else>
                      <strong>{{ participant.hasParticipated ? 'Ja' : 'Nein' }}</strong>
                    </div>
                  </template>
                </div>
              </div>
            </stacked-list-item>
            <div class="mt-5x sm:mt-10x flex justify-between" v-if="!data.event.is_cancelled">
              <a href="javascript:;" @click="showBookingDialog" class="icon-plus icon-plus--label">
                <span>{{ __('Teilnehmer hinzufügen') }}</span>
                <IconPlus />
              </a>
              <a :href="`/pdf/teilnehmer-liste/${data.event.uuid}?v=${randomString()}`" target="_blank" class="icon-arrow-right:below" :title="__('Download Teilnehmerliste')">
                <span>{{ __('Teilnehmerliste (PDF)') }}</span>
                <icon-arrow-right />
              </a>
            </div>
          </template>
          <template v-else>
            <p class="no-results">
              {{ __('Es sind keine Anmeldungen für diesen Kurs vorhanden.') }}
            </p>
          </template>
        </template>
        <template #action>
          <div class="mt-5x">
            <a href="javascript:;" @click="showBookingDialog">
              <IconPlus />
            </a>
          </div>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container v-if="data.participants.length">
      <collapsible :items="data.messages" :uuid="'dashboard-course-event-messages'">
        <template #title>
          {{ __('Nachrichten') }}
        </template>
        <template #content>
          <messages 
            :messages="data.messages" 
            :eventUuid="data.event.uuid"
            :canCreate="true"
            :routeCreate="'event-message-create'">
          </messages>
        </template>
      </collapsible>
    </collapsible-container>

    <collapsible-container>
      <collapsible :items="data.files" :uuid="'dashboard-course-event-files'">
        <template #title>
          {{ __('Kurs-Dokumente') }}
        </template>
        <template #content>
          <template v-if="data.files.length">
            <stacked-list-item v-for="(file, index) in data.files" :key="index">
              <list-item-file :file="file">
                <template #action>
                  <button-file-delete 
                    :file="file"
                    @fileDeleted="fileDeleted($event)"
                    v-if="file.belongs_to_message == false" />
                </template>
              </list-item-file>
            </stacked-list-item>
          </template>
          <template v-else>
            <p class="no-results">
              {{ __('Es sind keine Dokumente vorhanden.') }}
            </p>
          </template>
          <div class="mt-6x">
            <router-link :to="{ name: 'event-file-create' }" class="icon-plus">
              <icon-plus />
            </router-link>
          </div>
        </template>
      </collapsible>
    </collapsible-container>

    <!-- Add Student Dialog -->
    <notification ref="bookingDialog" type="dialog">
      <template #text>
        <div class="min-w-250px">

          <form-group class="mb-0">
            <input 
              type="text" 
              v-model="searchKeyword" 
              @input="searchStudents"
              class="is-small"
              :placeholder="__('Name oder Vorname eingeben...')">
          </form-group>
          
          <div class="mt-4x" v-if="searchResults.length > 0">
            <form-group class="mb-0">
              <div class="select-wrapper">
                <select v-model="selectedStudent">
                  <option 
                    v-for="student in searchResults" 
                    :key="student.id"
                    :value="student">
                    {{ student.fullname }}, {{ student.city }}
                  </option>
                </select>
              </div>
            </form-group>
          </div>
          
          <div class="mt-4x" v-if="searchKeyword && !isSearching && searchResults.length === 0">
            <p>{{ __('Keine Studenten gefunden') }}</p>
          </div>
        </div>
      </template>
      
      <template #actions>
        <button 
          @click="addSelectedStudent" 
          :disabled="!selectedStudent || isAddingStudent"
          class="btn-primary">
          {{ isAddingStudent ? __('Speichern...') : __('Hinzufügen') }}
        </button>
        <button @click="hideBookingDialog" class="btn-secondary">
          {{ __('Abbrechen') }}
        </button>
      </template>
    </notification>

  </div>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import i18n from "@/shared/mixins/i18n";
import Helpers from "@/shared/mixins/Helpers";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import ListItemFile from "@/shared/modules/files/components/ListItem.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";
import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";
import Messages from "@/shared/modules/messages/Index.vue";
import ButtonFileDelete from "@/shared/modules/files/components/ButtonDelete.vue";
import BackLink from '@/shared/components/ui/misc/BackLink.vue';
import FormGroup from '@/shared/components/ui/form/FormGroup.vue';

export default {

  components: {
    NProgress,
    ArticleText,
    StackedListEvent,
    StackedListItem,
    ListItemFile,
    CollapsibleContainer,
    Collapsible,
    IconArrowRight,
    IconArrowLeft,
    IconCheckmark,
    IconPlus,
    Messages,
    ButtonFileDelete,
    BackLink,
    FormGroup
  },

  mixins: [Validation, i18n, Helpers],

  data() {
    return {

      data: [],

      isFetched: false,

      // Add student dialog data
      searchKeyword: '',
      searchResults: [],
      selectedStudent: null,
      isSearching: false,
      isAddingStudent: false,
      searchTimeout: null,

      routes: {
        show: '/api/expert/course/event',
        updateParticipation: '/api/booking/participation',
        searchStudents: '/api/dashboard/students/search',
        booking: '/api/dashboard/booking'
      },
    };
  },

  mounted() {
    this.fetch();
  },

  methods: {

    fetch() {
      NProgress.start();
      this.isFetched = false;
      this.axios.get(`${this.routes.show}/${this.$route.params.uuid}`).then(response => {
        this.data = response.data;
        console.log(this.data);
        this.isFetched = true;
      });
    },

    fileDeleted(file) {
      const index = this.data.files.findIndex(x => x.uuid === file.uuid);
      if (index > -1) {
        this.data.files.splice(index, 1);
      }
      this.$toast.open(this.__('Datei entfernt'));
    },

    updateAttendance(uuid) {
      const data = {
        user_uuid: uuid,
        event_uuid: this.$route.params.uuid
      };
      this.axios.post(`${this.routes.updateParticipation}`, data).then(response => {
        this.$toast.open(this.__('Teilnahme angepasst'));
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    showBookingDialog() {
      this.resetDialog();
      this.$refs.bookingDialog.init({
        message: this.__('Teilnehmer hinzufügen'),
        type: 'dialog',
        style: 'info'
      });
    },

    hideBookingDialog() {
      this.$refs.bookingDialog.hide();
      this.resetDialog();
    },

    resetDialog() {
      this.searchKeyword = '';
      this.searchResults = [];
      this.selectedStudent = null;
      this.isSearching = false;
      this.isAddingStudent = false;
      if (this.searchTimeout) {
        clearTimeout(this.searchTimeout);
      }
    },

    searchStudents() {
      if (this.searchTimeout) {
        clearTimeout(this.searchTimeout);
      }

      if (this.searchKeyword.length < 2) {
        this.searchResults = [];
        return;
      }

      this.isSearching = true;
      this.searchTimeout = setTimeout(() => {
        this.axios.get(`${this.routes.searchStudents}/${encodeURIComponent(this.searchKeyword)}`)
          .then(response => {
            this.searchResults = response.data.data || [];
            // Auto-select the first student if multiple results are found
            if (this.searchResults.length > 0) {
              this.selectedStudent = this.searchResults[0];
            }
            this.isSearching = false;
          })
          .catch(error => {
            console.error('Search error:', error);
            this.searchResults = [];
            this.selectedStudent = null;
            this.isSearching = false;
          });
      }, 300);
    },

    selectStudent(student) {
      this.selectedStudent = student;
    },

    addSelectedStudent() {
      if (!this.selectedStudent) return;

      this.isAddingStudent = true;
      const data = {
        event_uuid: this.$route.params.uuid,
        user_uuid: this.selectedStudent.uuid
      };

      this.axios.post(this.routes.booking, data)
        .then(response => {
          this.$toast.open(this.__('Buchung erstellt'));
          this.hideBookingDialog();
          this.fetch(); // Refresh the participant list
        })
        .catch(error => {
          this.isAddingStudent = false;
          if (error.response && error.response.data && error.response.data.message) {
            this.$toast.open(error.response.data.message);
            this.hideBookingDialog();
          } else {
            this.$toast.open(this.__('Fehler beim Erstellen der Buchung'));
          }
        });
    }
  },
}
</script>
  
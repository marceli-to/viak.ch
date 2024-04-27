<template>
  <div>
    <div v-if="isFetched">
      <article-text>
        <template #aside>
          <h1 class="xs:hide">Profil Student</h1>
          <back-link :route="'students'"></back-link>
        </template>

        <template #content>
          <div>
            <p><pre v-html="user.address"></pre></p>
            <p><a :href="`mailto:${user.email}`">{{ user.email }}</a></p>
          </div>
        </template>
      </article-text>
  
      <collapsible-container>

        
        <collapsible :expanded="true" :items="user.events" :uuid="'student-bookings'">
          <template #title>
            {{ __('Gebuchte Kurse') }}
          </template>
          <template #content>
            <div v-if="user.events && user.events.length > 0">
              <div v-for="(booking, index) in user.events" :key="index">
                <stacked-list-event 
                  :event="booking.event" 
                  :booking="booking"
                  :showState="true">
                  <template #icon>
                    <icon-checkmark />
                  </template>
                  <template #action>
                    <a href="" class="btn-secondary btn-auto-w" @click.prevent="confirmBookingCancellation(booking.uuid, booking)">
                      {{ __('Annullieren') }}
                    </a>
                  </template>
                </stacked-list-event>
              </div>
            </div>
            <div v-else>
              <p class="no-results">{{ __('Student hat noch keine gebuchten Kurse.') }}</p>
            </div>
          </template>
        </collapsible>
        
        <collapsible :items="user.events_participated" :uuid="'student-bookings-concluded'">
          <template #title>
            {{ __('Absolvierte Kurse') }}
          </template>
          <template #content>
            <div v-if="user.events_participated && user.events_participated.length > 0">
              <div v-for="(booking, index) in user.events_participated" :key="index">
                <stacked-list-event 
                  :event="booking.event" 
                  :booking="booking"
                  :showState="true">
                  <template #icon>
                    <icon-checkmark />
                  </template>
                </stacked-list-event>
              </div>
            </div>
            <div v-else>
              <p class="no-results">{{ __('Student hat noch keine absolvierten Kurse.') }}</p>
            </div>
          </template>
        </collapsible>
      </collapsible-container>
  
      <collapsible-container>
        <collapsible :uuid="'student-documents'" :items="user.documents">
          <template #title>
            {{ __('Dokumente') }}
          </template>
          <template #content>
            <div v-if="user.documents && user.documents.length > 0">
              <stacked-list-document 
                v-for="document in user.documents" 
                :key="document.uuid" 
                :document="document">
              </stacked-list-document>
  
              <div class="mt-4x">
                <router-link :to="{name: `student-documents`, params: { id: user.id }}" class="link-helper">
                  <span>{{ __('Alle Dokumente anzeigen') }}</span>
                  <icon-arrow-right />
                </router-link>
              </div>
            </div>
            <div v-else>
              <p class="no-results">{{ __('Es sind noch keine Dokumente vorhanden.') }}</p>
            </div>
          </template>
        </collapsible>
      </collapsible-container>
    </div>
    <notification ref="notification">
      <template #actions>
        <a href="javascript:;" @click="cancel()" class="btn-primary">{{ __('Bestätigen') }}</a>
        <a href="javascript:;" @click="$refs.notification.hide()" class="btn-secondary">{{ __('Abbrechen') }}</a>
      </template>
    </notification>
   </div>
  </template>
  
  <script>
  import NProgress from 'nprogress';
  import i18n from "@/shared/mixins/i18n";
  import Validation from "@/shared/mixins/Validation";
  import Grid from "@/shared/components/ui/layout/Grid.vue";
  import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
  import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
  import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
  import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
  import StackedListDocument from "@/shared/components/ui/layout/StackedListDocument.vue";
  import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
  import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
  import IconEdit from "@/shared/components/ui/icons/Edit.vue";
  import IconCross from "@/shared/components/ui/icons/Cross.vue";
  import IconPlus from "@/shared/components/ui/icons/Plus.vue";
  import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";
  import BackLink from "@/shared/components/ui/misc/BackLink.vue";


  export default {
  
    components: {
      NProgress,
      Grid,
      ArticleText,
      CollapsibleContainer,
      Collapsible,
      StackedListEvent,
      StackedListItem,
      StackedListDocument,
      IconArrowRight,
      IconEdit,
      IconCross,
      IconCheckmark,
      IconPlus,
      BackLink
    },
  
    mixins: [i18n, Validation],
  
    data() {
      return {
  
        user: {
          company: null,
          gender_id: null,
          country_id: null,
        },

        uuidToDelete: null,

        routes: {
          user: {
            find: '/api/dashboard/student',
          },
          settings: '/api/user/settings',
          booking: {
            cancel: '/api/booking/cancel'
          },
        },

        // States
        isValid: false,
        isFetched: false,
        isRegistered: false,
        isLoading: false,
        isEdit: false,
      };
    },
  
    mounted() {
      this.find();
    },
  
    methods: {
      find() {
        NProgress.start();
        this.isFetched = false;
        this.axios.get(`${this.routes.user.find}/${this.$route.params.id}`).then(response => {
          this.user = response.data;
          this.isFetched = true;
          NProgress.done();
        });
      },

      confirmBookingCancellation(uuid, booking) {
        let message = this.__('Bitte Annullation bestätigen. Die Annullation wird Dir per E-Mail bestätigt.');
        if (booking.cancellation.penalty) {
          message = `${this.__('Die kurzfristige Annullation hat gemäss unseren AGB kosten zur Folge. Diese belaufen sich auf CHF ')} ${booking.cancellation.amount}.00 (${booking.cancellation.penalty}% ${this.__('der Kurskosten')})<br><br>${this.__('Die Annullation wird Dir per E-Mail bestätigt.')}`;
        }
        this.uuidToDelete = uuid;
        this.$refs.notification.init({
          message: message,
          type: 'dialog',
          style: 'info',
        });
      },

      cancel() {
        this.$refs.notification.hide();
        NProgress.start();
        this.axios.put(`${this.routes.booking.cancel}/${this.uuidToDelete}`).then(response => {
          this.uuidToDelete = null;
          this.$toast.open(this.__('Die Buchung wurde annulliert.'));
          this.find();
        })
        .catch(error => {
          this.handleValidationErrors(error.response.data);
        });
      }
    },
  
  }
  </script>
  
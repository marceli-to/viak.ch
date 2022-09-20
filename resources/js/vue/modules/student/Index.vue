<template>
<div v-if="isFetched">
  <article-text>
    
    <template #icon>
      <a href="" class="icon-edit" @click.prevent="toggleForm()">
        <icon-edit />
      </a>
    </template>
    
    <template #aside>
      <h1 class="xs:hide">{{ __('Mein Profil') }}</h1>
      <div class="sm:mt-10x md:mt-20x">
        <a :href="routes.logout" class="icon-arrow-right:below" :title="__('Logout')">
          <span>{{ __('Logout') }}</span>
          <icon-arrow-right />
        </a>
      </div>
    </template>

    <template #content v-if="isEdit">
      <form method="POST">
        <form-group :label="__('Geschlecht')" :required="true" :error="errors.gender_id">
          <div class="select-wrapper">
            <select v-model="form.gender_id" @change="removeError('gender_id')">
              <option 
                v-for="(option) in settings.genders" 
                :key="option.id" 
                :value="option.id">
                {{option.description[_getLocale()]}}
              </option>
            </select>
          </div>
        </form-group>
        <form-group :label="__('Vorname')" :required="true" :error="errors.firstname">
          <input type="text" v-model="form.firstname" required @focus="removeError('firstname')" />
        </form-group>
        <form-group :label="__('Name')" :required="true" :error="errors.name">
          <input type="text" v-model="form.name" required @focus="removeError('name')" />
        </form-group>
        <form-group :label="__('Telefon')">
          <input type="text" v-model="form.phone" maxlength="30" />
        </form-group>
        <grid class="sm:grid-cols-12">
          <form-group :label="__('Strasse')" :required="true" class="span-6" :error="errors.street">
            <input type="text" v-model="form.street" required @focus="removeError('street')" />
          </form-group>
          <form-group :label="__('Nr.')" class="span-6">
            <input type="text" v-model="form.street_no" maxlength="5" />
          </form-group>
        </grid>
        <grid class="sm:grid-cols-12">
          <form-group :label="__('PLZ')" :required="true" class="span-6" :error="errors.zip">
            <input type="text" v-model="form.zip" required maxlength="10" @focus="removeError('zip')" />
          </form-group>
          <form-group :label="__('Ort')" :required="true" class="span-6" :error="errors.city">
            <input type="text" v-model="form.city" required @focus="removeError('city')" />
          </form-group>
        </grid>
        <form-group class="has-underline" :error="errors.invoice_address">
          <div class="flex items-center">
            <input type="checkbox" id="has_invoice_address" name="has_invoice_address" required value="1" v-model="form.has_invoice_address">
            <label for="has_invoice_address">
              <em v-if="errors.invoice_address">{{__('Rechnungsadresse (abweichend) wird benötigt')}}</em>
              <em v-else>{{__('Rechnungsadresse (abweichend)')}}</em>
            </label>
          </div>
          <textarea v-model="form.invoice_address" :placeholder="__('Rechnungsadresse')" class="is-plain mt-2x sm:mt-4x autosize" v-if="form.has_invoice_address"></textarea>
        </form-group>
        
        <collapsible class="mt-12x">
          <template #title class="mb-3x">
            <div class="mb-3x">{{ __('Zugangsdaten') }}</div>
          </template>
          <template #content>
            <form-group :label="__('E-Mail')" :error="errors.new_email">
              <input type="email" v-model="form.new_email" autocomplete="new-email" aria-autocomplete="new-email" @focus="removeError('new_email')" />
            </form-group>
            <form-group :label="__('Passwort')" :error="errors.new_password">
              <input type="password" v-model="form.new_password" required autocomplete="new-password" aria-autocomplete="off" @focus="removeError('new_password')" />
              <div class="requirements">{{ __('min. 8 Zeichen') }}</div>
            </form-group>
            <form-group :label="__('Passwort wiederholen')" :error="errors.new_password_confirmation">
              <input type="password" v-model="form.new_password_confirmation" autocomplete="new-password-confirmation" aria-autocomplete="off" @focus="removeError('new_password_confirmation')" />
            </form-group>
          </template>
        </collapsible>

        <form-group>
          <a href="" @click.prevent="update()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
            {{ __('Speichern') }}
          </a>
        </form-group>
        <a href="" @click.prevent="hideForm()" class="form-helper">
          {{ __('Abbrechen') }}
        </a>
      </form>
    </template>
    
    <template #content v-else>
      <div>
        <user-address :user="user"></user-address>
        <template v-if="user.has_invoice_address && user.invoice_address">
          <h4 class="mt-4x sm:mt-6x md:mt-8x">Rechnungsadresse</h4>
          <pre>{{ user.invoice_address }}</pre>
        </template>
      </div>
    </template>
  </article-text>

  <collapsible-container>
    <collapsible>
      <template #title>
        {{ __('Merkliste') }}
      </template>
      <template #content>
        <p class="no-results">Deine Merkliste ist leer.</p>
      </template>
    </collapsible>
    
    <collapsible :expanded="true">
      <template #title>
        {{ __('Gebuchte Kurse') }}
      </template>
      <template #content>
        <div v-if="user.bookings && user.bookings.length">
          <div v-for="(booking, index) in user.bookings" :key="index">
            <stacked-list-event :event="booking.event" :booking="booking" :hasIcon="true">
              <template #action>
                <a href="" class="btn-secondary btn-auto-w" @click.prevent="cancelBooking(booking.uuid, booking.event)">
                  {{ __('Annullieren') }}
                </a>
              </template>
            </stacked-list-event>
          </div>
        </div>
        <div v-else>
          <p class="no-results">Du hast noch keine Kurse gebucht.</p>
        </div>
      </template>
    </collapsible>

  </collapsible-container>

  <collapsible-container>
    <collapsible>
      <template #title>
        {{ __('Absolvierte Kurse') }}
      </template>
      <template #content>
        <p class="no-results">Du hast noch keine Kurse absolviert.</p>
      </template>
    </collapsible>
  </collapsible-container>

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
        <div class="mt-4x">
          <router-link :to="{name: 'student-documents'}" class="link-helper">
            <span>{{ __('Alle Dokumente anzeigen') }}</span>
            <icon-arrow-right />
          </router-link>
        </div>
      </template>
    </collapsible>
  </collapsible-container>

 </div>
</template>
<script>
import NProgress from 'nprogress';
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import FormError from "@/shared/components/ui/form/FormError.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconCross from "@/shared/components/ui/icons/Cross.vue";
import UserData from "@/shared/mixins/data/User";
import UserAddress from "@/shared/components/ui/misc/Address.vue";

export default {

  components: {
    NProgress,
    Grid,
    GridCol,
    ArticleText,
    FormGroup,
    FormGroupHeader,
    FormError,
    CollapsibleContainer,
    Collapsible,
    StackedListEvent,
    StackedListItem,
    IconArrowRight,
    IconEdit,
    IconCross,
    UserAddress
  },

  mixins: [UserData],

  data() {
    return {

      routes: {

        user: {
          find: '/api/student',
          update: '/api/student',
        },

        genders: '/api/genders',
        login: '/login',
        logout: '/logout',

        booking: {
          cancel: '/api/booking/cancel'
        }
      },
    };
  },

  mounted() {
    this.find();
  },

  methods: {

    cancelBooking(uuid, event) {
      let message = 'Bitte Annullation bestätigen.';
      if (event.cancellation.penalty) {
        message = `Die kurzfristige Annullation hat gemäss unseren AGB kosten zur Folge. Diese belaufen sich auf CHF ${event.cancellation.amount}.– (${event.cancellation.penalty}% der Kurskosten)\nBitte Annullation bestätigen.`;
      }
      if (confirm(message)) {
        NProgress.start();
        this.axios.put(`${this.routes.booking.cancel}/${uuid}`).then(response => {
          alert('Die Buchung wurde annulliert.');
          this.find();
        });
      }
    },
  },
}
</script>

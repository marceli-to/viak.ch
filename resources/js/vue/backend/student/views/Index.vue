<template>
<div>
  <div v-if="isFetched">
    <article-text>
      
      <template #icon>
        <a href="" class="icon-edit" @click.prevent="toggleForm()">
          <icon-edit />
        </a>
      </template>
      
      <template #aside>
        <h1 class="xs:hide">{{ __('Mein Profil') }}</h1>
        <div class="sm:mt-5x md:mt-10x">
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
              <select v-model="form.gender_id" @change="removeValidationError('gender_id')">
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
            <input type="text" v-model="form.firstname" required @focus="removeValidationError('firstname')" />
          </form-group>
          <form-group :label="__('Name')" :required="true" :error="errors.name">
            <input type="text" v-model="form.name" required @focus="removeValidationError('name')" />
          </form-group>
          <form-group :label="__('Firma')">
            <input type="text" v-model="form.company" />
          </form-group>
          <form-group :label="__('Telefon')" :required="true" :error="errors.phone">
            <input type="text" v-model="form.phone" required maxlength="30" @focus="removeValidationError('phone')" />
          </form-group>
          <grid class="sm:grid-cols-12">
            <form-group :label="__('Strasse')" :required="true" class="span-6" :error="errors.street">
              <input type="text" v-model="form.street" required @focus="removeValidationError('street')" />
            </form-group>
            <form-group :label="__('Nr.')" class="span-6">
              <input type="text" v-model="form.street_no" maxlength="5" />
            </form-group>
          </grid>
          <grid class="sm:grid-cols-12">
            <form-group :label="__('PLZ')" :required="true" class="span-6" :error="errors.zip">
              <input type="text" v-model="form.zip" required maxlength="10" @focus="removeValidationError('zip')" />
            </form-group>
            <form-group :label="__('Ort')" :required="true" class="span-6" :error="errors.city">
              <input type="text" v-model="form.city" required @focus="removeValidationError('city')" />
            </form-group>
          </grid>
          <form-group :label="__('Land')" :required="true" :error="errors.country_id">
            <div class="select-wrapper">
              <select v-model="form.country_id" @change="removeValidationError('country_id')">
                <option 
                  v-for="(option) in settings.countries" 
                  :key="option.id" 
                  :value="option.id">
                  {{option.name}}
                </option>
              </select>
            </div>
          </form-group>

          <form-group class="line-after">
            <div class="flex items-center">
              <input type="checkbox" id="subscribe_newsletter" name="subscribe_newsletter" required value="1" v-model="form.subscribe_newsletter">
              <label for="subscribe_newsletter">{{ __('Ich möchte den Newsletter abonnieren.') }}</label>
            </div>
          </form-group>

          <collapsible class="mt-14x">
            <template #title class="mb-3x">
              <div class="mb-3x">{{ __('Rechnungsadressen') }}</div>
            </template>
            <template #content>
              <stacked-list-item 
                v-for="(address, index) in user.invoice_addresses"
                :key="address.uuid"
                :class="[index == 0 ? 'md:mt-3x' : '', '']">
                {{ address.address_str }}
                <router-link :to="{ name: `${_getLocale()}-student-address-edit`, params: { uuid: address.uuid } }" class="icon-edit mt-2x sm:mt-4x">
                  <icon-edit />
                </router-link>
              </stacked-list-item>
              <div class="flex justify-start mt-6x">
                <router-link :to="{ name: `${_getLocale()}-student-address-create` }" class="icon-plus">
                  <icon-plus />
                </router-link>
              </div>
            </template>
          </collapsible>
          
          <collapsible class="mt-8x sm:mt-12x">
            <template #title class="mb-3x">
              <div class="mb-3x">{{ __('Zugangsdaten') }}</div>
            </template>
            <template #content>
              <form-group :label="__('E-Mail')" :error="errors.new_email">
                <input type="email" v-model="form.new_email" autocomplete="new-email" aria-autocomplete="new-email" @focus="removeValidationError('new_email')" />
              </form-group>
              <form-group :label="__('Passwort')" :error="errors.new_password">
                <input type="password" v-model="form.new_password" required autocomplete="new-password" aria-autocomplete="off" @focus="removeValidationError('new_password')" />
                <div class="requirements">{{ __('min. 8 Zeichen') }}</div>
              </form-group>
              <form-group :label="__('Passwort wiederholen')" :error="errors.new_password_confirmation">
                <input type="password" v-model="form.new_password_confirmation" autocomplete="new-password-confirmation" aria-autocomplete="off" @focus="removeValidationError('new_password_confirmation')" />
              </form-group>
            </template>
          </collapsible>

          <form-group>
            <a href="" @click.prevent="update()" :class="[$store.state.isLoading ? 'is-disabled' : '', 'btn-primary']">
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
          <p><pre v-html="user.address"></pre></p>
          <p>{{ user.email }}</p>
        </div>
      </template>
    </article-text>

    <collapsible-container>
      <collapsible :items="user.bookmarks" :uuid="'student-bookmarks'">
        <template #title>
          {{ __('Merkliste') }}
        </template>
        <template #content>
          <div v-if="user.bookmarks && user.bookmarks.length">
            <div v-for="(bookmark, index) in sorted(user.bookmarks, 'event.date', 'asc')" :key="index">
              <stacked-list-event :event="bookmark.event" :bookmark="bookmark" :data-bookmark="bookmark.uuid">
                <template #icon>
                  <bookmark-icons 
                    :bookmark="bookmark.uuid" 
                    :event="bookmark.event.uuid"
                    :callback="'hideAfter'"
                  />
                </template>
                <template #action>
                  <basket-buttons :uuid="bookmark.event.uuid" />
                </template>
              </stacked-list-event>
            </div>
          </div>
          <div v-else>
            <p class="no-results">{{ __('Deine Merkliste ist leer.') }}</p>
          </div>
        </template>
      </collapsible>
      
      <collapsible :expanded="true" :items="user.events" :uuid="'student-bookings'">
        <template #title>
          {{ __('Gebuchte Kurse') }}
        </template>
        <template #content>
          <div v-if="user.events.length > 0">
            <div v-for="(booking, index) in user.events" :key="index">
              <stacked-list-event 
                :event="booking.event" 
                :booking="booking"
                :showState="true">
                <template #icon>
                  <icon-checkmark />
                </template>
                <template #action>
                  <router-link :to="{ name: `${_getLocale()}-student-course-event`, params: { uuid: booking.event.uuid } }" class="btn-primary btn-auto-w mb-2x" :title="__('Detail')">
                    {{ __('Detail')}}
                  </router-link>
                  <a href="" class="btn-secondary btn-auto-w" @click.prevent="confirm(booking.uuid, booking)">
                    {{ __('Annullieren') }}
                  </a>
                </template>
              </stacked-list-event>
            </div>
          </div>
          <div v-else>
            <p class="no-results">{{ __('Du hast noch keine Kurse gebucht.') }}</p>
          </div>
        </template>
      </collapsible>
      
      <collapsible :items="user.events_participated" :uuid="'student-bookings-concluded'">
        <template #title>
          {{ __('Absolvierte Kurse') }}
        </template>
        <template #content>
          <div v-if="user.events_participated.length > 0">
            <div v-for="(booking, index) in user.events_participated" :key="index">
              <stacked-list-event 
                :event="booking.event" 
                :booking="booking"
                :showState="true">
                <template #icon>
                  <icon-checkmark />
                </template>
                <template #action>
                  <router-link :to="{ name: `${_getLocale()}-student-course-event`, params: { uuid: booking.event.uuid } }" class="btn-primary btn-auto-w mb-2x" :title="__('Detail')">
                    {{ __('Detail')}}
                  </router-link>
                </template>
              </stacked-list-event>
            </div>
          </div>
          <div v-else>
            <p class="no-results">{{ __('Du hast noch keine Kurse absolviert.') }}</p>
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
          <div v-if="user.documents.length > 0">
            <stacked-list-document 
              v-for="document in user.documents" 
              :key="document.uuid" 
              :document="document">
            </stacked-list-document>

            <div class="mt-4x">
              <router-link :to="{name: `${_getLocale()}-student-documents`}" class="link-helper">
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
import Booking from "@/shared/mixins/Booking";
import Basket from "@/shared/mixins/Basket";
import BasketButtons from "@/frontend/event/Basket.vue";
import BookmarkIcons from "@/frontend/event/Bookmark.vue";
import Meta from "@/shared/mixins/Meta";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import StackedListDocument from "@/shared/components/ui/layout/StackedListDocument.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import FormError from "@/shared/components/ui/form/FormError.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconCross from "@/shared/components/ui/icons/Cross.vue";
import IconPlus from "@/shared/components/ui/icons/Plus.vue";
import IconCheckmark from "@/shared/components/ui/icons/Checkmark.vue";
import UserData from "@/shared/mixins/data/User";
import UserAddress from "@/shared/components/ui/user/Address.vue";

export default {

  components: {
    NProgress,
    Grid,
    ArticleText,
    FormGroup,
    FormGroupHeader,
    FormError,
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
    UserAddress,
    BasketButtons,
    BookmarkIcons,
  },

  mixins: [UserData, Booking, Basket, Meta, i18n],

  data() {
    return {

      routes: {
        user: {
          find: '/api/student',
          update: '/api/student',
        },
        settings: '/api/user/settings',
        login: '/login',
        logout: '/logout',
        booking: {
          cancel: '/api/booking/cancel'
        },
      },
    };
  },

  mounted() {
    this.find();
    this.setTitle(this.__('Profil'));
  },

  methods: {
    sorted(data, by, dir){
      return _.orderBy(data, by, dir);
    }
  },

}
</script>

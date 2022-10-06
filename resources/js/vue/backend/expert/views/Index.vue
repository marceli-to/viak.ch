<template>
<div v-if="isFetched">
  <article-text>
    <!-- user data -->
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
        <form-group :label="__('Firma')">
          <input type="text" v-model="form.company" />
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
        <form-group :label="__('Land')" :required="true" :error="errors.gender_id">
          <div class="select-wrapper">
            <select v-model="form.country_id" @change="removeError('gender_id')">
              <option 
                v-for="(option) in settings.countries" 
                :key="option.id" 
                :value="option.id">
                {{option.name}}
              </option>
            </select>
          </div>
        </form-group>

        <collapsible class="mt-6x">
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
      </div>
    </template>
    <!-- // user data -->
  </article-text>

  <collapsible-container>
    <collapsible :expanded="true">
      <template #title>
        {{ __('Bevorstehende Kurse') }}
      </template>
      <template #content>
        <div v-if="user.upcoming_events && user.upcoming_events.length">
          <div v-for="(event, index) in sorted(user.upcoming_events, 'event.date', 'asc')" :key="index">
            <stacked-list-event 
              :event="event" 
              :showExperts="false"
              :showFee="false" 
              :showBookingCount="true">
              <template #action>
                <router-link :to="{ name: 'expert-course-event', params: { uuid: event.uuid } }" class="btn-primary mb-3x" :title="__('Detail')">
                  {{ __('Detail')}}
                </router-link>
              </template>
            </stacked-list-event>
          </div>
        </div>
        <div v-else>
          <p class="no-results">{{ __('Du hast keine bevorstehenden Kurse.') }}</p>
        </div>
      </template>
    </collapsible>
  </collapsible-container>
  
  <notification ref="notification" />
</div>
</template>
<script>
import NProgress from 'nprogress';
import Meta from "@/shared/mixins/Meta";
import TinymceEditor from "@tinymce/tinymce-vue";
import tinyConfig from "@/shared/config/tiny.js";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import FormError from "@/shared/components/ui/form/FormError.vue";
import CollapsibleContainer from "@/shared/components/ui/layout/CollapsibleContainer.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import StackedListEvent from "@/shared/components/ui/layout/StackedListEvent.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconCross from "@/shared/components/ui/icons/Cross.vue";
import Images from "@/shared/modules/images/Index.vue";
import UserData from "@/shared/mixins/data/User";
import UserAddress from "@/shared/components/ui/user/Address.vue";

export default {

  components: {
    NProgress,
    TinymceEditor,
    Images,
    Grid,
    GridCol,
    ArticleText,
    CollapsibleContainer,
    Collapsible,
    StackedListEvent,
    FormGroup,
    FormGroupHeader,
    FormError,
    IconArrowRight,
    IconEdit,
    IconCross,
    UserAddress
  },

  mixins: [UserData, Meta],

  data() {
    return {

      // Routes
      routes: {
        user: {
          find: '/api/expert',
          register: '/api/expert/register',
          update: '/api/expert',
        },
        settings: '/api/user/settings',
        login: '/login',
        logout: '/logout'
      },

      // TinyMCE
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
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
  }

}
</script>

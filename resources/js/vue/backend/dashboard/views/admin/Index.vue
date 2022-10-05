<template>
<div>
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
                {{option.name[_getLocale()]}}
              </option>
            </select>
          </div>
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
        <a href="" @click.prevent="toggleForm()" class="form-helper">
          {{ __('Abbrechen') }}
        </a>
      </form>
    </template>
    <template #content v-else>
      <div>
        <user-address :user="user"></user-address>
      </div>
    </template>
  </article-text>
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
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import FormError from "@/shared/components/ui/form/FormError.vue";
import Collapsible from "@/shared/components/ui/layout/Collapsible.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import IconCross from "@/shared/components/ui/icons/Cross.vue";
import UserData from "@/shared/mixins/data/User";
import UserAddress from "@/shared/components/ui/user/Address.vue";

export default {

  components: {
    NProgress,
    Grid,
    GridCol,
    ArticleText,
    Collapsible,
    FormGroup,
    FormGroupHeader,
    FormError,
    IconArrowRight,
    IconEdit,
    IconCross,
    UserAddress
  },

  mixins: [UserData],

  data() {
    return {

      // Routes
      routes: {
        user: {
          find: '/api/admin',
          register: '/api/admin/register',
          update: '/api/admin',
        },
        settings: '/api/user/settings',
        logout: '/logout'
      },
    };
  },

  mounted() {
    this.find();
  },
}
</script>
  
<template>
<article-text>
  <template #aside>
    <h1 class="xs:hide">{{ __('Registrieren') }}</h1>
    <div class="sm:mt-10x md:mt-20x">
      <a :href="routes.login" class="icon-arrow-right:below" :title="__('Login')">
        <span>{{ __('Bereits registriert?') }}</span>
        <icon-arrow-right />
      </a>
    </div>
  </template>
  <template #content v-if="!isRegistered">
    <form method="POST">

      <form-group :label="__('Geschlecht')" :required="true" :error="errors.gender">
        <div class="select-wrapper">
          <select v-model="form.gender_id" @change="removeError('gender')">
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

      <form-group :label="__('E-Mail')" :required="true" :error="errors.email">
        <input type="email" v-model="form.email" required autocomplete="false" aria-autocomplete="false" @focus="removeError('email')" />
      </form-group>

      <form-group :label="__('Passwort')" :required="true" :error="errors.password">
        <input type="password" v-model="form.password" required autocomplete="false" aria-autocomplete="false" @focus="removeError('password')" />
        <div class="requirements">{{ __('min. 8 Zeichen') }}</div>
      </form-group>

      <form-group :label="__('Passwort wiederholen')" :required="true" :error="errors.password_confirmation">
        <input type="password" v-model="form.password_confirmation" required autocomplete="false" aria-autocomplete="false" @focus="removeError('password_confirmation')" />
      </form-group>

      <form-group-header>
        <h3>{{__('Betriebssystem')}}</h3>
      </form-group-header>
      <form-group class="has-underline">
        <div class="form-group__checkbox">
          <input type="checkbox" id="os_win" name="os_win" required value="Windows" v-model="form.operating_system">
          <label for="os_win">Windows</label>
        </div>
        <div class="form-group__checkbox">
          <input type="checkbox" id="os_mac" name="os_mac" required value="macOS" v-model="form.operating_system">
          <label for="os_mac">macOS</label>
        </div>
        <div class="flex items-center">
          <input type="checkbox" id="os_other" name="os_other" required value="anderes" v-model="form.operating_system">
          <label for="os_other">anderes</label>
        </div>
      </form-group>

      <form-group class="has-underline" :error="errors.accept_tos">
        <div class="form-group__checkbox md:mb-4x">
          <input type="checkbox" id="accept_tos" name="accept_tos" required value="true" v-model="form.accept_tos" @change="removeError('accept_tos')">
          <label for="accept_tos" v-if="errors.accept_tos">{{ errors.accept_tos }}</label>
          <label for="accept_tos" v-else>{{ __('Ich akzeptiere die Allg. Geschäftsbedingungen') }}</label>
        </div>
        <ul>
          <li>
            <a href="/media/downloads/viak_agb.pdf" target="_blank" :title="__('Download AGB')">
              {{ __('Allgemeine Geschäftsbedingungen') }}
            </a>
          </li>
          <li>
            <a href="/media/downloads/viak_datenschutzbestimmungen.pdf" target="_blank" :title="__('Download Datenschutzbestimmungen')">
              {{ __('Datenschutzbestimmungen') }}
            </a>
          </li>
        </ul>
      </form-group>

      <form-group class="has-underline">
        <div class="flex items-center">
          <input type="checkbox" id="subscribe_newsletter" name="subscribe_newsletter" required value="1" v-model="form.subscribe_newsletter">
          <label for="subscribe_newsletter">{{ __('Ich möchte den Newsletter abonnieren.') }}</label>
        </div>
      </form-group>
      
      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
          {{ __('Registrieren') }}
        </a>
      </form-group>
    </form>
  </template>
  <template #content v-else>
    <p>{{ __('Vielen Dank für deine Anmeldung. Du erhälst in den nächsten Minuten eine E-Mail, um deine Anmeldung zu verifizieren.') }}</p>
  </template>
</article-text>
</template>
<script>
import NProgress from 'nprogress';
import Settings from "@/modules/student/mixins/Settings";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import GridCol from "@/shared/components/ui/layout/GridCol.vue";
import ArticleText from "@/shared/components/ui/layout/ArticleText.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";
import FormGroupHeader from "@/shared/components/ui/form/FormGroupHeader.vue";
import FormError from "@/shared/components/ui/form/FormError.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";

export default {

  components: {
    NProgress,
    Grid,
    GridCol,
    ArticleText,
    FormGroup,
    FormGroupHeader,
    FormError,
    IconArrowRight,
  },

  mixins: [Settings],

  methods: {

    submit() {
      NProgress.start();
      this.isLoading = true;
      this.axios.post(`${this.routes.student.register}`, this.form).then(response => {
        NProgress.done();
        this.isRegistered = true;
        this.isLoading = false;
      });
    },
  },
}
</script>

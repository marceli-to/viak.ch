<template>
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

      <collapsible class="mt-6x">
        <template #title>
          {{ __('Über') }}
        </template>
        <template #content>
          <form-group :label="__('Titel')" class="mt-2x sm:mt-4x">
            <input type="text" v-model="form.expert_title" />
          </form-group>
          <form-group :label="__('Beschreibung')">
            <tinymce-editor
              :api-key="tinyApiKey"
              :init="tinyConfig"
              v-model="form.expert_description"
            ></tinymce-editor>
          </form-group>
        </template>
      </collapsible>

      <collapsible>
        <template #title>
          {{ __('Biographie') }}
        </template>
        <template #content>
          <form-group :error="errors.expert_bio">
            <tinymce-editor
              :api-key="tinyApiKey"
              :init="tinyConfig"
              v-model="form.expert_bio"
            ></tinymce-editor>
          </form-group>
        </template>
      </collapsible>

      <collapsible>
        <template #title>
          {{ __('Profilbild') }}
        </template>
        <template #content>
          <images 
            :imageRatioW="16" 
            :imageRatioH="9"
            :type="'User'"
            :typeId="form.id"
            :images="form.images">
          </images>
        </template>
      </collapsible>
      
      <!-- <form-group :label="__('E-Mail')" :required="true" :error="errors.email">
        <input type="email" v-model="form.email" required autocomplete="false" aria-autocomplete="false" @focus="removeError('email')" />
      </form-group>
      <form-group :label="__('Passwort')" :required="true" :error="errors.password">
        <input type="password" v-model="form.password" required autocomplete="false" aria-autocomplete="false" @focus="removeError('password')" />
        <div class="requirements">{{ __('min. 8 Zeichen') }}</div>
      </form-group> -->

      <form-group>
        <a href="" @click.prevent="submit()" :class="[isLoading ? 'is-disabled' : '', 'btn-primary']">
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
      <p>
        <template v-if="expert.fullname">{{ expert.fullname  }}</template><br>
        <template v-if="expert.street">{{ expert.street }}</template>
        <template v-if="expert.street_no">{{ expert.street_no }}</template><br>
        <template v-if="expert.zip">{{ expert.zip }}</template>
        <template v-if="expert.city">{{ expert.city }}</template>
      </p>
      <p>
        <template v-if="expert.phone">{{ expert.phone  }}<br></template>
        <template v-if="expert.email">{{ expert.email }}</template>
      </p>
    </div>
  </template>
</article-text>
</template>
<script>
import NProgress from 'nprogress';
import TinymceEditor from "@tinymce/tinymce-vue";
import tinyConfig from "@/shared/config/tiny.js";
import Settings from "@/modules/expert/mixins/Settings";
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
import Images from "@/shared/modules/images/Index.vue";

export default {

  components: {
    NProgress,
    TinymceEditor,
    Images,
    Grid,
    GridCol,
    ArticleText,
    Collapsible,
    FormGroup,
    FormGroupHeader,
    FormError,
    IconArrowRight,
    IconEdit,
    IconCross
  },

  mixins: [Settings],

  data() {
    return {
      expert: {
        gender_id: 2,
      },
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
    };
  },

  mounted() {
    this.find();
  },

  methods: {

    find() {
      NProgress.start();
      this.axios.get(`${this.routes.find}`).then(response => {
        this.expert = response.data;
        NProgress.done();
      });
    },

    submit() {
      NProgress.start();
      this.isLoading = true;
      this.axios.put(`${this.routes.update}`, this.form).then(response => {
        NProgress.done();
        this.expert = this.form;
        this.isLoading = false;
        this.isEdit = false;
      });
    },

    toggleForm() {
      this.isEdit = this.isEdit ? false : true;
      if (this.isEdit) {
        this.form = this.expert;
      }
    }
  },
}
</script>

<template>
  <stacked-list-container v-if="isLoaded">
    <stacked-list-header>
      <template #title>
        <h2>{{ __('Kontakt') }}</h2>
      </template>
      <template #step>
        <strong>{{ __('Schritt') }} 2/4</strong>
      </template>
    </stacked-list-header>

    <stacked-list-item>
      <div>
        <div class="sm:span-4">
          <strong>{{ __('Kursteilnehmer') }}</strong>
        </div>
        <div class="sm:span-8">
          <span v-html="user.address"></span>
        </div>
      </div>
    </stacked-list-item>
    
    <stacked-list-item>
      <div class="relative">
        <a href="" class="icon-edit" @click.prevent="toggle()">
          <icon-edit />
        </a>
        <div class="sm:span-4">
          <strong>{{ __('Rechnungsadresse') }}</strong>
        </div>
        <div class="sm:span-8">
          <template v-if="!isEdit">
            <span v-html="nl2br(form.invoice_address)"></span>
          </template>
          <template v-else>
            <form-group :error="errors.invoice_address">
              <textarea 
                v-model="form.invoice_address" 
                :placeholder="__('Rechnungsadresse eingeben')" 
                class="is-plain mb-2x sm:mb-4x autosize">
              </textarea>
              <div class="flex items-center">
                <input type="checkbox" id="update_profile" name="update_profile" required value="1" v-model="form.update_profile">
                <label for="update_profile">
                  <em>{{ __('Änderungen im Profil speichern' )}}</em>
                </label>
              </div>
            </form-group>
          </template>
        </div>
      </div>
    </stacked-list-item>

    <stacked-list-footer>
      <div>
        <router-link :to="{ name: 'checkout-basket' }" class="btn-previous">
          <icon-arrow-left />
          <span>{{ __('Zurück') }}</span>
        </router-link>
      </div>
      <div>
        <a href="javascript:;" class="btn-next" @click.prevent="submit()">
          <span>{{ __('Weiter') }}</span>
          <icon-arrow-right />
        </a>
      </div>
    </stacked-list-footer>

  </stacked-list-container>
</template>
<script>
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Helpers from "@/shared/mixins/Helpers";
import i18n from "@/shared/mixins/i18n";
import StackedListContainer from "@/shared/components/ui/layout/StackedListContainer.vue";
import StackedListItem from "@/shared/components/ui/layout/StackedListItem.vue";
import StackedListHeader from "@/shared/components/ui/layout/StackedListHeader.vue";
import StackedListFooter from "@/shared/components/ui/layout/StackedListFooter.vue";
import IconArrowRight from "@/shared/components/ui/icons/ArrowRight.vue";
import IconArrowLeft from "@/shared/components/ui/icons/ArrowLeft.vue";
import IconEdit from "@/shared/components/ui/icons/Edit.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";

export default {

  components: {
    NProgress,
    StackedListContainer,
    StackedListItem,
    StackedListHeader,
    StackedListFooter,
    IconArrowRight,
    IconArrowLeft,
    IconEdit,
    FormGroup
  },

  mixins: [ErrorHandling, i18n, Helpers],

  data() {
    return { 

      // User data
      user: {},

      // Form data
      form: {
        update_profile: false,
        invoice_address: null,
      },

      // Errors
      errors: {
        invoice_address: null
      },

      // Routes
      routes: {
        get: '/api/student',
        addUser: '/api/basket/add/user'
      },

      // States
      isLoaded: true,
      isEdit: false,
    }
  },

  mounted() {
    this.get();
  },

  methods: {

    get() {
      NProgress.start();
      this.isLoaded = false;
      this.axios.get(`${this.routes.get}`).then(response => {
        this.user = response.data;
        this.form.invoice_address = this.user.invoice_address;
        this.form.update_profile = this.user.has_invoice_address;
        this.isLoaded = true;
        NProgress.done();
      });
    },

    submit() {
      NProgress.start();
      this.axios.put(`${this.routes.addUser}`, this.form).then((response) => {
        this.$router.push({ name:'checkout-payment' });
        NProgress.done();
      });
    },

    toggle() {
      this.isEdit = this.isEdit ? false : true;
    }
  },
}
</script>
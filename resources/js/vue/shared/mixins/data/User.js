import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import i18n from "@/shared/mixins/i18n";

export default {

  components: {
    NProgress,
  },

  mixins: [Validation, i18n],

  data() {
    return { 

      user: {
        company: null,
        gender_id: null,
        country_id: null,
      },

      // Form
      form: {
        gender_id: 2,
        country_id: 1,
        firstname: null,
        name: null,
        company: null,
        phone: null,
        street: null,
        street_no: null,
        zip: null,
        city: null,
        new_email: null,
        new_password: null,
        new_password_confirmation: null,
        operating_system: [],
        accept_tos: null,
        subscribe_newsletter: 0,
      },

      // Settings
      settings: {
        genders: [],
        countries: [],
      },

      // Validation
      errors: {},

      // States
      isValid: false,
      isFetched: false,
      isRegistered: false,
      isLoading: false,
      isEdit: false,
    };
  },
  
  mounted() {
    this.fetch();
  },

  methods: {

    fetch() {
      this.isFetched = false;
      NProgress.start();
      this.axios.get(`${this.routes.settings}`).then(response => {
        this.settings.genders = response.data.genders;
        this.settings.countries = response.data.countries;
        this.isFetched = true;
        NProgress.done();
      });
    },

    find() {
      NProgress.start();
      this.isFetched = false;
      this.axios.get(`${this.routes.user.find}`).then(response => {
        this.user = response.data;
        this.isFetched = true;
        NProgress.done();
      });
    },

    update() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.user.update}`, this.form).then(response => {
        this.hideForm();
        this.find();
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    showForm() {
      this.isEdit = true;
      this.form = this.user;
      this.form.new_email = null;
      this.form.new_password = null;
      this.form.new_password_confirmation = null;
    },

    hideForm() {
      this.isEdit = false;
    },
    
    toggleForm() {
      this.isEdit = this.isEdit ? false : true;
      if (this.isEdit) {
        this.form = this.user;
        this.form.new_email = null;
        this.form.new_password = null;
        this.form.new_password_confirmation = null;
      }
    },
  },
};

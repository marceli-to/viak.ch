import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";

export default {

  components: {
    NProgress,
  },

  mixins: [ErrorHandling, i18n],

  data() {
    return { 

      user: {

      },

      // Form
      form: {
        gender_id: 2,
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
        subscribe_newsletter: false,
      },

      // Settings
      settings: {
        genders: [],
      },

      // Validation
      errors: {
        firstname: null,
        name: null,
        gender_id: null,
        new_email: null,
        new_password: null,
        new_password_confirmation: null,
      },

      // Store
      store: {},

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
      this.axios.get(`${this.routes.genders}`).then(response => {
        this.settings.genders = response.data;
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
      this.isLoading = true;
      this.axios.put(`${this.routes.user.update}`, this.form).then(response => {
        this.hideForm();
        this.isLoading = false;
        this.find();
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

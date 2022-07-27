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

      // Form
      form: {
        firstname: null,
        name: null,
        phone: null,
        street: null,
        street_no: null,
        zip: null,
        city: null,
        email: null,
        password: null,
        operating_system: [],
        has_invoice_address: false,
        invoice_address: null,
        accept_tos: null,
        subscribe_newsletter: false,
        gender_id: null,
      },

      // Settings
      settings: {
        genders: [],
      },

      // Validation
      errors: {
        firstname: null,
        name: null,
        street: null,
        zip: null,
        city: null,
        email: null,
        password: null,
        invoice_address: null,
        gender_id: null,
        accept_tos: null,
      },

      // Store
      store: {},

      // States
      isValid: false,
      isFetched: false,
      isRegistered: false,
      isLoading: false,
      isEdit: false,

      // Routes
      routes: {
        genders: '/api/genders',
        login: '/login',
        logout: '/logout',

        student: {
          find: '/api/student',
          update: '/api/student',
          register: '/api/student/register',
        },

        booking: {
          cancel: '/api/booking/cancel'
        }
      },

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
  },

};

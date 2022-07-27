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
        gender_id: null,
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
        find: '/api/expert',
        register: '/api/expert/register',
        update: '/api/expert',
        genders: '/api/genders',
        login: '/login',
        logout: '/logout'
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

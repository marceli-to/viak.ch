export default {
  
  data() {
    return {

      translations: {},

      fallback_locale: 'de',

      routes: {
        get: '/api/translations',
      },
    }
  },

  mounted() {
    this._getTranslations();
  },

  methods: {

    i18n(key) {
      if (this.translations[key]) {
        return this.translations[key];
      }
      return key;
    },

    _getLocale() {
      let ll = document.documentElement.lang ? document.documentElement.lang : 'de';
      return ll;
    },

    _getTranslations() {
      const locale = this._getLocale();
      if (locale != this.fallback_locale) {
        this.axios.get(`${this.routes.get}/${locale}`).then(response => {
          this.translations = JSON.parse(response.data);
        });
      }
    },
  }
};
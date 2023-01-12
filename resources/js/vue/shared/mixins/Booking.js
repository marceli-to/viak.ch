import NProgress from 'nprogress';

export default {

  data() {
    return {
      uuidToDelete: null
    };
  },

  methods: {
    confirm(uuid, booking) {
      let message = this.__('Bitte Annullation bestätigen. Die Annullation wird Dir per E-Mail bestätigt.');
      if (booking.cancellation.penalty) {
        message = `${this.__('Die kurzfristige Annullation hat gemäss unseren AGB kosten zur Folge. Diese belaufen sich auf CHF ')} ${booking.cancellation.amount} (${booking.cancellation.penalty}% ${this.__('der Kurskosten')})<br><br>${this.__('Die Annullation wird Dir per E-Mail bestätigt.')}`;
      }
      this.uuidToDelete = uuid;
      this.$refs.notification.init({
        message: message,
        type: 'dialog',
        style: 'info',
      });
    },

    cancel() {
      this.$refs.notification.hide();
      NProgress.start();
      this.axios.put(`${this.routes.booking.cancel}/${this.uuidToDelete}`).then(response => {
        this.uuidToDelete = null;
        if (this.$route.name == `${this._getLocale()}-student-profile`) {
          this.$toast.open(this.__('Die Buchung wurde annulliert.'));
          this.find();
        }
        else {
          this.$router.push({ name: `${this._getLocale()}-student-profile`});
        }
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    }
  }

};
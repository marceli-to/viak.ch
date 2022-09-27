import NProgress from 'nprogress';

export default {

  data() {
    return {
      uuidToDelete: null
    };
  },

  methods: {
    confirm(uuid, event) {
      let message = `Bitte Annullation bestätigen. Die Annullation wird Dir per E-Mail bestätigt.`;
      if (event.cancellation.penalty) {
        message = `Die kurzfristige Annullation hat gemäss unseren AGB kosten zur Folge. Diese belaufen sich auf CHF ${event.cancellation.amount}.– (${event.cancellation.penalty}% der Kurskosten)<br><br>Bitte Annullation bestätigen. Die Annullation wird Dir per E-Mail bestätigt.`;
      }
      this.uuidToDelete = uuid;
      this.$refs.notification.init({
        message: message,
        type: 'dialog',
        style: 'info',
        autohide: false,
      });
    },

    cancel() {
      this.$refs.notification.hide();
      NProgress.start();
      this.axios.put(`${this.routes.booking.cancel}/${this.uuidToDelete}`).then(response => {
        this.uuidToDelete = null;
        if (this.$route.name == 'student-profile') {
          this.$refs.notification.init({
            message: 'Die Buchung wurde annulliert.',
            type: 'toast',
            style: 'success',
            autohide: true,
          });
          this.find();
        }
        else {
          this.$router.push({ name: 'student-profile'});
        }
      });
    }
  }

};
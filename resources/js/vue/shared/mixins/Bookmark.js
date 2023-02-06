import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import i18n from "@/shared/mixins/i18n";
import IconHeart from "@/shared/components/ui/icons/Heart.vue";

export default {

  components: {
    NProgress,
    IconHeart
  },

  mixins: [i18n, Validation],

  data() {
    return {

      // uuids
      eventUuid: null,
      bookmarkUuid: null,

      // Item state
      bookmarked: 0,

      // Routes
      routes: {
        bookmark: {
          add: '/api/bookmark',
          delete: '/api/bookmark'
        }
      },
    };
  },

  props: {

    event: {
      type: String,
      default: null,
    },

    bookmark: {
      type: String,
      default: null,
    },

    callback: {
      type: String,
      default: null,
    },

    auth: {
      type: [Boolean, Number],
      default: false,
    }
  },

  mounted() {
    this.eventUuid = this.$props.event;
    this.bookmarkUuid = this.$props.bookmark;
    this.bookmarked = this.$props.bookmark != null ? true : false;
  },

  methods: {

    addBookmark() {

      if (this.$props.auth) {
        NProgress.start();
        this.eventUuid = this.$props.event;
        this.axios.put(`${this.routes.bookmark.add}/${this.eventUuid}`).then(response => {
          this.bookmarked = true;
          this.bookmarkUuid = response.data.uuid;
          this.$toast.open(this.__('Der Kurs wurde in der Merkliste gespeichert.'));
        })
        .catch(error => {
          this.handleValidationErrors(error.response.data);
        });
      }
      else {
        this.$refs.notification.init({
          message: '<p>Die Merkliste steht nur registrierten Benutzern zur Verfügung.</p>',
          type: 'dialog',
          style: 'info',
        });
      }
    },

    removeBookmark() {
      NProgress.start();
      this.axios.delete(`${this.routes.bookmark.delete}/${this.bookmarkUuid}`).then(response => {
        this.bookmarked = false;
        this.$toast.open(this.__('Der Kurs wurde aus der Merkliste gelöscht.'));
        if (this.$props.callback && this.$props.callback == 'hideAfter') {
          const el = document.querySelector(`[data-bookmark="${this.bookmarkUuid}"]`);
          el.remove();
        }
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },
  },
}
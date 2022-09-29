import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import i18n from "@/shared/mixins/i18n";
import IconHeart from "@/shared/components/ui/icons/Heart.vue";

export default {

  components: {
    NProgress,
    IconHeart
  },

  mixins: [ErrorHandling, i18n],

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
    }
  },

  mounted() {
    this.eventUuid = this.$props.event;
    this.bookmarkUuid = this.$props.bookmark;
    this.bookmarked = this.$props.bookmark != null ? true : false;
  },

  methods: {

    addBookmark() {
      NProgress.start();
      this.eventUuid = this.$props.event;
      this.axios.put(`${this.routes.bookmark.add}/${this.eventUuid}`).then(response => {
        this.bookmarked = true;
        this.bookmarkUuid = response.data.uuid;
        this.$refs.notification.init({
          message: 'Der Kurs wurde in der Merkliste gespeichert.',
          type: 'toast',
          style: 'success',
        });
        NProgress.done();
      });
    },

    removeBookmark() {
      NProgress.start();
      this.axios.delete(`${this.routes.bookmark.delete}/${this.bookmarkUuid}`).then(response => {
        this.bookmarked = false;
        this.$refs.notification.init({
          message: 'Der Kurs wurde aus der Merkliste gelöscht.',
          type: 'toast',
          style: 'success',
        });

        if (this.$props.callback && this.$props.callback == 'hideAfter') {
          const el = document.querySelector(`[data-bookmark="${this.bookmarkUuid}"]`);
          el.remove();
        }
        NProgress.done();
      });
    },
  },
}
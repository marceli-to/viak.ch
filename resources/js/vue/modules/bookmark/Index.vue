<template>
<div>
  <a href="" class="btn-primary btn-auto-w" @click.prevent="add()" v-if="!inBookmarks">

  </a>
  <a href="" class="btn-secondary btn-auto-w" @click.prevent="remove()" v-else>

  </a>
</div>
</template>
<script>
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

      // Item state
      isBookmarks: false,

      // Routes
      routes: {
        put: '/api/bookmark',
        delete: '/api/bookmark'
      },
    }
  },

  props: {
    uuid: {
      type: String,
      default: null,
    },

    exists: {
      type: [Number, Boolean],
      default: false,
    }
  },

  mounted() {
    this.inBookmarks = this.$props.exists;
  },

  methods: {

    add() {
      NProgress.start();
      this.axios.put(`${this.routes.put}/${this.$props.uuid}`).then(response => {
        this.inBookmarks = true;
        alert('Der Kurs wurde in der Merkliste gespeichert.');
        NProgress.done();
      });
    },

    remove() {
      NProgress.start();
      this.axios.delete(`${this.routes.delete}/${this.$props.uuid}`).then(response => {
        this.inBookmarks = false;
        alert('Der Kurs wurde aus der Merkliste gelöscht.');
        NProgress.done();
      });
    },
  },
}
</script>

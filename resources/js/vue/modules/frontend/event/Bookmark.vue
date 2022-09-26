<template>
<div>
  <a href="" class="icon-bookmark" @click.prevent="add()" v-if="!inBookmarks">
    <icon-heart />
  </a>
  <a href="" :class="[inBookmarks ? 'is-active' : '', 'icon-bookmark']" @click.prevent="remove()" v-else>
    <icon-heart :active="inBookmarks"  />
  </a>
</div>
</template>
<script>
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

      // Item state
      inBookmarks: 0,

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
      type: [Number, Boolean, String],
      default: 0,
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

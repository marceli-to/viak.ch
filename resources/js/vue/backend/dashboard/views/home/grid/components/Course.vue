<template>
<div :class="[isOpen ? 'is-visible' : '', 'lightbox']" v-if="isOpen">
  <div v-if="isFetched" class="lightbox-widget">
    <header class="flex justify-between">
      <h1>Kurse</h1>
      <a href="javascript:;" class="feather-icon btn-close" @click.prevent="hide()">
        <x-icon size="24"></x-icon>
      </a>
    </header>
    <div>
      <a 
        v-for="course in courses" 
        href="javascript:;" 
        :key="course.id" 
        class="lightbox-widget__item"
        @click="add(course)">
        {{ course.number }} {{ course.title.de }}
      </a>
    </div>
  </div>
</div>
</template>
<script>
import { PlusIcon, XIcon } from 'vue-feather-icons'
import Helpers from "@/shared/mixins/Helpers";

export default {

  components: {
    PlusIcon,
    XIcon
  },

  mixins: [Helpers],

  data() {
    return {

      courses: [],
      item: null,

      // Routes
      routes: {
        get: '/api/dashboard/courses/publish'
      },

      // States
      isFetched: false,
      isOpen: false,
    }
  },

  created() {
    const onEscape = (e) => {
      if (this.isOpen && e.keyCode === 27) {
        this.hide();
      }
    }
    document.addEventListener('keydown', onEscape);
  },

  mounted() {
    this.fetch();
  },

  methods: {

    fetch() {
      this.axios.get(`${this.routes.get}`).then(response => {
        this.courses = response.data.data;
        this.isFetched = true;
      });
    },

    add(course) {
      this.$parent.addCourse(this.item, course);
      this.hide();
    },

    show(item) {
      this.item = item;
      this.isOpen = true;
    },

    hide() {
      this.item = null;
      this.isOpen = false;
    }
  }
}
</script>
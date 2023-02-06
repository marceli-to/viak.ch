<template>
  <div :class="[isOpen ? 'is-visible' : '', 'lightbox']" v-if="isOpen">
    <div class="lightbox-widget">
      <header class="flex justify-between">
        <h1>Code (Youtube, Rezension)</h1>
        <a href="javascript:;" class="feather-icon btn-close" @click.prevent="hide()">
          <x-icon size="24"></x-icon>
        </a>
      </header>
      <form-group :label="'Titel'" class="mt-1x sm:mt-3x">
        <input 
          type="text" 
          v-model="title.de" />
      </form-group>
      <form-group :label="'Code'" class="mt-3x sm:mt-6x">
        <textarea v-model="code" class="is-large is-code"></textarea>
      </form-group>
      <form-group :label="'Seitenverhältnis (Videos)'">
        <div class="select-wrapper">
          <select v-model="ratio">
            <option value="null">Bitte wählen...</option>
            <option value="16:9">16:9</option>
            <option value="16:10">16:10</option>
            <option value="4:3">4:3</option>
          </select>
        </div>
      </form-group>
      <form-group class="mt-3x sm:mt-6x">
        <a href="javascript:;" class="btn-primary" @click="add();">
          Speichern
        </a>
      </form-group>
    </div>
  </div>
  </template>
  <script>
  import { PlusIcon, XIcon } from 'vue-feather-icons'
  import Helpers from "@/shared/mixins/Helpers";
  import NProgress from 'nprogress';
  import FormGroup from "@/shared/components/ui/form/FormGroup.vue";

  export default {
  
    components: {
      PlusIcon,
      XIcon,
      FormGroup
    },
  
    mixins: [Helpers],
  
    data() {
      return {
        title: {
          de: null,
          en: null
        },
        ratio: null,
        code: null,
        item: null,
        isOpen: false,

        routes: {
          get: '/api/dashboard/grid/row/item/get/code',
        }
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
  
    methods: {
  
      add() {
        this.$parent.addCode(this.item, this.code, this.ratio, this.title);
        this.hide();
      },
  
      show(item) {
        NProgress.start();
        this.$store.commit('isLoading', true); 
        this.axios.get(`${this.routes.get}/${item}`).then(response => {
          this.item = response.data.id;
          this.title = response.data.title ? response.data.title : '';
          this.code = response.data.code;
          this.ratio = response.data.ratio;
          this.isOpen = true;
        });
      },
  
      hide() {
        this.item = null;
        this.title = {
          de: null,
          en: null
        };
        this.code = null;
        this.isOpen = false;
      }
    }
  }
  </script>
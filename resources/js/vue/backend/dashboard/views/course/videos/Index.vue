<template>
<div v-if="isFetched">
  <div v-if="hasForm" class="mb-12x">
    <form-group :label="'Titel'" class="mt-6x">
      <input 
        type="text" 
        v-model="video.title" />
    </form-group>
    <form-group :label="'Code'" :required="true" :error="errors.code">
      <textarea 
        v-model="video.code" 
        class="code" 
        required 
        @focus="removeError('code')">
      </textarea>
    </form-group>
    <form-group>
      <grid class="sm:grid-cols-12">
        <a href="" @click.prevent="hideForm()" class="btn-secondary span-6">
          Abbrechen
        </a>
        <a href="" @click.prevent="submit(false)" :class="[isLoading ? 'is-disabled' : '', 'btn-primary span-6']">
          Speichern
        </a>
      </grid>
    </form-group>
  </div>
  <div class="media-upload mt-4x">
    <div class="media-uploads">
      <a href="javascript:;" 
        @click.prevent="showForm()"
        class="media-uploads-button btn-media-upload-add"
        v-if="!hasForm">
        Video hinzufügen
      </a>
      <div class="media-uploads__grid">
        <div
          :class="[d.publish == 0 ? 'is-hidden' : '', 'media-uploads-item media-uploads-item--video']"
          v-for="d in data"
          :key="d.id"
        >
          <div>
            <div class="mb-2x">{{d.title}}</div>
            <div v-html="d.code" class="ratio-container ratio-container--16x9" style="min-width: 200px">
            </div>
            <div class="media-uploads-item__actions">
              <div>
                <div>
                  <a
                    href="javascript:;"
                    @click.prevent="toggle(d)"
                  >
                    <span v-if="d.publish" class="feather-icon">
                      <eye-icon size="18"></eye-icon>
                    </span>
                    <span v-else>
                      <eye-off-icon size="18" class="feather-icon"></eye-off-icon>
                    </span>
                  </a>
                </div>
                <div>
                  <a href="javascript:;" @click="edit(d)">
                    <edit-icon size="18"></edit-icon>
                  </a>
                </div>
                <div>
                  <a
                    href="javascript:;"
                    class="feather-icon"
                    @click.prevent="confirmDestroy(d)"
                  >
                    <trash2-icon size="18"></trash2-icon>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <notification ref="notification">
    <template #actions>
      <a href="javascript:;" @click="destroy()" class="btn-primary">Bestätigen</a>
      <a href="javascript:;" @click="$refs.notification.hide()" class="btn-secondary">Abbrechen</a>
    </template>
  </notification>
</div>
</template>
<script>
import { EyeIcon, EyeOffIcon, EditIcon, Trash2Icon, CropIcon, ImageIcon} from 'vue-feather-icons';
import NProgress from 'nprogress';
import ErrorHandling from "@/shared/mixins/ErrorHandling";
import Grid from "@/shared/components/ui/layout/Grid.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";

export default {

  components: {
    Grid,
    FormGroup,
    EyeIcon,
    EyeOffIcon,
    EditIcon,
    Trash2Icon,
  },

  mixins: [ErrorHandling],

  props: {
    courseId: null,
    videos: null,
  },

  data() {
    return {

      videoToDelete: null,

      // Data
      data: [],

      // Video
      video: {
        title: null,
        code: null,
      },

      // Validation
      errors: {
        code: false,
      },

      // Routes
      routes: {
        get: '/api/dashboard/course/videos',
        store: '/api/dashboard/course/video',
        delete: '/api/dashboard/course/video',
        update: '/api/dashboard/course/video',
        toggle: '/api/dashboard/course/video/state',
      },

      // Mode
      mode: 'create',

      // States
      isFetched: false,
      isLoading: false,
      hasForm: false,

    };
  },

  created() {
    if (this.$props.videos) {
      this.data = this.$props.videos;
      this.isFetched = true;
    }
    else {
      this.fetch();
    }
  },

  methods: {

    fetch() {
      NProgress.start();
      this.axios.get(`${this.routes.get}/${this.$props.courseId}`).then(response => {
        this.data = response.data.data;
        this.isFetched = true;
        NProgress.done();
      });
    },

    submit() {
      if (this.mode == 'create') {
        this.store();
      }
      if (this.mode == 'update') {
        this.update();
      }
    },

    store() {
      let video = {
        course_id: this.$props.courseId,
        title: this.video.title,
        code: this.video.code,
        publish: 1,
      };

      NProgress.start();
      this.axios.post(`${this.routes.store}`, video).then(response => {
        video.id = response.data.videoId;
        this.data.push(video);
        this.reset();
        this.hideForm();
        NProgress.done();
      });
    },

    update() {
      NProgress.start();
      this.isLoading = true;
      this.axios.put(`${this.routes.update}/${this.video.id}`, this.video).then(response => {
        this.reset();
        this.isLoading = false;
        this.hideForm();
        NProgress.done();
      });
    },

    edit(video) {
      this.video = video;
      this.mode = 'update';
      this.showForm();
    },

    confirmDestroy(video) {
      this.videoToDelete = video;
      this.$refs.notification.init({
        message: 'Bitte Löschen bestätigen!',
        type: 'dialog',
        style: 'info',
        autohide: false,
      });
    },

    destroy() {
      NProgress.start();
      this.isLoading = true;
      this.axios.delete(`${this.routes.delete}/${this.videoToDelete.id}`).then(response => {
        const index = this.data.findIndex(x => x.id === this.videoToDelete.id);
        if (index > -1) {
          this.data.splice(index, 1);
        }
        this.videoToDelete = null;
        this.isLoading = false;
        NProgress.done();
      });
    },

    toggle(video) {
      NProgress.start();
      this.isLoading = true;
      this.axios.get(`${this.routes.toggle}/${video.id}`).then(response => {
        const index = this.data.findIndex(x => x.id === video.id);
        if (index > -1) {
          this.data[index].publish = response.data;
        }
        this.isLoading = false;
        NProgress.done();
      });
    },

    reset() {
      this.video = {
        title: null,
        code: null,
      };
      this.mode = 'create';
    },

    showForm() {
      this.hasForm = true;
    },

    hideForm() {
      this.reset();
      this.hasForm = false;
    }

  }
}
</script>
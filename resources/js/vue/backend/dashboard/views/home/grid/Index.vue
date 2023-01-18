<template>
<div v-if="isFetched">
  <content-list-header>
    <h1>Startseite</h1>
  </content-list-header>

  <grid-row :key="row.id" v-for="row in grid" @deleteRow="deleteRow(row.id)">
    <div :class="`grid grid-${row.layout}`">
      <grid-row-item v-for="item in row.items" :key="item.id">
        <template v-if="isEmpty(item)">
          <div class="grid-buttons flex items-center justify-center direction-column">
            <a href="javascript:;" class="btn-primary" @click="$refs.courseSelector.show(item.id);">
              Kurs hinzufügen
            </a>
            <a href="javascript:;" class="btn-primary" @click="$refs.newsSelector.show(item.id);">
              News hinzufügen
            </a>
            <a href="javascript:;" class="btn-primary" @click="$refs.codeInput.show(item.id);">
              Code hinzufügen
            </a>
          </div>
        </template>
        <template v-else>
          <div v-if="item.course_id">
            <label>Teaser</label><br>
            {{ item.course.title.de }}
          </div>
          <div v-if="item.news_id">
            <label>News</label><br>
            <strong>{{ item.news.title.de }}</strong>
            <div v-html="item.news.text.de"></div>
          </div>
          <div v-if="item.code">
            <div v-if="item.title" class="mb-2x">
              <label>{{ item.title.de }}</label><br>
            </div>
            <div v-html="item.code" :class="`ratio-container ratio-container--${item.ratio}`"></div>
          </div>
          <div class="action-buttons">
            <a href="javascript:;" class="btn-secondary btn-edit" @click="$refs.codeInput.show(item.id);" v-if="item.code">
              Bearbeiten
            </a>
            <a href="javascript:;" class="btn-danger" @click="resetItem(item.id)">
              Löschen
            </a>
          </div>
        </template>
      </grid-row-item>
    </div>
  </grid-row>

  <form-group class="flex justify-center mt-8x">
    <a href="" class="icon-plus" @click.prevent="addRow()">
      <icon-plus :size="'lg'" />
    </a>
  </form-group>
  <news-selector ref="newsSelector"></news-selector>
  <course-selector ref="courseSelector"></course-selector>
  <code-input ref="codeInput"></code-input>
</div>
</template>
<script>
import NProgress from 'nprogress';
import Validation from "@/shared/mixins/Validation";
import i18n from "@/shared/mixins/i18n";
import Helpers from "@/shared/mixins/Helpers";
import draggable from 'vuedraggable';
import IconPlus from "@/shared/components/ui/icons/Plus.vue";
import IconTrash from "@/shared/components/ui/icons/Trash.vue";
import ContentListHeader from "@/shared/components/ui/layout/ContentListHeader.vue";
import NewsSelector from "@/backend/dashboard/views/home/grid/components/News.vue";
import CourseSelector from "@/backend/dashboard/views/home/grid/components/Course.vue";
import CodeInput from "@/backend/dashboard/views/home/grid/components/Code.vue";
import GridRow from "@/backend/dashboard/views/home/grid/components/GridRow.vue";
import GridRowItem from "@/backend/dashboard/views/home/grid/components/GridRowItem.vue";
import FormGroup from "@/shared/components/ui/form/FormGroup.vue";

export default {

  components: {
    draggable,
    ContentListHeader,
    NewsSelector,
    CourseSelector,
    CodeInput,
    GridRow,
    GridRowItem,
    FormGroup,
    IconPlus,
    IconTrash
  },

  mixins: [Validation, Helpers, i18n],

  data() {
    return {

      grid: [],

      currentRow: 0,

      // Routes
      routes: {
        get: '/api/dashboard/grid/rows',
        store: '/api/dashboard/grid/row',
        order: '/api/dashboard/grid/row/order',
        delete: '/api/dashboard/grid/row',

        addCourse: '/api/dashboard/grid/row/item/add/course',
        addNews: '/api/dashboard/grid/row/item/add/news',
        addCode: '/api/dashboard/grid/row/item/add/code',
        resetItem: '/api/dashboard/grid/row/item/reset',
      },

      // States
      isLoading: false,
      isFetched: false,

      // Messages
      messages: {
        emptyData: 'Es sind noch keine Daten vorhanden...',
        confirm: 'Bitte löschen bestätigen!',
        updated: 'Daten aktualisiert',
      }
    }
  },

  created() {
    this.init();
  },

  methods: {

    init() {
      this.isFetched = false;
      this.fetch();
    },

    fetch() {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.get(`${this.routes.get}`).then(response => {
        this.grid = response.data;
        this.currentRow = this.grid.length;
        this.isFetched = true;
        NProgress.done();
      });
    },

    destroy(id) {
      if (confirm(this.messages.confirm)) {
        NProgress.start();
        this.axios.delete(`${this.routes.delete}/${id}`).then(response => {
          this.fetch();
          NProgress.done();
        });
      }
    },

    order(data) {
      let events = data.map(function(event, index) {
        event.order = index;
        return event;
      });
      if (this.debounce) return;
      this.debounce = setTimeout(function() {
        this.debounce = false;
        this.axios.post(`${this.routes.order}`, {items: events}).then((response) => {
          this.$toast.open(this.__(this.messages.updated));
        });
      }.bind(this, events), 500);
    },

    addCourse(item, course) {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.addCourse}/${item}`, {course_id: course.id}).then(response => {
        this.fetch();
        this.$refs.courseSelector.hide();
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    addNews(item, news) {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.addNews}/${item}`, {news_id: news.id}).then(response => {
        this.$refs.newsSelector.hide();
        this.fetch();
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    addCode(item, code, ratio = null, title = null) {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.put(`${this.routes.addCode}/${item}`, {title: title, ratio: ratio, code: code}).then(response => {
        this.$refs.codeInput.hide();
        this.fetch();
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    addRow() {

      // Get the last row to determine its layout and order
      const lastRow = this.grid[this.grid.length - 1];

      // Build next row
      const nextRow = {
        layout: lastRow && lastRow.layout == '1-2' ? '2-1' : '1-2',
        order: lastRow ? lastRow.order + 1 : 0
      };

      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.post(this.routes.store, nextRow).then(response => {
        this.fetch();
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    deleteRow(id) {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.delete(`${this.routes.delete}/${id}`).then(response => {
        const index = this.grid.findIndex(x => x.id == id);
        this.grid.splice(index, 1);
        this.$toast.open(this.__('Zeile wurde gelöscht'));
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    resetItem(id) {
      NProgress.start();
      this.$store.commit('isLoading', true); 
      this.axios.get(`${this.routes.resetItem}/${id}`).then(response => {
        this.fetch();
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    isEmpty(item) {
      return (item.course_id == null && item.news_id == null && item.code == null) ? true : false;
    }
  }
}
</script>
<style scoped>
.grid-buttons {
  min-height: inherit;
}

.grid-item {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.action-buttons {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 4px;
}

.btn-primary {
  max-width: 240px;
  margin: 4px 0;
}

.btn-danger,
.btn-edit {
  max-width: 120px;
  min-width: auto;
}

.btn-edit {
  margin-right: 12px;
}

</style>
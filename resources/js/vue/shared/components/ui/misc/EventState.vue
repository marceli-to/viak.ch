<template>
  <div>
    <div v-if="state.closed">
      <em>
        {{ mode.dashboard ? __('Kurs abgeschlossen') : __('Kurs ist abgeschlossen') }}
      </em>
    </div>
    <div v-else-if="state.cancelled">
      <em class="text-danger">
        {{ mode.dashboard ? __('Kurs abgesagt') : __('Kurs wurde abgesagt') }}
      </em>
    </div>
    <div v-else-if="state.confirmed">
      <em class="text-success">
        {{ mode.dashboard ? __('Kurs bestätigt') : __('Kurs findet statt') }}
      </em>
    </div>
    <div v-else>
      <em class="text-warning">
        {{ mode.dashboard ? __('Kurs nicht bestätigt') : __('Kurs offen, wird bestätigt') }}
      </em>
    </div>
  </div>
</template>
<script>
import i18n from "@/shared/mixins/i18n";

export default {
  
  mixins: [i18n],

  data() {
    return {
      state: {
        confirmed: false,
        closed: false,
        cancelled: false,
      },
      mode: {
        dashboard: false,
      }
    }
  },

  props: {
    event: {
      type: Object,
      default: null,
    },
  },

  mounted() {
    this.setState();
    this.setMode();
  },

  methods: {
    setState() {
      this.state.confirmed = this.$props.event.is_confirmed;
      this.state.closed = this.$props.event.is_closed;
      this.state.cancelled = this.$props.event.is_cancelled;
    },

    setMode() {
      this.mode.dashboard = this.$props.dashboard ? true : false;
    }
  }
}
</script>
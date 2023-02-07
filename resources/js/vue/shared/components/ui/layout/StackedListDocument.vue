<template>
<article class="stacked-list-item" data-touch>
  <div>
    <div class="sm:span-4">
      <strong>{{ $props.document.course_title }}</strong><br>{{ $props.document.course_date }}
    </div>
    <div class="sm:span-3">
      {{ $props.document.document_title }} <span v-if="$props.document.type == 'INVOICE'">{{ $props.document.number }}</span>
    </div>
    <div class="sm:span-5">
      <div class="flex justify-between">
        <div>
          <span v-if="$props.document.type == 'INVOICE'">CHF {{ $props.document.grand_total }}</span>
          <template v-if="$props.document.status == 'PAID'"><em class="text-success">(bezahlt)</em></template>
          <template v-if="$props.document.status == 'OPEN'"><em class="text-info">(offen)</em></template>
          <template v-if="$props.document.status == 'OVERDUE'"><em class="text-danger">(fällig)</em></template>
        </div>
        <div>
          <a :href="`${$props.document.uri}`" target="_blank" class="btn-primary" :title="$props.document.document_title">
            Download
          </a>
        </div>
      </div>
    </div>
  </div>
</article>
</template>
<script>
import i18n from "@/shared/mixins/i18n";
export default {
  
  mixins: [i18n],

  props: {
    document: {
      type: Object,
      default: {},
    }
  },

}
</script>
<template>
  <div>
    <template v-if="$props.size == 'sm'">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 23.273 14">
        <path fill="currentColor" d="M16.193 0l-1.004 1.011 5.596 5.383H0v1.242h20.785l-5.593 5.381.998.984 7.083-7.002z"/>
      </svg>
    </template>
    <template v-else>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14" viewBox="0 0 23.273 14" class="sm:hide">
        <path fill="currentColor" d="M16.193 0l-1.004 1.011 5.596 5.383H0v1.242h20.785l-5.593 5.381.998.984 7.083-7.002z"/>
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" width="29.924" height="18" viewBox="0 0 29.924 18" class="xs:hide">
        <path fill="currentColor" d="M20.835 0l-1.261 1.271 7.231 6.968H0v1.557h26.805l-7.227 6.967L20.831 18l9.093-9.002z"/>
      </svg>
    </template>
  </div>
</template>
<script>
export default {
  props: {
    size: {
      type: String,
      default: null,
    }
  }
}
</script>
<template>
  <div>
    <template v-if="$props.user.fullname">{{ $props.user.fullname  }}<br></template>
    <template v-if="$props.user.street">{{ $props.user.street }}</template>
    <template v-if="$props.user.street_no">{{ $props.user.street_no }}<br></template>
    <template v-if="$props.user.zip">{{ $props.user.zip }}</template>
    <template v-if="$props.user.city">{{ $props.user.city }}<br></template>
    <br>
    <template v-if="$props.user.phone">{{ $props.user.phone  }}<br></template>
    <template v-if="$props.user.email">{{ $props.user.email }}</template>
  </div>
</template>
<script>
export default {
  props: {
    user: {
      type: Object,
      default: null,
    },
  },
}
</script>
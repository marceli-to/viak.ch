<template>
<div>
  <a href="" class="icon-bookmark" @click.prevent="addBookmark()" v-if="!bookmarked">
    <icon-heart />
  </a>
  <a href="" :class="[bookmarked ? 'is-active' : '', 'icon-bookmark']" @click.prevent="removeBookmark()" v-else>
    <icon-heart :active="bookmarked"  />
  </a>
  <notification ref="notification" />
</div>
</template>
<script>
import Bookmark from "@/shared/mixins/Bookmark";
export default {
  mixins: [Bookmark],
}
</script>

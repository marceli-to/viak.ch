<template>
<div>
  <a href="javascript:;" class="icon-bookmark" @click.prevent="addBookmark()" v-if="!bookmarked" :title="__('Zur Merkliste hinzufügen')">
    <icon-heart />
  </a>
  <a href="javascript:;" :class="[bookmarked ? 'is-active' : '', 'icon-bookmark']" :title="__('Von Merkliste entfernen')" @click.prevent="removeBookmark()" v-else>
    <icon-heart :active="bookmarked"  />
  </a>
  <notification ref="notification">
    <template #actions>
      <a href="/login" class="btn-primary" :title="__('Login')">
        {{ __('Login') }}
      </a>
      <a href="javascript:;" @click="$refs.notification.hide()" :title="__('Schliessen')">
        {{ __('Schliessen') }}
      </a>
    </template>
  </notification>
</div>
</template>
<script>
import Bookmark from "@/shared/mixins/Bookmark";
import i18n from "@/shared/mixins/i18n";
export default {
  mixins: [i18n, Bookmark],
}
</script>

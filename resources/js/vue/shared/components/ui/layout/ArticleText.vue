<template>
  <article class="text">
    <div class="text__content">
      <template v-if="$slots.aside">
        <aside>
          <slot name="aside" />
        </aside>
      </template>
      <template v-if="$slots.content">
        <div>
          <slot name="content" />
        </div>
      </template>
    </div>
  </article>
</template>
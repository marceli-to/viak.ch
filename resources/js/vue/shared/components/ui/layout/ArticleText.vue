<template>
  <article class="content-text">
    <template v-if="$slots.icon">
      <slot name="icon" />
    </template>
    <div class="text__body">
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
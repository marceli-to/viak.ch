<template>
  <header class="stacked-list-header">
    <div v-if="$slots.step" class="sm:span-4">
      <slot name="step" />
    </div>
    <div v-if="$slots.title" class="sm:span-8">
      <slot name="title" />
    </div>
  </header>
</template>
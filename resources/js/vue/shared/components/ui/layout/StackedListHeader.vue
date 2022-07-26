<template>
  <header class="stacked-list-header">
    <div v-if="$slots.title">
      <slot name="title" />
    </div>
    <div v-if="$slots.step">
      <slot name="step" />
    </div>
  </header>
</template>
<template>
  <header class="checkout__header">
    <div v-if="$slots.title">
      <slot name="title" />
    </div>
    <div v-if="$slots.step">
      <slot name="step" />
    </div>
  </header>
</template>
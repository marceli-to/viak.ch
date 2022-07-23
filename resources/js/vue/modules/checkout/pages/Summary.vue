<template>
  <div>
    <h1>Summary</h1>
    <div class="grid-cols-12">
      <router-link :to="{ name: 'checkout-user' }" class="btn-secondary span-6">
        Zurück
      </router-link>
      <router-link :to="{ name: 'checkout-confirmation' }" class="btn-primary span-6">
        Weiter
      </router-link>
    </div>
  </div>
</template>
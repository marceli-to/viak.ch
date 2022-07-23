<template>
  <div>
    <h1>Payment</h1>
    <div class="grid-cols-12">
      <router-link :to="{ name: 'checkout-user' }" class="btn-secondary span-6">
        Zurück
      </router-link>
      <router-link :to="{ name: 'checkout-summary' }" class="btn-primary span-6">
        Weiter
      </router-link>
    </div>
  </div>
</template>
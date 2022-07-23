<template>
  <div>
    <h1>Contact info</h1>
    <div class="grid-cols-12">
      <router-link :to="{ name: 'checkout-basket' }" class="btn-secondary span-6">
        Zurück
      </router-link>
      <router-link :to="{ name: 'checkout-payment' }" class="btn-primary span-6">
        Weiter
      </router-link>
    </div>
  </div>
</template>
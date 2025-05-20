<template>
  <div class="d-flex flex-column align-center justify-center not-found">
    <v-icon size="80" color="error" class="mb-4">mdi-alert-circle</v-icon>
    <h1 class="text-h3 font-weight-bold mb-2">404</h1>
    <p class="text-h5 mb-6">Page Not Found</p>
    <p class="text-body-1 mb-8">The page you are looking for doesn't exist or has been moved.</p>
    <v-btn color="primary" to="/" prepend-icon="mdi-home">
      Return to Dashboard
    </v-btn>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'NotFoundView'
})
</script>

<style scoped>
.not-found {
  height: 80vh;
  text-align: center;
}
</style>
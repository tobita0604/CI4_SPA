<template>
  <v-card :elevation="elevation" class="dashboard-card">
    <v-card-item v-if="title">
      <v-card-title>{{ title }}</v-card-title>
      <template v-slot:append v-if="$slots.actions">
        <slot name="actions"></slot>
      </template>
    </v-card-item>
    
    <v-card-text>
      <slot></slot>
    </v-card-text>
  </v-card>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'DashboardCard',
  props: {
    title: {
      type: String,
      default: ''
    },
    elevation: {
      type: Number,
      default: 1
    }
  }
})
</script>

<style scoped>
.dashboard-card {
  height: 100%;
}
</style>
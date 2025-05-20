<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    
    <v-row>
      <v-col cols="12" sm="6" md="3">
        <v-card class="mx-auto" max-width="400">
          <v-card-item>
            <v-card-title>Users</v-card-title>
          </v-card-item>
          <v-card-text>
            <div class="text-h4 text-center">{{ stats.users }}</div>
          </v-card-text>
        </v-card>
      </v-col>
      
      <v-col cols="12" sm="6" md="3">
        <v-card class="mx-auto" max-width="400">
          <v-card-item>
            <v-card-title>Products</v-card-title>
          </v-card-item>
          <v-card-text>
            <div class="text-h4 text-center">{{ stats.products }}</div>
          </v-card-text>
        </v-card>
      </v-col>
      
      <v-col cols="12" sm="6" md="3">
        <v-card class="mx-auto" max-width="400">
          <v-card-item>
            <v-card-title>Orders</v-card-title>
          </v-card-item>
          <v-card-text>
            <div class="text-h4 text-center">{{ stats.orders }}</div>
          </v-card-text>
        </v-card>
      </v-col>
      
      <v-col cols="12" sm="6" md="3">
        <v-card class="mx-auto" max-width="400">
          <v-card-item>
            <v-card-title>Revenue</v-card-title>
          </v-card-item>
          <v-card-text>
            <div class="text-h4 text-center">${{ stats.revenue.toLocaleString() }}</div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    
    <v-row class="mt-6">
      <v-col cols="12">
        <v-card>
          <v-card-title>Recent Activity</v-card-title>
          <v-card-text>
            <v-table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Description</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="activity in recentActivities" :key="activity.id">
                  <td>{{ activity.id }}</td>
                  <td>{{ activity.type }}</td>
                  <td>{{ activity.description }}</td>
                  <td>{{ activity.date }}</td>
                </tr>
              </tbody>
            </v-table>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from 'vue'

export default defineComponent({
  name: 'HomeView',
  setup() {
    const stats = reactive({
      users: 245,
      products: 56,
      orders: 128,
      revenue: 15680
    })
    
    const recentActivities = [
      { id: 1, type: 'User', description: 'New user registered', date: '2023-04-20 14:30' },
      { id: 2, type: 'Order', description: 'Order #123 placed', date: '2023-04-20 13:15' },
      { id: 3, type: 'Product', description: 'Product stock updated', date: '2023-04-20 12:45' },
      { id: 4, type: 'System', description: 'System backup completed', date: '2023-04-20 12:00' },
      { id: 5, type: 'User', description: 'User profile updated', date: '2023-04-20 11:30' }
    ]
    
    return {
      stats,
      recentActivities
    }
  }
})
</script>
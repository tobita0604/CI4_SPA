<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Users</h1>
    
    <v-card>
      <v-card-title>
        <v-row>
          <v-col cols="12" sm="6">
            User Management
          </v-col>
          <v-col cols="12" sm="6" class="text-right">
            <v-btn color="primary" prepend-icon="mdi-plus">
              Add User
            </v-btn>
          </v-col>
        </v-row>
      </v-card-title>
      
      <v-card-text>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
          class="mb-4"
        ></v-text-field>
        
        <v-table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in filteredUsers" :key="item.id">
              <td>{{ item.id }}</td>
              <td>{{ item.name }}</td>
              <td>{{ item.email }}</td>
              <td>{{ item.role }}</td>
              <td>
                <v-chip
                  :color="item.status === 'Active' ? 'success' : 'error'"
                  size="small"
                >
                  {{ item.status }}
                </v-chip>
              </td>
              <td>
                <v-btn icon="mdi-pencil" variant="text" density="compact" color="primary"></v-btn>
                <v-btn icon="mdi-delete" variant="text" density="compact" color="error"></v-btn>
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-card-text>
    </v-card>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed } from 'vue'

export default defineComponent({
  name: 'UsersView',
  setup() {
    const search = ref('')
    
    const users = [
      { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin', status: 'Active' },
      { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'User', status: 'Active' },
      { id: 3, name: 'Bob Johnson', email: 'bob@example.com', role: 'Editor', status: 'Inactive' },
      { id: 4, name: 'Alice Brown', email: 'alice@example.com', role: 'User', status: 'Active' },
      { id: 5, name: 'Charlie White', email: 'charlie@example.com', role: 'User', status: 'Inactive' },
    ]
    
    const filteredUsers = computed(() => {
      if (!search.value) return users
      
      const searchLower = search.value.toLowerCase()
      return users.filter(user => 
        user.name.toLowerCase().includes(searchLower) ||
        user.email.toLowerCase().includes(searchLower) ||
        user.role.toLowerCase().includes(searchLower)
      )
    })
    
    return {
      search,
      filteredUsers
    }
  }
})
</script>
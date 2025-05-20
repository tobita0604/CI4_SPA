<template>
  <div class="dashboard-index">
    <el-row :gutter="20">
      <el-col :span="8">
        <el-card class="dashboard-card">
          <template #header>
            <div class="card-header">
              <span>Total Users</span>
              <el-button type="text" @click="navigateTo('/dashboard/users')">View All</el-button>
            </div>
          </template>
          <div class="card-content">
            <el-statistic :value="userCount" title="Users" />
          </div>
        </el-card>
      </el-col>
      
      <el-col :span="8">
        <el-card class="dashboard-card">
          <template #header>
            <div class="card-header">
              <span>Total Items</span>
              <el-button type="text" @click="navigateTo('/dashboard/items')">View All</el-button>
            </div>
          </template>
          <div class="card-content">
            <el-statistic :value="itemCount" title="Items" />
          </div>
        </el-card>
      </el-col>
      
      <el-col :span="8">
        <el-card class="dashboard-card">
          <template #header>
            <div class="card-header">
              <span>System Status</span>
            </div>
          </template>
          <div class="card-content">
            <el-statistic :value="100" title="System Health" suffix="%" />
          </div>
        </el-card>
      </el-col>
    </el-row>
    
    <el-row :gutter="20" style="margin-top: 20px;">
      <el-col :span="24">
        <el-card class="dashboard-card">
          <template #header>
            <div class="card-header">
              <span>Welcome to CI4 SPA Admin Panel</span>
            </div>
          </template>
          <div class="card-content welcome-content">
            <p>This is a starter template for a CodeIgniter 4 and Vue 3 SPA Admin Panel.</p>
            <p>You can manage users and items using the links in the sidebar.</p>
            <p>The API is powered by CodeIgniter 4 with Shield authentication.</p>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useUsersStore } from '@/stores/users'
import { useItemsStore } from '@/stores/items'

export default defineComponent({
  name: 'DashboardIndex',
  setup() {
    const router = useRouter()
    const usersStore = useUsersStore()
    const itemsStore = useItemsStore()
    
    const userCount = ref(0)
    const itemCount = ref(0)
    
    onMounted(async () => {
      try {
        await usersStore.fetchUsers()
        userCount.value = usersStore.users.length
      } catch (error) {
        console.error('Error loading users:', error)
      }
      
      try {
        await itemsStore.fetchItems()
        itemCount.value = itemsStore.items.length
      } catch (error) {
        console.error('Error loading items:', error)
      }
    })
    
    const navigateTo = (path: string) => {
      router.push(path)
    }
    
    return {
      userCount,
      itemCount,
      navigateTo
    }
  }
})
</script>

<style scoped>
.dashboard-card {
  margin-bottom: 20px;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card-content {
  display: flex;
  justify-content: center;
  padding: 20px 0;
}

.welcome-content {
  text-align: center;
  padding: 20px;
}
</style>
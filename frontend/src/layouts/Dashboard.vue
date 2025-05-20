<template>
  <div class="dashboard-layout">
    <el-container>
      <el-aside width="240px">
        <div class="logo">
          <h1>CI4 SPA</h1>
        </div>
        <el-menu
          router
          :default-active="activeRoute"
          class="sidebar-menu"
          background-color="#304156"
          text-color="#bfcbd9"
          active-text-color="#409EFF"
        >
          <el-menu-item index="/dashboard">
            <el-icon><el-icon-menu /></el-icon>
            <span>Dashboard</span>
          </el-menu-item>
          <el-menu-item index="/dashboard/users">
            <el-icon><el-icon-user /></el-icon>
            <span>Users</span>
          </el-menu-item>
          <el-menu-item index="/dashboard/items">
            <el-icon><el-icon-shopping-cart /></el-icon>
            <span>Items</span>
          </el-menu-item>
        </el-menu>
      </el-aside>
      
      <el-container>
        <el-header>
          <div class="header-container">
            <div class="header-left">
              <!-- Breadcrumb or title could go here -->
            </div>
            <div class="header-right">
              <el-dropdown trigger="click" @command="handleCommand">
                <span class="user-dropdown">
                  {{ username }}
                  <el-icon><el-icon-arrow-down /></el-icon>
                </span>
                <template #dropdown>
                  <el-dropdown-menu>
                    <el-dropdown-item command="profile">Profile</el-dropdown-item>
                    <el-dropdown-item command="logout" divided>Logout</el-dropdown-item>
                  </el-dropdown-menu>
                </template>
              </el-dropdown>
            </div>
          </div>
        </el-header>
        
        <el-main>
          <router-view />
        </el-main>
      </el-container>
    </el-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

// Import Element Plus icons
import {
  Menu as ElIconMenu,
  User as ElIconUser,
  ShoppingCart as ElIconShoppingCart,
  ArrowDown as ElIconArrowDown
} from '@element-plus/icons-vue'

export default defineComponent({
  name: 'DashboardLayout',
  components: {
    ElIconMenu,
    ElIconUser,
    ElIconShoppingCart,
    ElIconArrowDown
  },
  setup() {
    const router = useRouter()
    const authStore = useAuthStore()
    
    const activeRoute = computed(() => router.currentRoute.value.path)
    const username = computed(() => authStore.user?.username || 'User')
    
    const handleCommand = (command: string) => {
      if (command === 'logout') {
        authStore.logout()
        router.push('/login')
      } else if (command === 'profile') {
        // Navigate to profile page
      }
    }
    
    return {
      activeRoute,
      username,
      handleCommand
    }
  }
})
</script>

<style scoped>
.dashboard-layout {
  height: 100%;
}

.el-container {
  height: 100%;
}

.el-aside {
  background-color: #304156;
  color: #bfcbd9;
  height: 100%;
  overflow-x: hidden;
}

.el-header {
  background-color: #fff;
  color: #333;
  line-height: 60px;
  border-bottom: 1px solid #e6e6e6;
  padding: 0 20px;
}

.el-main {
  background-color: #f0f2f5;
  padding: 20px;
}

.logo {
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
}

.logo h1 {
  margin: 0;
  font-size: 20px;
}

.sidebar-menu {
  border-right: none;
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.user-dropdown {
  cursor: pointer;
  display: flex;
  align-items: center;
  color: #333;
}

.user-dropdown .el-icon {
  margin-left: 5px;
}
</style>
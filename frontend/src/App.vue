<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" app>
      <v-list>
        <v-list-item title="CI4 SPA Dashboard" />
        <v-divider />
        <v-list-item
          v-for="(item, i) in menuItems"
          :key="i"
          :value="item"
          :title="item.title"
          :to="item.path"
        >
          <template v-slot:prepend>
            <v-icon :icon="item.icon"></v-icon>
          </template>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>CI4 SPA Admin Dashboard</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon @click="logout">
        <v-icon>mdi-logout</v-icon>
      </v-btn>
    </v-app-bar>

    <v-main>
      <v-container fluid>
        <router-view />
      </v-container>
    </v-main>

    <v-footer app>
      <div class="text-center w-full">
        &copy; {{ new Date().getFullYear() }} — <strong>CI4 SPA</strong>
      </div>
    </v-footer>
  </v-app>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from './store/auth'

export default defineComponent({
  name: 'App',
  setup() {
    const drawer = ref(true)
    const router = useRouter()
    const authStore = useAuthStore()
    
    const menuItems = [
      { title: 'Dashboard', icon: 'mdi-view-dashboard', path: '/' },
      { title: 'Users', icon: 'mdi-account-group', path: '/users' },
      { title: 'Items', icon: 'mdi-package-variant-closed', path: '/items' },
      { title: 'Settings', icon: 'mdi-cog', path: '/settings' },
    ]

    const logout = () => {
      authStore.logout()
      router.push('/login')
    }

    return {
      drawer,
      menuItems,
      logout
    }
  },
})
</script>
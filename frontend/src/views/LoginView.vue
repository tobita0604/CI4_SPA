<template>
  <div class="login-container">
    <v-card class="login-card pa-6" elevation="8">
      <v-card-title class="text-center text-h4 mb-4">
        Admin Login
      </v-card-title>
      
      <v-alert
        v-if="authStore.error"
        type="error"
        variant="tonal"
        class="mb-4"
      >
        {{ authStore.error }}
      </v-alert>
      
      <v-form @submit.prevent="login">
        <v-text-field
          v-model="email"
          label="Email"
          type="email"
          required
          :rules="[rules.required, rules.email]"
          prepend-icon="mdi-email"
        ></v-text-field>
        
        <v-text-field
          v-model="password"
          label="Password"
          :type="showPassword ? 'text' : 'password'"
          required
          :rules="[rules.required, rules.min]"
          prepend-icon="mdi-lock"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          @click:append="showPassword = !showPassword"
        ></v-text-field>
        
        <v-btn
          type="submit"
          block
          color="primary"
          size="large"
          :loading="authStore.loading"
          class="mt-4"
        >
          Login
        </v-btn>
      </v-form>
      
      <div class="text-center mt-4">
        <a href="#" class="text-decoration-none">Forgot Password?</a>
      </div>
    </v-card>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth'

export default defineComponent({
  name: 'LoginView',
  setup() {
    const router = useRouter()
    const authStore = useAuthStore()
    
    const email = ref('')
    const password = ref('')
    const showPassword = ref(false)
    
    const rules = {
      required: (v: string) => !!v || 'This field is required',
      email: (v: string) => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Email must be valid',
      min: (v: string) => v.length >= 6 || 'Password must be at least 6 characters'
    }
    
    const login = async () => {
      if (!email.value || !password.value) return
      
      await authStore.login(email.value, password.value)
      
      if (authStore.isAuthenticated) {
        router.push('/')
      }
    }
    
    return {
      email,
      password,
      showPassword,
      rules,
      login,
      authStore
    }
  }
})
</script>

<style scoped>
.login-container {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f5f5f5;
}

.login-card {
  width: 100%;
  max-width: 400px;
}
</style>
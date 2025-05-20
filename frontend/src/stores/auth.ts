import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { User, AuthResponse } from '@/types'
import { authService } from '@/services/auth'

export const useAuthStore = defineStore('auth', () => {
  const user = ref<User | null>(null)
  const token = ref<string | null>(null)
  const loading = ref(false)
  const error = ref<string | null>(null)

  // Load from local storage
  const storedToken = localStorage.getItem('token')
  const storedUser = localStorage.getItem('user')

  if (storedToken) {
    token.value = storedToken
  }

  if (storedUser) {
    try {
      user.value = JSON.parse(storedUser)
    } catch (e) {
      localStorage.removeItem('user')
    }
  }

  const isAuthenticated = computed(() => !!token.value)

  async function login(email: string, password: string) {
    loading.value = true
    error.value = null

    try {
      const response = await authService.login(email, password)
      setAuth(response)
      return true
    } catch (err: any) {
      error.value = err.message || 'Failed to login'
      return false
    } finally {
      loading.value = false
    }
  }

  async function register(username: string, email: string, password: string) {
    loading.value = true
    error.value = null

    try {
      const response = await authService.register(username, email, password)
      setAuth(response)
      return true
    } catch (err: any) {
      error.value = err.message || 'Failed to register'
      return false
    } finally {
      loading.value = false
    }
  }

  async function logout() {
    loading.value = true

    try {
      await authService.logout()
    } catch (err) {
      console.error('Logout error:', err)
    } finally {
      clearAuth()
      loading.value = false
    }
  }

  function setAuth(authResponse: AuthResponse) {
    user.value = authResponse.user
    token.value = authResponse.token
    localStorage.setItem('token', authResponse.token)
    localStorage.setItem('user', JSON.stringify(authResponse.user))
  }

  function clearAuth() {
    user.value = null
    token.value = null
    localStorage.removeItem('token')
    localStorage.removeItem('user')
  }

  return {
    user,
    token,
    loading,
    error,
    isAuthenticated,
    login,
    register,
    logout,
    setAuth,
    clearAuth
  }
})
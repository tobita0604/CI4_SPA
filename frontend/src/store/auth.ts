import { defineStore } from 'pinia'
import axios from 'axios'

interface User {
  id: number
  username: string
  email: string
  token: string
}

interface AuthState {
  user: User | null
  isAuthenticated: boolean
  loading: boolean
  error: string | null
}

export const useAuthStore = defineStore('auth', {
  state: (): AuthState => ({
    user: null,
    isAuthenticated: false,
    loading: false,
    error: null,
  }),
  
  getters: {
    getUser: (state) => state.user,
    isLoggedIn: (state) => state.isAuthenticated,
  },
  
  actions: {
    async login(email: string, password: string) {
      this.loading = true
      this.error = null
      
      try {
        const response = await axios.post('/api/login', { email, password })
        
        if (response.data.status === 'success') {
          this.user = response.data.user
          this.isAuthenticated = true
          
          // Store token in localStorage
          localStorage.setItem('user-token', response.data.user.token)
          
          // Set axios default headers
          axios.defaults.headers.common['Authorization'] = `******        } else {
          this.error = 'Login failed'
        }
      } catch (error: any) {
        this.error = error.response?.data?.message || 'An error occurred during login'
      } finally {
        this.loading = false
      }
    },
    
    logout() {
      this.user = null
      this.isAuthenticated = false
      localStorage.removeItem('user-token')
      delete axios.defaults.headers.common['Authorization']
    },
    
    initAuth() {
      const token = localStorage.getItem('user-token')
      
      if (token) {
        // Set auth header for axios
        axios.defaults.headers.common['Authorization'] = `******        this.isAuthenticated = true
        
        // You would typically validate the token with the backend here
        // and get the user information
      }
    }
  }
})
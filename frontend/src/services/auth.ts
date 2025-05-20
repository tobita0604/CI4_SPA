import api from './api'
import { AuthResponse } from '@/types'

export const authService = {
  async login(email: string, password: string): Promise<AuthResponse> {
    const response = await api.post('/login', { email, password })
    return response.data
  },
  
  async register(username: string, email: string, password: string): Promise<AuthResponse> {
    const response = await api.post('/register', { username, email, password })
    return response.data
  },
  
  async logout(): Promise<void> {
    await api.post('/logout')
  }
}
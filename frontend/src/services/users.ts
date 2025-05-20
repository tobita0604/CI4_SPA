import api from './api'
import { User } from '@/types'

export const usersService = {
  async getUsers() {
    const response = await api.get('/users')
    return response.data
  },

  async getUser(id: number) {
    const response = await api.get(`/users/${id}`)
    return response.data
  },

  async createUser(userData: Partial<User>) {
    const response = await api.post('/users', userData)
    return response.data
  },

  async updateUser(id: number, userData: Partial<User>) {
    const response = await api.put(`/users/${id}`, userData)
    return response.data
  },

  async deleteUser(id: number) {
    const response = await api.delete(`/users/${id}`)
    return response.data
  }
}
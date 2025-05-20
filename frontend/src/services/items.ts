import api from './api'
import { Item } from '@/types'

export const itemsService = {
  async getItems() {
    const response = await api.get('/items')
    return response.data
  },

  async getItem(id: number) {
    const response = await api.get(`/items/${id}`)
    return response.data
  },

  async createItem(itemData: Partial<Item>) {
    const response = await api.post('/items', itemData)
    return response.data
  },

  async updateItem(id: number, itemData: Partial<Item>) {
    const response = await api.put(`/items/${id}`, itemData)
    return response.data
  },

  async deleteItem(id: number) {
    const response = await api.delete(`/items/${id}`)
    return response.data
  }
}
import { defineStore } from 'pinia'
import axios from 'axios'

interface Item {
  id: number
  name: string
  description: string
  price: number
  status: string
  created_at: string
  updated_at: string
}

interface ItemsState {
  items: Item[]
  currentItem: Item | null
  loading: boolean
  error: string | null
}

export const useItemsStore = defineStore('items', {
  state: (): ItemsState => ({
    items: [],
    currentItem: null,
    loading: false,
    error: null,
  }),
  
  getters: {
    getItems: (state) => state.items,
    getCurrentItem: (state) => state.currentItem,
  },
  
  actions: {
    async fetchItems() {
      this.loading = true
      this.error = null
      
      try {
        const response = await axios.get('/api/items')
        
        if (response.data.status === 'success') {
          this.items = response.data.data
        } else {
          this.error = 'Failed to fetch items'
        }
      } catch (error: any) {
        this.error = error.response?.data?.message || 'An error occurred while fetching items'
      } finally {
        this.loading = false
      }
    },
    
    async fetchItem(id: number) {
      this.loading = true
      this.error = null
      
      try {
        const response = await axios.get(`/api/items/${id}`)
        
        if (response.data.status === 'success') {
          this.currentItem = response.data.data
          return this.currentItem
        } else {
          this.error = 'Failed to fetch item'
          return null
        }
      } catch (error: any) {
        this.error = error.response?.data?.message || 'An error occurred while fetching the item'
        return null
      } finally {
        this.loading = false
      }
    },
    
    async createItem(item: Omit<Item, 'id' | 'created_at' | 'updated_at'>) {
      this.loading = true
      this.error = null
      
      try {
        const response = await axios.post('/api/items', item)
        
        if (response.data.status === 'success') {
          this.items.push(response.data.data)
          return response.data.data
        } else {
          this.error = 'Failed to create item'
          return null
        }
      } catch (error: any) {
        this.error = error.response?.data?.message || 'An error occurred while creating the item'
        return null
      } finally {
        this.loading = false
      }
    },
    
    async updateItem(id: number, itemData: Partial<Item>) {
      this.loading = true
      this.error = null
      
      try {
        const response = await axios.put(`/api/items/${id}`, itemData)
        
        if (response.data.status === 'success') {
          const index = this.items.findIndex(item => item.id === id)
          if (index !== -1) {
            this.items[index] = response.data.data
          }
          this.currentItem = response.data.data
          return this.currentItem
        } else {
          this.error = 'Failed to update item'
          return null
        }
      } catch (error: any) {
        this.error = error.response?.data?.message || 'An error occurred while updating the item'
        return null
      } finally {
        this.loading = false
      }
    },
    
    async deleteItem(id: number) {
      this.loading = true
      this.error = null
      
      try {
        const response = await axios.delete(`/api/items/${id}`)
        
        if (response.data.status === 'success') {
          this.items = this.items.filter(item => item.id !== id)
          if (this.currentItem && this.currentItem.id === id) {
            this.currentItem = null
          }
          return true
        } else {
          this.error = 'Failed to delete item'
          return false
        }
      } catch (error: any) {
        this.error = error.response?.data?.message || 'An error occurred while deleting the item'
        return false
      } finally {
        this.loading = false
      }
    },
  }
})
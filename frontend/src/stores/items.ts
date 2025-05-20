import { defineStore } from 'pinia'
import { ref } from 'vue'
import { Item } from '@/types'
import { itemsService } from '@/services/items'

export const useItemsStore = defineStore('items', () => {
  const items = ref<Item[]>([])
  const currentItem = ref<Item | null>(null)
  const loading = ref(false)
  const error = ref<string | null>(null)

  async function fetchItems() {
    loading.value = true
    error.value = null

    try {
      const response = await itemsService.getItems()
      items.value = response.items
    } catch (err: any) {
      error.value = err.message || 'Failed to fetch items'
    } finally {
      loading.value = false
    }
  }

  async function fetchItem(id: number) {
    loading.value = true
    error.value = null

    try {
      const response = await itemsService.getItem(id)
      currentItem.value = response.item
      return response.item
    } catch (err: any) {
      error.value = err.message || `Failed to fetch item #${id}`
      return null
    } finally {
      loading.value = false
    }
  }

  async function createItem(itemData: Partial<Item>) {
    loading.value = true
    error.value = null

    try {
      const response = await itemsService.createItem(itemData)
      items.value.push(response.item)
      return response.item
    } catch (err: any) {
      error.value = err.message || 'Failed to create item'
      return null
    } finally {
      loading.value = false
    }
  }

  async function updateItem(id: number, itemData: Partial<Item>) {
    loading.value = true
    error.value = null

    try {
      await itemsService.updateItem(id, itemData)
      
      // Update the local state
      const index = items.value.findIndex(item => item.id === id)
      if (index !== -1) {
        items.value[index] = { ...items.value[index], ...itemData }
      }
      
      return true
    } catch (err: any) {
      error.value = err.message || `Failed to update item #${id}`
      return false
    } finally {
      loading.value = false
    }
  }

  async function deleteItem(id: number) {
    loading.value = true
    error.value = null

    try {
      await itemsService.deleteItem(id)
      
      // Remove from local state
      items.value = items.value.filter(item => item.id !== id)
      
      return true
    } catch (err: any) {
      error.value = err.message || `Failed to delete item #${id}`
      return false
    } finally {
      loading.value = false
    }
  }

  return {
    items,
    currentItem,
    loading,
    error,
    fetchItems,
    fetchItem,
    createItem,
    updateItem,
    deleteItem
  }
})
import { defineStore } from 'pinia'
import { ref } from 'vue'
import { User } from '@/types'
import { usersService } from '@/services/users'

export const useUsersStore = defineStore('users', () => {
  const users = ref<User[]>([])
  const currentUser = ref<User | null>(null)
  const loading = ref(false)
  const error = ref<string | null>(null)

  async function fetchUsers() {
    loading.value = true
    error.value = null

    try {
      const response = await usersService.getUsers()
      users.value = response.users
    } catch (err: any) {
      error.value = err.message || 'Failed to fetch users'
    } finally {
      loading.value = false
    }
  }

  async function fetchUser(id: number) {
    loading.value = true
    error.value = null

    try {
      const response = await usersService.getUser(id)
      currentUser.value = response.user
      return response.user
    } catch (err: any) {
      error.value = err.message || `Failed to fetch user #${id}`
      return null
    } finally {
      loading.value = false
    }
  }

  async function createUser(userData: Partial<User>) {
    loading.value = true
    error.value = null

    try {
      const response = await usersService.createUser(userData)
      users.value.push(response.user)
      return response.user
    } catch (err: any) {
      error.value = err.message || 'Failed to create user'
      return null
    } finally {
      loading.value = false
    }
  }

  async function updateUser(id: number, userData: Partial<User>) {
    loading.value = true
    error.value = null

    try {
      await usersService.updateUser(id, userData)
      
      // Update the local state
      const index = users.value.findIndex(user => user.id === id)
      if (index !== -1) {
        users.value[index] = { ...users.value[index], ...userData }
      }
      
      return true
    } catch (err: any) {
      error.value = err.message || `Failed to update user #${id}`
      return false
    } finally {
      loading.value = false
    }
  }

  async function deleteUser(id: number) {
    loading.value = true
    error.value = null

    try {
      await usersService.deleteUser(id)
      
      // Remove from local state
      users.value = users.value.filter(user => user.id !== id)
      
      return true
    } catch (err: any) {
      error.value = err.message || `Failed to delete user #${id}`
      return false
    } finally {
      loading.value = false
    }
  }

  return {
    users,
    currentUser,
    loading,
    error,
    fetchUsers,
    fetchUser,
    createUser,
    updateUser,
    deleteUser
  }
})
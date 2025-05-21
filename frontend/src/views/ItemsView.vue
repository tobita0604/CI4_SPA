<template>
  <div>
    <div class="d-flex justify-space-between align-center mb-4">
      <h1 class="text-2xl font-bold">Items Management</h1>
      <v-btn color="primary" prepend-icon="mdi-plus" @click="openDialog()">
        Add New Item
      </v-btn>
    </div>
    
    <v-alert
      v-if="itemsStore.error"
      type="error"
      variant="tonal"
      class="mb-4"
      data-test="error-alert"
    >
      {{ itemsStore.error }}
    </v-alert>
    
    <!-- Loading state -->
    <div v-if="itemsStore.loading" class="d-flex justify-center my-8" data-test="loading-indicator">
      <v-progress-circular
        indeterminate
        color="primary"
        size="64"
      ></v-progress-circular>
    </div>
    
    <!-- Items table -->
    <v-card v-else>
      <v-table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in itemsStore.items" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.description ? item.description.substring(0, 50) + (item.description.length > 50 ? '...' : '') : '' }}</td>
            <td>$ {{ item.price }}</td>
            <td>
              <v-chip
                :color="item.status === 'active' ? 'success' : 'error'"
                :text="item.status === 'active' ? 'Active' : 'Inactive'"
                size="small"
              ></v-chip>
            </td>
            <td>{{ formatDate(item.created_at) }}</td>
            <td>
              <v-btn
                icon
                variant="text"
                color="primary"
                size="small"
                @click="openDialog(item)"
              >
                <v-icon>mdi-pencil</v-icon>
              </v-btn>
              <v-btn
                icon
                variant="text"
                color="error"
                size="small"
                @click="confirmDelete(item)"
              >
                <v-icon>mdi-delete</v-icon>
              </v-btn>
            </td>
          </tr>
        </tbody>
      </v-table>
    </v-card>
    
    <!-- Item form dialog -->
    <v-dialog v-model="dialogOpen" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="text-h5">{{ isEditing ? 'Edit Item' : 'Add New Item' }}</span>
        </v-card-title>
        
        <v-card-text>
          <v-form @submit.prevent="saveItem" ref="form">
            <v-text-field
              v-model="formData.name"
              label="Name"
              required
              :rules="[rules.required, rules.minLength]"
            ></v-text-field>
            
            <v-textarea
              v-model="formData.description"
              label="Description"
              rows="3"
            ></v-textarea>
            
            <v-text-field
              v-model.number="formData.price"
              label="Price"
              type="number"
              required
              :rules="[rules.required, rules.numeric]"
              prefix="$"
            ></v-text-field>
            
            <v-select
              v-model="formData.status"
              label="Status"
              :items="['active', 'inactive']"
              required
              :rules="[rules.required]"
            ></v-select>
          </v-form>
        </v-card-text>
        
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="dialogOpen = false">Cancel</v-btn>
          <v-btn color="blue-darken-1" variant="text" @click="saveItem">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    
    <!-- Delete confirmation dialog -->
    <v-dialog v-model="deleteDialog" max-width="400">
      <v-card>
        <v-card-title class="text-h5">
          Delete Item
        </v-card-title>
        <v-card-text>
          Are you sure you want to delete this item? This action cannot be undone.
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="deleteDialog = false">Cancel</v-btn>
          <v-btn color="error" variant="text" @click="deleteItem">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, reactive, onMounted } from 'vue'
import { useItemsStore } from '@/store/items'

export default defineComponent({
  name: 'ItemsView',
  
  setup() {
    const itemsStore = useItemsStore()
    const form = ref(null)
    const dialogOpen = ref(false)
    const deleteDialog = ref(false)
    const isEditing = ref(false)
    const itemToDelete = ref<number | null>(null)
    
    const formData = reactive({
      id: null as number | null,
      name: '',
      description: '',
      price: 0,
      status: 'active',
    })
    
    const rules = {
      required: (v: any) => !!v || 'This field is required',
      minLength: (v: string) => v.length >= 3 || 'Minimum length is 3 characters',
      numeric: (v: number) => !isNaN(v) || 'Must be a number',
    }
    
    // Fetch items when component mounts
    onMounted(() => {
      itemsStore.fetchItems()
    })
    
    const openDialog = (item?: any) => {
      if (item) {
        // Edit mode
        formData.id = item.id
        formData.name = item.name
        formData.description = item.description || ''
        formData.price = item.price
        formData.status = item.status
        isEditing.value = true
      } else {
        // Create mode
        formData.id = null
        formData.name = ''
        formData.description = ''
        formData.price = 0
        formData.status = 'active'
        isEditing.value = false
      }
      dialogOpen.value = true
    }
    
    const saveItem = async () => {
      // If form validation fails, don't proceed
      if (form.value && !(form.value as any).validate().valid) {
        return
      }
      
      if (isEditing.value && formData.id) {
        // Update existing item
        await itemsStore.updateItem(formData.id, {
          name: formData.name,
          description: formData.description,
          price: formData.price,
          status: formData.status,
        })
      } else {
        // Create new item
        await itemsStore.createItem({
          name: formData.name,
          description: formData.description,
          price: formData.price,
          status: formData.status,
        })
      }
      
      // Close the dialog
      dialogOpen.value = false
    }
    
    const confirmDelete = (item: any) => {
      itemToDelete.value = item.id
      deleteDialog.value = true
    }
    
    const deleteItem = async () => {
      if (itemToDelete.value) {
        await itemsStore.deleteItem(itemToDelete.value)
        deleteDialog.value = false
        itemToDelete.value = null
      }
    }
    
    const formatDate = (dateString: string) => {
      if (!dateString) return ''
      
      const date = new Date(dateString)
      return date.toLocaleDateString()
    }
    
    return {
      itemsStore,
      dialogOpen,
      deleteDialog,
      isEditing,
      formData,
      form,
      rules,
      openDialog,
      saveItem,
      confirmDelete,
      deleteItem,
      formatDate,
    }
  }
})
</script>
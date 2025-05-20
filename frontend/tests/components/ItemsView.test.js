import { mount } from '@vue/test-utils'
import { createTestingPinia } from '@pinia/testing'
import ItemsView from '@/views/ItemsView.vue'
import { useItemsStore } from '@/store/items'

// Mock Vuetify components
jest.mock('vuetify/components', () => ({
  VTable: {
    name: 'v-table',
    template: '<table><slot></slot></table>'
  },
  VBtn: {
    name: 'v-btn',
    template: '<button><slot></slot></button>'
  },
  VAlert: {
    name: 'v-alert',
    template: '<div><slot></slot></div>'
  },
  VCard: {
    name: 'v-card',
    template: '<div><slot></slot></div>'
  },
  VDialog: {
    name: 'v-dialog',
    template: '<div><slot></slot></div>'
  },
  VForm: {
    name: 'v-form',
    template: '<form><slot></slot></form>'
  },
  VTextField: {
    name: 'v-text-field',
    template: '<input />'
  },
  VTextarea: {
    name: 'v-textarea',
    template: '<textarea></textarea>'
  },
  VSelect: {
    name: 'v-select',
    template: '<select><slot></slot></select>'
  },
  VChip: {
    name: 'v-chip',
    template: '<span><slot></slot></span>'
  },
  // Add other necessary components
}))

describe('ItemsView', () => {
  let wrapper
  let store

  beforeEach(() => {
    const pinia = createTestingPinia()
    store = useItemsStore(pinia)
    
    // Mock store actions
    store.fetchItems = jest.fn()
    
    wrapper = mount(ItemsView, {
      global: {
        plugins: [pinia],
        mocks: {
          $router: {
            push: jest.fn()
          }
        }
      }
    })
  })

  it('renders correctly', () => {
    expect(wrapper.find('h1').text()).toBe('Items Management')
    expect(wrapper.find('button').text()).toContain('Add New Item')
  })

  it('calls fetchItems on mount', () => {
    expect(store.fetchItems).toHaveBeenCalled()
  })

  it('shows loading state when loading is true', async () => {
    store.loading = true
    await wrapper.vm.$nextTick()
    expect(wrapper.find('[data-test="loading-indicator"]').exists()).toBe(true)
  })

  it('shows error alert when there is an error', async () => {
    store.error = 'Test error message'
    await wrapper.vm.$nextTick()
    expect(wrapper.find('[data-test="error-alert"]').exists()).toBe(true)
    expect(wrapper.find('[data-test="error-alert"]').text()).toContain('Test error message')
  })

  it('opens dialog on add new item button click', async () => {
    const addButton = wrapper.find('button')
    await addButton.trigger('click')
    expect(wrapper.vm.dialogOpen).toBe(true)
    expect(wrapper.vm.isEditing).toBe(false)
  })
})
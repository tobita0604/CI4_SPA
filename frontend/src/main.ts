import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import { useAuthStore } from './store/auth'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'

// Tailwind CSS
import './assets/css/tailwind.css'

const vuetify = createVuetify({
  components,
  directives,
})

// Set base URL for axios
axios.defaults.baseURL = ''

const pinia = createPinia()
const app = createApp(App)
app.use(pinia)
app.use(router)
app.use(vuetify)

// Initialize auth state before mounting the app
const authStore = useAuthStore(pinia)
authStore.initAuth()

app.mount('#app')
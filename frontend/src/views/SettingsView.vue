<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Settings</h1>
    
    <v-card>
      <v-tabs v-model="tab">
        <v-tab value="general">General</v-tab>
        <v-tab value="security">Security</v-tab>
        <v-tab value="appearance">Appearance</v-tab>
        <v-tab value="notifications">Notifications</v-tab>
      </v-tabs>
      
      <v-card-text>
        <v-window v-model="tab">
          <!-- General Settings -->
          <v-window-item value="general">
            <v-form>
              <v-text-field
                v-model="settings.siteName"
                label="Site Name"
              ></v-text-field>
              
              <v-text-field
                v-model="settings.siteUrl"
                label="Site URL"
              ></v-text-field>
              
              <v-select
                v-model="settings.language"
                :items="languages"
                label="Default Language"
              ></v-select>
              
              <v-select
                v-model="settings.timezone"
                :items="timezones"
                label="Timezone"
              ></v-select>
              
              <v-btn color="primary" class="mt-4">Save Changes</v-btn>
            </v-form>
          </v-window-item>
          
          <!-- Security Settings -->
          <v-window-item value="security">
            <v-form>
              <v-switch
                v-model="settings.twoFactorAuth"
                label="Enable Two-Factor Authentication"
              ></v-switch>
              
              <v-switch
                v-model="settings.autoLogout"
                label="Auto Logout After Inactivity"
              ></v-switch>
              
              <v-text-field
                v-model="settings.sessionTimeout"
                label="Session Timeout (minutes)"
                type="number"
              ></v-text-field>
              
              <v-btn color="primary" class="mt-4">Save Changes</v-btn>
            </v-form>
          </v-window-item>
          
          <!-- Appearance Settings -->
          <v-window-item value="appearance">
            <v-form>
              <v-radio-group v-model="settings.theme" label="Theme">
                <v-radio label="Light" value="light"></v-radio>
                <v-radio label="Dark" value="dark"></v-radio>
                <v-radio label="System Default" value="system"></v-radio>
              </v-radio-group>
              
              <v-select
                v-model="settings.primaryColor"
                :items="colors"
                label="Primary Color"
              ></v-select>
              
              <v-btn color="primary" class="mt-4">Save Changes</v-btn>
            </v-form>
          </v-window-item>
          
          <!-- Notifications Settings -->
          <v-window-item value="notifications">
            <v-form>
              <v-switch
                v-model="settings.emailNotifications"
                label="Email Notifications"
              ></v-switch>
              
              <v-switch
                v-model="settings.pushNotifications"
                label="Push Notifications"
              ></v-switch>
              
              <v-btn color="primary" class="mt-4">Save Changes</v-btn>
            </v-form>
          </v-window-item>
        </v-window>
      </v-card-text>
    </v-card>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, reactive } from 'vue'

export default defineComponent({
  name: 'SettingsView',
  setup() {
    const tab = ref('general')
    
    const settings = reactive({
      siteName: 'CI4 SPA Admin',
      siteUrl: 'https://example.com',
      language: 'English',
      timezone: 'UTC',
      twoFactorAuth: false,
      autoLogout: true,
      sessionTimeout: 30,
      theme: 'light',
      primaryColor: 'blue',
      emailNotifications: true,
      pushNotifications: false
    })
    
    const languages = ['English', 'Spanish', 'French', 'German', 'Japanese']
    const timezones = ['UTC', 'America/New_York', 'Europe/London', 'Asia/Tokyo']
    const colors = ['blue', 'red', 'green', 'purple', 'orange']
    
    return {
      tab,
      settings,
      languages,
      timezones,
      colors
    }
  }
})
</script>
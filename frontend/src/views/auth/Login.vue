<template>
  <div class="login-container">
    <div class="login-box">
      <h1 class="title">CI4 SPA Admin</h1>
      
      <el-alert
        v-if="authStore.error"
        :title="authStore.error"
        type="error"
        show-icon
        :closable="true"
        @close="authStore.error = null"
      />
      
      <el-form ref="loginForm" :model="form" :rules="rules" label-position="top" class="login-form">
        <el-form-item label="Email" prop="email">
          <el-input v-model="form.email" placeholder="Enter your email" />
        </el-form-item>
        
        <el-form-item label="Password" prop="password">
          <el-input 
            v-model="form.password" 
            placeholder="Enter your password" 
            type="password" 
            show-password
            @keyup.enter="handleLogin"
          />
        </el-form-item>
        
        <el-form-item>
          <el-button 
            type="primary" 
            class="login-button" 
            :loading="authStore.loading" 
            @click="handleLogin"
          >
            Login
          </el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { ElMessage } from 'element-plus'
import { useAuthStore } from '@/stores/auth'
import type { FormInstance, FormRules } from 'element-plus'

export default defineComponent({
  name: 'LoginView',
  setup() {
    const router = useRouter()
    const authStore = useAuthStore()
    const loginForm = ref<FormInstance>()
    
    const form = reactive({
      email: '',
      password: ''
    })
    
    const rules = reactive<FormRules>({
      email: [
        { required: true, message: 'Please input your email', trigger: 'blur' },
        { type: 'email', message: 'Please input a valid email', trigger: 'blur' }
      ],
      password: [
        { required: true, message: 'Please input your password', trigger: 'blur' },
        { min: 6, message: 'Password must be at least 6 characters', trigger: 'blur' }
      ]
    })
    
    const handleLogin = async () => {
      if (!loginForm.value) return
      
      await loginForm.value.validate(async (valid) => {
        if (valid) {
          const success = await authStore.login(form.email, form.password)
          if (success) {
            ElMessage.success('Login successful')
            router.push('/dashboard')
          }
        } else {
          return false
        }
      })
    }
    
    return {
      loginForm,
      form,
      rules,
      authStore,
      handleLogin
    }
  }
})
</script>

<style scoped>
.login-container {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f0f2f5;
}

.login-box {
  width: 400px;
  padding: 40px;
  background-color: #fff;
  border-radius: 4px;
  box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  margin-bottom: 30px;
  color: #303133;
}

.login-form {
  margin-top: 20px;
}

.login-button {
  width: 100%;
}
</style>
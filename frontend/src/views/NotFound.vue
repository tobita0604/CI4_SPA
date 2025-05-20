<template>
  <div class="not-found">
    <h1>404</h1>
    <p>The page you are looking for does not exist.</p>
    <el-button type="primary" @click="goHome">Go Home</el-button>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { useRouter } from 'vue-router'

export default defineComponent({
  name: 'NotFound',
  setup() {
    const router = useRouter()
    
    const goHome = () => {
      router.push('/')
    }
    
    return { goHome }
  }
})
</script>

<style scoped>
.not-found {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  padding: 20px;
}

h1 {
  font-size: 72px;
  margin-bottom: 20px;
  color: #303133;
}

p {
  font-size: 20px;
  color: #606266;
  margin-bottom: 30px;
}
</style>
import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    redirect: '/dashboard'
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/auth/Login.vue'),
    meta: { requiresAuth: false }
  },
  {
    path: '/dashboard',
    component: () => import('@/layouts/Dashboard.vue'),
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        name: 'dashboard',
        component: () => import('@/views/dashboard/Index.vue')
      },
      {
        path: 'users',
        name: 'users',
        component: () => import('@/views/users/Index.vue')
      },
      {
        path: 'users/create',
        name: 'users-create',
        component: () => import('@/views/users/Create.vue')
      },
      {
        path: 'users/:id/edit',
        name: 'users-edit',
        component: () => import('@/views/users/Edit.vue'),
        props: true
      },
      {
        path: 'items',
        name: 'items',
        component: () => import('@/views/items/Index.vue')
      },
      {
        path: 'items/create',
        name: 'items-create',
        component: () => import('@/views/items/Create.vue')
      },
      {
        path: 'items/:id/edit',
        name: 'items-edit',
        component: () => import('@/views/items/Edit.vue'),
        props: true
      }
    ]
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: () => import('@/views/NotFound.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth !== false)

  if (requiresAuth && !authStore.isAuthenticated) {
    next('/login')
  } else {
    next()
  }
})

export default router
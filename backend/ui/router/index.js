import { createRouter, createWebHashHistory } from 'vue-router'
import { blockRoutes } from './blockRouter'
import { pageRoutes } from './pageRouter'
import { useUserStore } from '../store/user'
import { useNavigationStore } from '../store/navigation'
import { useSessionStore } from '../store/session'
import LocalStorageService from '../services/LocalStorageService'
import AuthorizationService from '../services/AuthorizationService'

const app = () => import('../backoffice/components/App.vue')
const loginForm = () => import('../backoffice/auth/Login.vue')

const routes = [
  {
    path: '/login',
    name: 'login',
    component: loginForm,
    meta: { requiresAuth: false }
  },
  {
    path: '/',
    name: 'home',
    component: app,
    meta: {
      requiresAuth: true,
      breadcrumb: 'Dashboard'
    },
    props: true,
    children: []
      .concat(pageRoutes)
      .concat(blockRoutes)
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const userStore = useUserStore()
  const sessionStore = useSessionStore()
  const navigationStore = useNavigationStore()
  const token = LocalStorageService.getAuthToken()

  if (token) {
    sessionStore.setAuthToken(token)

    if (!userStore.getLoggedUser) {
      AuthorizationService.getMe()
        .then(
          response => {
            userStore.setLoggedUser(response.data)
          }
        )
    }
  }

  if (to.name !== 'login' && to.meta.requiresAuth && !sessionStore.getAuthToken) next({ name: 'login' })

  navigationStore.setBreadcrumbs(to.meta.breadcrumb, to.name, to.params)

  next()
})

export default router

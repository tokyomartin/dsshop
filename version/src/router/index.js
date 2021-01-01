import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue')
  },
  {
    path: '/install',
    name: 'Install',
    component: () => import('../views/install/index.vue'),
    children: [
      {
        name: 'Server',
        path: 'server',
        component: import('../views/install/server.vue')
      },
      {
        name: 'Jurisdiction',
        path: 'jurisdiction',
        component: import('../views/install/jurisdiction.vue')
      }
    ]
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router

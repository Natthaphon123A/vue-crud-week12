import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import CustomerManagement from '../views/CustomerManagement.vue';
import DepartmentManagement from '../views/DepartmentManagement.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView
  },
  {
    path: '/customer',
    name: 'Customer',
    component: CustomerManagement
  },
  {
    path: '/department',
    name: 'Department',
    component: DepartmentManagement
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
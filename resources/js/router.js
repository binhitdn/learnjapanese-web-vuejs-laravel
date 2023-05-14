import { createWebHistory, createRouter } from 'vue-router';
import home from './pages/Home.vue';
import login from './pages/Login.vue';
import register from './pages/Register.vue';
import dashboard from './pages/Dashboard.vue';
import Create from './pages/Learn/Create.vue';
import Course from './pages/Course.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },
    {
        path: '/login',
        name: 'Login',
        component: login,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: register,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/create-set',
        name: 'CreateSet',
        component: Create,
    },
    {
        path: '/edit-set/:id',
        name: 'EditSet',
        component: () => import('./pages/Learn/Edit.vue'),
    },
    {
        path: '/courses/:id',
        name: 'Course',
        component: Course,
    },
    {
        path: '/test/:id',
        name: 'Test',
        component: () => import('./pages/TestPage.vue'),
        props: true
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: '/'

    },


];

const router = createRouter({
    history: createWebHistory(),
    routes
});


router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        return { name: 'Login' }
    }
    if (to.meta.requiresAuth == false && localStorage.getItem('token')) {
        return { name: 'Dashboard' }
    }
})

export default router;
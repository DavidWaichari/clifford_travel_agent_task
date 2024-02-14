
import { createWebHistory, createRouter } from 'vue-router'

/* Guest Component */
import Login from '../components/authentication/Login.vue';
import AccommodationsList from '../components/AccommodationsList.vue';
/* Layouts */



const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "home",
        path: "/",
        component: AccommodationsList,
        meta: {
            middleware: "auth",
            title: `AccommodationsList`
        }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach( async (to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        next()
    } else {
        await axios.get('/api/auth/user')
        .then(response => {
            next()
        })
        .catch(error => {
            if (error.response && error.response.status === 401) {
                next({ name: "login" })
            } else {
            console.log(error.response)
            }
        });
    }
})

export default router
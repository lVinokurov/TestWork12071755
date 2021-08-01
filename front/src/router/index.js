import Vue from 'vue'
import VueRouter from 'vue-router'

/* Pages */
import article from './article'
import Article from '@/views/article/Article'

/* Error */
import Error404 from "@/views/error/Error404";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        redirect: 'articles'
    },
    {
        path: '/articles',
        name: 'Article',
        component: Article,
        children: [
            ...article
        ],
    },
    // the 404 route, when none of the above matches
    {
        path: "*",
        redirect: "/404"
    },
    {
        path: "/404",
        name: "404",
        component: Error404
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router

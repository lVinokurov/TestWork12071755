import IndexArticle from '@/views/article/IndexArticle'
import UpdateArticle from '@/views/article/UpdateArticle'
import CreateArticle from '@/views/article/CreateArticle'

export default [
    {
        path: '',
        name: 'indexArticle',
        component: IndexArticle,
        meta: {
            layout: 'Main'
        },
    },
    {
        path: 'create',
        name: 'createArticle',
        component: CreateArticle,
    },
    {
        path: ':id',
        name: 'updateArticle',
        component: UpdateArticle,
        props: true
    },
]

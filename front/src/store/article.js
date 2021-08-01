import { HTTP } from '@/config/http.service'

export default {
    namespaced: true,
    actions: {
        async fetchArticles({dispatch}, queryParams){
            return await HTTP.get('/articles', {params: queryParams})
                .then(res => res)
                .catch(err => {
                    dispatch('error/setError', err, {root: true})
                    throw err
                })
        },
        async fetchArticle({dispatch}, id){
            return await HTTP.get(`/articles/${id}`)
                .then(res => res)
                .catch(err => {
                    dispatch('error/setError', err, {root: true})
                    throw err
                })
        },
        async createArticle({dispatch}, payload){
            return await HTTP.post('/articles', payload)
                .then(res => res)
                .catch(err => {
                    dispatch('error/setError', err, {root: true})
                    throw err
                })
        },
        async updateArticle({dispatch}, payload){
            return await HTTP.put(`/articles/${payload.id}`, payload.data)
                .then(res => res)
                .catch(err => {
                    dispatch('error/setError', err, {root: true})
                    throw err
                })
        },
        async destroyArticle({dispatch}, id){
            return await HTTP.delete(`/articles/${id}`)
                .then(res => res)
                .catch(err => {
                    dispatch('error/setError', err, {root: true})
                    throw err
                })
        },
    },
}

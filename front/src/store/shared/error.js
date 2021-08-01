export default {
    namespaced: true,
    state: {
        error: null
    },
    mutations: {
        setError(state, payload){
            state.error = payload
        },
        clearError(state){
            state.error = null
        }
    },
    actions: {
        setError({commit, dispatch}, payload){
            let message = payload
            if(typeof payload === 'object'){
                if(payload.response){
                    if(payload.response.data.msg){
                        message = payload.response.data.msg
                    }else if(payload.response.status === 422) {
                        let text_error = ''
                        for (let item in payload.response.data.errors)
                            for (let error in payload.response.data.errors[item])
                                text_error += payload.response.data.errors[item][error] + '\n'
                        message = text_error
                    }else if(payload.response.status === 401){
                        message = 'У вас нет прав для данного действия'
                    }else if(/^5[0-9]{2}$/.test(payload.response.status)){
                        message = 'Ошибка на сервере. Обратитесь в службу поддержки'
                    }
                }else if(payload.request){
                    message = 'Нет ответа от сервера'
                }else{
                    message = 'Неизвестная ошибка. Обратитесь в службу поддержки'
                }
            }
            dispatch('clearError').then(() => {
                commit('setError', message)
            })
        },
        clearError({commit}){
            commit('clearError')
        }
    },
    getters: {
        error (state) {
            return state.error
        },
    },
}

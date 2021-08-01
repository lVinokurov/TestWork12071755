import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import article from "@/store/article"
import error from '@/store/shared/error'

export default new Vuex.Store({
  modules: {
    article,
    error
  }
})

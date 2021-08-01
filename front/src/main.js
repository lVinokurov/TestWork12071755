import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

/* Plugins */
import './plugins/bootstrap-vue'
import './plugins/vue-toastification'
import './plugins/vue-sweetalert2'
import './plugins/vuelidate'
import i18n from './plugins/vue-i18n';

/* Layouts */
import Main from '@/layouts/Main'
Vue.component('Main', Main)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  i18n,
  render: function (h) { return h(App) }
}).$mount('#app')

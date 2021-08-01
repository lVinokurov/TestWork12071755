<template>
  <div id="app">
    <component :is="layout">
      <router-view/>
    </component>
  </div>
</template>

<script>
  export default {
    name: 'App',
    computed: {
      layout(){
        return this.$route.meta.layout || 'Main'
      },
      error() {
        return this.$store.getters['error/error']
      },
    },
    watch: {
      error: function(val) {
        if(val)
          this.$toast.error(val)
      },
      success: function(val) {
        if(val)
          this.$toast.success(val)
      }
    }
  }
</script>

<style lang="scss">
@import "@/assets/scss/vendors/bootstrap-vue/index";
</style>

<template>
  <a-layout class="main-container">
      <m-header></m-header>
      <a-layout>
        <m-menu></m-menu>
        <a-layout style="" class="right-container">
          <breadcrumb></breadcrumb>
          <a-layout-content class="content-container">
            <router-view></router-view>
          </a-layout-content>
        </a-layout>
      </a-layout>
  </a-layout>
</template>

<script>
import MHeader from './header/Index'
import MMenu from './menu/Index'
import Breadcrumb from './breadcrumb/Index'
export default {
  components: {
    MHeader,
    MMenu,
    Breadcrumb
  },
  data () {
    return {
      collapsed: false
    }
  }
}
</script>

<style scoped lang="scss">
 .main-container{
    height: 100%;
   .right-container{
     padding: 0 24px 24px;
     height: 100%
   }
   .content-container{
     background: #fff;
     padding: 24px;
     margin: 0;
     min-height: 280px;
   }
 }
</style>

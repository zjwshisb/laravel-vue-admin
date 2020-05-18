<template>
  <a-layout class="main-container">
      <a-layout>
        <m-menu></m-menu>
        <a-layout class="right-container">
          <m-header></m-header>
          <breadcrumb></breadcrumb>
          <a-layout-content class="content-container">
            <router-view></router-view>
          </a-layout-content>
          <m-footer></m-footer>
        </a-layout>
      </a-layout>
  </a-layout>
</template>

<script>
import MHeader from './header/index'
import MMenu from './menu/index'
import Breadcrumb from './breadcrumb/index'
import MFooter from './footer/index'
export default {
  components: {
    MHeader,
    MMenu,
    MFooter,
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
     justify-content: flex-start;
   }
   .content-container{
     padding: 10px;
     background: #fff;
     margin: 0;
     flex: 1;
     min-height: 280px;
     box-sizing: border-box;
     overflow: auto;
   }
 }
</style>

<template>
  <a-layout class="main-container">
      <a-layout>
        <m-menu></m-menu>
        <a-layout class="right-container" :style="{ marginLeft:$store.getters.currentMenuWidth + 'px' }">
          <m-header></m-header>
          <breadcrumb></breadcrumb>
          <a-layout-content class="content-container" :style="styles">
            <router-view></router-view>
          </a-layout-content>
          <m-footer></m-footer>
          <a-back-top class="back-to-top">
            <div class="ant-back-top-inner">
              UP
            </div>
          </a-back-top>
          <debug v-if="$store.getters.debug"></debug>
        </a-layout>
      </a-layout>
  </a-layout>
</template>

<script>
import MHeader from './header/index'
import MMenu from './menu/index'
import Breadcrumb from './breadcrumb/index'
import MFooter from './footer/index'
import Debug from './debug/index'
export default {
  components: {
    MHeader,
    MMenu,
    MFooter,
    Breadcrumb,
    Debug
  },
  computed: {
    styles () {
      if (this.$store.getters.isMobile) {
        return {
          margin: '0 -24px'
        }
      } else {
        return {
          margin: 0
        }
      }
    }
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
   min-height: 100%;
   .right-container{
     padding: 0 24px 24px;
     justify-content: flex-start;
     overflow: auto;
     .back-to-top{
       right: 0;
       height: 40px;
       width: 40px;
       line-height: 40px;
       border-radius: 4px;
       background-color: #1088e9;
       color: #fff;
       text-align: center;
       font-size: 20px;
     }
   }
   .content-container{
     padding: 10px;
     background: #fff;
     min-height: 280px;
     flex-grow: 1;
     box-sizing: border-box;
   }
 }
</style>

import Vue from 'vue'
import store from '../store'
Vue.directive('pid', {
  bind: (el, binding, vnode) => {
    const pid = binding.value
    if (store.getters.pids.findIndex(v => v === pid) === -1) {
      el.style.display = 'none'
    }
  }
})

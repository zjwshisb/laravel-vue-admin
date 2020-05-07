<template>
  <div class="about">
    <h1>This is an about page</h1>
    <a-button type="primary">a</a-button>
  </div>
</template>
<script>
import { login } from '../api/user'
export default {
  data () {
    return {

    }
  },
  created () {
    login().then(res => {
      console.log(res)
    })
  }
}
</script>

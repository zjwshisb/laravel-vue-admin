<template>
 <a-form class="search-form" :labelCol="labelCol" :wrapperCol="wrapperCol">
   <slot></slot>
 </a-form>
</template>

<script>
import { searchForm } from '../../util/gird'
export default {
  name: 'Index',
  props: {
    labelCol: {
      type: Object,
      default () {
        return searchForm.labelCol
      }
    },
    wrapperCol: {
      type: Object,
      default () {
        return searchForm.wrapperCol
      }
    }
  }
}
</script>

<style scoped>

</style>

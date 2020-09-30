<template>
 <a-form class="search-form" :labelCol="labelCol" :wrapperCol="wrapperCol">
   <slot></slot>
 </a-form>
</template>

<script>
export default {
  name: 'Index',
  props: {
    labelCol: {
      type: Object,
      default () {
        return {
          xs: 24,
          sm: 6,
          md: 5,
          lg: 5,
          xl: 4,
          xll: 3
        }
      }
    },
    wrapperCol: {
      type: Object,
      default () {
        return {
          xs: 24,
          sm: 18,
          md: 19,
          lg: 19,
          xl: 20,
          xll: 21
        }
      }
    }
  }
}
</script>

<style scoped>

</style>

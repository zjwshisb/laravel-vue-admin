<template>
  <a-col :xs="xs" :sm="sm" :md="md" :lg="lg" :xl="xl" :xll="xll">
    <slot></slot>
  </a-col>
</template>

<script>
export default {
  name: 'searchFormCol',
  props: {
    xs: {
      type: Number,
      default: 24
    },
    sm: {
      type: Number,
      default: 24
    },
    md: {
      type: Number,
      default: 12
    },
    lg: {
      type: Number,
      default: 8
    },
    xl: {
      type: Number,
      default: 8
    },
    xll: {
      type: Number,
      default: 8
    }
  }
}
</script>

<style scoped>

</style>

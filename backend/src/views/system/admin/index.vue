<template>
 <div>
   <div class="filter-container">
     <a-button type="primary">新增</a-button>
   </div>
   <a-table :data-source="list">
   </a-table>
 </div>
</template>

<script>
export default {
  name: 'index',
  data () {
    return {
      list: []
    }
  }
}
</script>

<style scoped>

</style>

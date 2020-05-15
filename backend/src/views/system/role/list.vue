<template>
  <div>
    <div class="filter-container">
      <search-form>
        <a-row :gutter="12">
          <search-form-col>
            <a-form-item>
              <a-button icon="search" >查询</a-button>
              <a-button type="primary" icon="plus" @click="$router.push({name: 'AdminRoleAdd'})">新增</a-button>
            </a-form-item>
          </search-form-col>
        </a-row>
      </search-form>
    </div>
  </div>

</template>

<script>
export default {
  name: 'list'
}
</script>

<style scoped>

</style>

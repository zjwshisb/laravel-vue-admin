<template>
  <div>
    <div class="filter-container">
      <a-form layout="inline">
        <a-form-item label="key">
          <a-input v-model="key"></a-input>
        </a-form-item>
      </a-form>
    </div>
    <a-table :data-source="data" :columns="columns" row-key="key" bordered
             :loading="loading" :pagination="false"></a-table>
  </div>
</template>
<script>
import { getRedisInfo } from '../../../api/system'
export default {
  name: 'redis',
  data () {
    return {
      info: [],
      client: '',
      loading: false,
      key: '',
      columns: [
        {
          title: 'key',
          dataIndex: 'key',
          align: 'center'
        },
        {
          title: 'value',
          dataIndex: 'value',
          align: 'center'
        }
      ]
    }
  },
  computed: {
    data () {
      return this.info.filter(v => {
        return v.key.indexOf(this.key) > -1
      })
    }
  },
  methods: {
    handleGetData () {
      this.loading = true
      getRedisInfo().then(res => {
        this.loading = false
        if (res.code !== 0) {
          this.$error({
            title: '提示',
            content: res.message
          })
        } else {
          this.info = res.data.info
          this.client = res.data.client
        }
      })
    }
  },
  created () {
    this.handleGetData()
  }
}
</script>

<style scoped>

</style>

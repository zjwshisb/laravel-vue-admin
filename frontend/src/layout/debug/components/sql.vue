<template>
  <a-modal :visible="visible" :footer="null" @cancel="$emit('update:visible', false)" title="sql" width="1000px"
           :z-index="1010">
    <a-table :data-source="dataSource" :columns="columns" :pagination="false" :rowKey="rowKey"></a-table>
  </a-modal>
</template>

<script>
export default {
  name: 'sql',
  props: {
    visible: {
      type: Boolean,
      required: true
    },
    dataSource: {
      type: Array,
      required: true
    }
  },
  methods: {
    rowKey (record) {
      return Math.random()
    }
  },
  data () {
    return {
      columns: [
        {
          title: '#',
          align: 'center',
          customRender: (text, record, index) => {
            return index + 1
          }
        },
        {
          title: 'time(ms)',
          align: 'center',
          dataIndex: 'time',
          sorter: (a, b) => {
            return a.time - b.time
          }
        },
        {
          title: 'connection',
          align: 'center',
          dataIndex: 'connection'
        },
        {
          title: 'query',
          align: 'left',
          dataIndex: 'query'
        }
      ]
    }
  }
}
</script>

<style scoped>

</style>

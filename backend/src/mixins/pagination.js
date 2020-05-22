// 分页
export default {
  name: 'pagination',
  data () {
    return {
      pagination: {
        current: 1,
        defaultCurrent: 1,
        defaultPageSize: 10,
        hideOnSinglePage: false,
        pageSize: 10,
        pageSizeOptions: ['10', '20', '30', '50'],
        showQuickJumper: true,
        showSizeChanger: true,
        showTotal: total => `共 ${total} 条`,
        total: 0
      }
    }
  }
}

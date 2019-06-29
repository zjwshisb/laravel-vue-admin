export default {
  name: 'paginate',
  data() {
    return {
      query: {
        page: 1,
        size: 10
      },
      total: 1
    }
  },
  methods: {
    handleSizeChange(size) {
      this.query.size = size
      this.fetchList(true)
    },
    handleCurrentChange(page) {
      this.query.page = page
      this.fetchList(true)
    }
  }
}


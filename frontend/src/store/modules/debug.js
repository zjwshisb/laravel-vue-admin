const debug = {
  state: {
    logs: [],
    debug: process.env.NODE_ENV === 'development'
  },
  mutations: {
    ADD_LOG (state, log) {
      state.logs.unshift(log)
      if (state.logs.length > 20) {
        state.logs = state.logs.slice(0, 19)
      }
    }
  },
  actions: {
  },
  getters: {
    debugLogs: state => state.logs,
    debug: state => state.debug
  }
}
export default debug

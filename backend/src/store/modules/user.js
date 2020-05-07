const user = {
  state: {
    username: '',
    id: ''
  },
  mutations: {
    UPDATE_USER (state) {
      state.id = 1
      state.username = 2
    }
  },
  actions: {
    login ({ dispatch, commit }, form) {
      commit('UPDATE_USER')
      return dispatch('updateRoute')
    }
  },
  getters: {
    id: state => state.id
  }
}
export default user

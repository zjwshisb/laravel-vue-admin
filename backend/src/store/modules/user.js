import { login } from '../../api/user'
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
      return login(form).then(res => {
        console.log(res)
        return dispatch('updateRoute')
      })
    }
  },
  getters: {
    id: state => state.id
  }
}
export default user

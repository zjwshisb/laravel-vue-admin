import { login, getInfo } from '../../api/user'
import { setToken, getToken } from '../../util/token'
const user = {
  state: {
    username: '',
    id: '',
    token: getToken(),
    pids: []
  },
  mutations: {
    UPDATE_USER (state, user) {
      state.id = user.id
      state.username = user.username
      state.pids = user.pids
    },
    UPDATE_TOKEN (state, token) {
      state.token = token
    }
  },
  actions: {
    login ({ dispatch, commit }, form) {
      return login(form).then(res => {
        if (res.code === 0) {
          setToken(res.data.token)
          commit('UPDATE_TOKEN', res.data.token)
          return Promise.resolve(res.data)
        } else {
          return Promise.reject(res)
        }
      })
    },
    getUserInfo ({ commit, dispatch }) {
      return getInfo().then(res => {
        return dispatch('updateRoute').then(() => {
          commit('UPDATE_USER', res)
          return Promise.resolve(res)
        })
      })
    },
    frontendLogout ({ commit }) {
      commit('UPDATE_TOKEN', '')
      setToken('')
      return Promise.resolve()
    }
  },
  getters: {
    id: state => state.id,
    username: state => state.username,
    token: state => state.token,
    pids: state => state.pids
  }
}
export default user

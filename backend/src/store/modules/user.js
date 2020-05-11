import { login, getInfo } from '../../api/user'
import { setToken, getToken } from '../../util/token'
const user = {
  state: {
    username: '',
    id: '',
    token: getToken()
  },
  mutations: {
    UPDATE_USER (state, user) {
      state.id = user.id
      state.username = user.username
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
        } else {
          return Promise.reject(res)
        }
      })
    },
    getUserInfo ({ commit, dispatch }) {
      return getInfo().then(res => {
        if (res.code === 0) {
          return dispatch('updateRoute').then(() => {
            commit('UPDATE_USER', {
              id: res.data.id,
              username: res.data.username
            })
            return Promise.resolve()
          })
        }
      })
    },
    frontendLogout ({ commit }) {
      commit('UPDATE_TOKEN', '')

    }
  },
  getters: {
    id: state => state.id,
    token: state => state.token
  }
}
export default user

const app = {
  state: {
    menuHidden: false
  },
  mutations: {
    UPDATE_MENU_STATUS (state, status) {
      state.menuHidden = status
    }
  },
  actions: {
  },
  getters: {
    menuHidden: state => state.menuHidden
  }
}
export default app

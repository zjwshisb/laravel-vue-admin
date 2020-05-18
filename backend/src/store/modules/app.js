const app = {
  state: {
    menuHidden: false,
    isMobile: false
  },
  mutations: {
    UPDATE_MENU_STATUS (state, status) {
      state.menuHidden = status
    },
    UPDATE_IS_MOBILE (state, bool) {
      state.isMobile = bool
    }
  },
  actions: {
  },
  getters: {
    menuHidden: state => state.menuHidden,
    isMobile: state => state.isMobile
  }
}
export default app

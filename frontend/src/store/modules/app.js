const app = {
  state: {
    menuHidden: false,
    menuActiveKeys: [],
    isMobile: false
  },
  mutations: {
    UPDATE_MENU_STATUS (state, status) {
      state.menuHidden = status
    },
    UPDATE_IS_MOBILE (state, bool) {
      state.isMobile = bool
    },
    UPDATE_MENU_ACTIVE_KEYS (state, keys) {
      state.menuActiveKeys = keys
    }
  },
  actions: {
  },
  getters: {
    menuHidden: state => state.menuHidden,
    isMobile: state => state.isMobile,
    menuActiveKeys: state => state.menuActiveKeys
  }
}
export default app

const app = {
  state: {
    menuHidden: false,
    menuActiveKeys: [],
    isMobile: false,
    leftMenuWidth: 200
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
    menuActiveKeys: state => state.menuActiveKeys,
    leftMenuWidth: state => state.leftMenuWidth,
    currentMenuWidth: state => {
      if (state.isMobile) {
        return 0
      }
      if (state.menuHidden) {
        return 80
      }
      return state.leftMenuWidth
    },
    collapsedWidth: state => {
      if (state.isMobile) {
        return 0
      } else {
        return 80
      }
    }
  }
}
export default app

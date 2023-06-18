export default {
  getUser(state) {
    return state.user;
  },
  getToken(state) {
    return state.token;
  },
  getIsAuthenticated(_, getters) {
    return !!getters.getUser && !!getters.getToken;
  },
};

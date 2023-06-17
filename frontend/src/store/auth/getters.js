export default {
  user(state) {
    return state.user;
  },
  token(state) {
    return state.token;
  },
  isAuthenticated(_, getters) {
    return !!getters.user && !!getters.token;
  },
};

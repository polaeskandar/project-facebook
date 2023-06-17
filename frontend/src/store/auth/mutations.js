export default {
  setUser(state, payload) {
    state.user = payload;
    localStorage.setItem("user", JSON.stringify(payload));
  },
  setToken(state, payload) {
    state.token = payload;
    localStorage.setItem("token", JSON.stringify(payload));
  },
  removeUser(state) {
    state.user = null;
    localStorage.removeItem("user");
  },
  removeToken(state) {
    state.token = null;
    localStorage.removeItem("token");
  },
};

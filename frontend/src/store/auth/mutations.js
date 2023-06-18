export default {
  SET_USER(state, payload) {
    state.user = payload;
    localStorage.setItem("user", JSON.stringify(payload));
  },
  SET_TOKEN(state, payload) {
    state.token = payload;
    localStorage.setItem("token", JSON.stringify(payload));
  },
  REMOVE_USER(state) {
    state.user = null;
    localStorage.removeItem("user");
  },
  REMOVE_TOKEN(state) {
    state.token = null;
    localStorage.removeItem("token");
  },
};

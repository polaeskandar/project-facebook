export default {
  ADD_POSTS(state, payload) {
    state.posts = [...payload, ...state.posts];
  },
  SET_LOADING_STATE(state, payload) {
    state.loading = payload;
  },
};

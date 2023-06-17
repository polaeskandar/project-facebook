export default {
  setPosts(state, payload) {
    state.posts = [payload, ...state.posts];
  },
};

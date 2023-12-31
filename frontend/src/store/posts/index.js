import getters from "./getters";
import mutations from "./mutations";
import actions from "./actions";

const posts = {
  namespaced: true,
  state() {
    return {
      posts: [],
      loading: false,
    };
  },
  getters,
  mutations,
  actions,
};

export default posts;

import getters from "./getters";
import mutations from "./mutations";
import actions from "./actions";

const auth = {
  namespaced: true,
  state() {
    return {
      user: JSON.parse(localStorage.getItem("user")),
      token: JSON.parse(localStorage.getItem("token")),
    };
  },
  getters,
  mutations,
  actions,
};

export default auth;

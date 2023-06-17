import { createStore } from "vuex";

import auth from "./auth";
import posts from "./posts";

const store = createStore({
  modules: {
    auth: auth,
    posts: posts,
  },
});

export default store;

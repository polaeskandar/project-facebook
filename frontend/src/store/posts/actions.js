import axios from "axios";
import { CREATE_POST_URL, GET_POSTS_URL } from "../../contants";

const fetchPosts = async (context) => {
  context.commit("SET_LOADING_STATE", true);

  try {
    const response = await axios.get(GET_POSTS_URL);
    context.commit("ADD_POSTS", response.data.posts.data);
  } catch (error) {
    console.error(error);
  } finally {
    context.commit("SET_LOADING_STATE", false);
  }
};

const createPost = async (context, payload) => {
  context.commit("SET_LOADING_STATE", true);

  try {
    const response = await axios.post(
      CREATE_POST_URL,
      {
        body: payload.body,
        schedule_on: payload.scheduleOn,
      },
      { headers: { Authorization: `Bearer ${JSON.parse(localStorage.getItem("token"))}` } }
    );
    if (response.data.post) context.commit("ADD_POSTS", [response.data.post]);
  } catch (error) {
    console.error(error);
  } finally {
    context.commit("SET_LOADING_STATE", false);
  }
};

export default { fetchPosts, createPost };

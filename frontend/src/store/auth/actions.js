import axios from "axios";

import router from "../../router";
import { LOGIN_URL, REGISTER_URL } from "../../contants";

const login = async (context, payload) => {
  const email = payload.email;
  const password = payload.password;

  try {
    const response = await axios.post(LOGIN_URL, {
      email,
      password,
    });

    context.commit("SET_USER", response.data.user);
    context.commit("SET_TOKEN", response.data.token);
    router.push({ name: "home" });
  } catch (error) {
    console.error(error);
  }
};

const register = async (context, payload) => {
  const name = payload.name;
  const email = payload.email;
  const password = payload.password;
  const password_confirmation = payload.passwordConfirmation;

  try {
    const response = await axios.post(REGISTER_URL, {
      name,
      email,
      password,
      password_confirmation,
    });

    context.commit("SET_USER", response.data.user);
    context.commit("SET_TOKEN", response.data.token);
    router.push({ name: "home" });
  } catch (error) {
    console.error(error);
  }
};

const logout = (context) => {
  context.commit("REMOVE_USER", null);
  context.commit("REMOVE_TOKEN", null);
  router.push({ name: "home" });

  try {
    axios.post("http://127.0.0.1:8000/api/v1/auth/logout", {}, { headers: { Authorization: `Bearer ${JSON.parse(localStorage.getItem("token"))}` } });
  } catch (error) {
    console.error(error);
  }
};

export default { login, register, logout };

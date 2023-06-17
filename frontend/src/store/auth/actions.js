import axios from "axios";
import router from "../../router";

const login = async (context, payload) => {
  const email = payload.email;
  const password = payload.password;

  try {
    const response = await axios.post("http://127.0.0.1:8000/api/v1/auth/login", {
      email,
      password,
    });

    context.commit("setUser", response.data.user);
    context.commit("setToken", response.data.token);
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

  console.log(name, email, password, password_confirmation);

  try {
    const response = await axios.post("http://127.0.0.1:8000/api/v1/auth/register", {
      name,
      email,
      password,
      password_confirmation,
    });

    context.commit("setUser", response.data.user);
    context.commit("setToken", response.data.token);
    router.push({ name: "home" });
  } catch (error) {
    console.error(error);
  }
};

const logout = async (context) => {
  const token = JSON.parse(localStorage.getItem("token"));
  const authorizationToken = `Bearer ${token}`;

  router.push({ name: "home" });

  try {
    await axios.post("http://127.0.0.1:8000/api/v1/auth/logout", {}, { headers: { Authorization: `Bearer ${authorizationToken}` } });

    context.commit("removeUser", null);
    context.commit("removeToken", null);
  } catch (error) {
    console.error(error);
  }
};

export default { login, register, logout };

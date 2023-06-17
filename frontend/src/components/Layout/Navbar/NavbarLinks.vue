<template>
  <li class="nav-item d-flex align-items-center gap-2">
    <span class="material-symbols-outlined">home</span>
    <router-link class="nav-link p-0" :to="homeLink">Home</router-link>
  </li>

  <li class="nav-item d-flex align-items-center gap-2" v-if="!user">
    <span class="material-symbols-outlined">login</span>
    <router-link class="nav-link p-0" :to="loginLink">Login</router-link>
  </li>

  <li class="nav-item d-flex align-items-center gap-2" v-if="!user">
    <span class="material-symbols-outlined">edit</span>
    <router-link class="nav-link p-0" :to="registerLink">Register</router-link>
  </li>
</template>

<script>
export default {
  computed: {
    homeLink() {
      return { name: "home" };
    },
    loginLink() {
      return { name: "auth.login" };
    },
    registerLink() {
      return { name: "auth.register" };
    },
    user() {
      return this.$store.getters["auth/user"];
    },
  },
};
</script>

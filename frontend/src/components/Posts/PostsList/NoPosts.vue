<template>
  <div class="alert alert-primary">
    <span>There is nothing here to show. </span>
    <span v-if="isAuthenticated">Add a new post up there!</span>
    <span v-else>Login <router-link :to="loginLink">here</router-link> to add a new post.</span>
  </div>
</template>

<script>
export default {
  computed: {
    isAuthenticated() {
      return this.$store.getters["auth/isAuthenticated"];
    },
    loginLink() {
      return { name: "auth.login" };
    },
  },
};
</script>

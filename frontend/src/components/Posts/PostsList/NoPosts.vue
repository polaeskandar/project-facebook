<template>
  <div class="alert alert-primary">
    <span>There is nothing here to show. </span>
    <span v-if="!!user && !!user.email_verified_at">Add a new post up there!</span>
    <span v-else-if="!!!user">Login <router-link :to="loginLink">here</router-link> to add a new post.</span>
  </div>
</template>

<script>
export default {
  computed: {
    user() {
      return this.$store.getters["auth/getUser"];
    },
    loginLink() {
      return { name: "auth.login" };
    },
  },
};
</script>

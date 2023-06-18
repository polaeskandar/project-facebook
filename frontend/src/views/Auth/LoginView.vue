<template>
  <form @submit.prevent="login" class="auth-form bg-white p-5 rounded">
    <div class="form-outline mb-4">
      <label class="form-label d-flex align-items-center gap-2" for="email">
        <span class="material-symbols-outlined">mail</span>
        Email Address
      </label>
      <input type="email" v-model="email.value" name="email" id="email" class="form-control" />
    </div>

    <div class="form-outline mb-3">
      <label class="form-label d-flex align-items-center gap-2" for="password">
        <span class="material-symbols-outlined">password</span>
        Password
      </label>
      <input type="password" v-model="password.value" name="password" id="password" class="form-control" />
    </div>

    <div class="d-flex flex-column align-items-start mb-3">
      <router-link :to="forgotPasswordLink">Forgot password?</router-link>
      <router-link :to="registerLink">Don't have an account? Register one here!</router-link>
    </div>

    <BaseButton type="submit" :loading="isLoading">Login</BaseButton>
  </form>
</template>

<script>
export default {
  data() {
    return {
      email: { value: null },
      password: { value: null },
      isLoading: false,
    };
  },
  methods: {
    async login() {
      this.isLoading = true;
      await this.$store.dispatch("auth/login", {
        email: this.email.value,
        password: this.password.value,
      });
      this.isLoading = false;
    },
  },
  computed: {
    forgotPasswordLink() {
      return { name: "auth.forgotPassword" };
    },
    registerLink() {
      return { name: "auth.register" };
    },
  },
};
</script>

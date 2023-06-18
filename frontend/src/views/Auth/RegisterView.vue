<template>
  <form @submit.prevent="register" class="auth-form container bg-white p-5 rounded border mt-5">
    <div class="form-outline mb-4">
      <label class="form-label d-flex align-items-center gap-2" for="name">
        <span class="material-symbols-outlined">badge</span>
        Name
      </label>
      <input v-model="name.value" type="text" id="name" name="name" class="form-control" required />
    </div>

    <div class="form-outline mb-4">
      <label class="form-label d-flex align-items-center gap-2" for="email">
        <span class="material-symbols-outlined">mail</span>
        Email Address
      </label>
      <input v-model="email.value" type="email" id="email" name="email" class="form-control" required />
    </div>

    <div class="form-outline mb-4">
      <label class="form-label d-flex align-items-center gap-2" for="password">
        <span class="material-symbols-outlined">password</span>
        Password
      </label>
      <input v-model="password.value" type="password" id="password" name="password" class="form-control" required />
    </div>

    <div class="form-outline mb-4">
      <label class="form-label d-flex align-items-center gap-2" for="password_confirmation">
        <span class="material-symbols-outlined">password</span>
        Password Confirmation
      </label>
      <input v-model="passwordConfirmation.value" type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
    </div>

    <router-link :to="loginLink">Already have an account? Login here!</router-link>
    <BaseButton type="submit" class="btn btn-primary btn-block w-100 mt-3" :loading="isLoading">Register</BaseButton>
  </form>
</template>

<script>
export default {
  data() {
    return {
      name: { value: null },
      email: { value: null },
      password: { value: null },
      passwordConfirmation: { value: null },
      isLoading: false,
    };
  },
  computed: {
    loginLink() {
      return { name: "auth.login" };
    },
  },
  methods: {
    async register() {
      this.isLoading = true;
      await this.$store.dispatch("auth/register", {
        name: this.name.value,
        email: this.email.value,
        password: this.password.value,
        passwordConfirmation: this.passwordConfirmation.value,
      });
      this.isLoading = false;
    },
  },
};
</script>

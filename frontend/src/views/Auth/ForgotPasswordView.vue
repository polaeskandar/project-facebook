<template>
  <form class="auth-form bg-white p-5 rounded">
    <div class="form-outline mb-4">
      <label class="form-label d-flex align-items-center gap-2" for="email">
        <span class="material-symbols-outlined">mail</span>
        Email Address
      </label>
      <input type="email" name="email" id="email" class="form-control" />
    </div>
    <div class="mb-3"><router-link :to="registerLink">Don't have an account? Register one here!</router-link></div>
    <button type="submit" class="btn btn-primary btn-block w-100">Send Reset Link</button>
  </form>
</template>

<script>
export default {
  computed: {
    registerLink() {
      return { name: "auth.register" };
    },
  },
};
</script>

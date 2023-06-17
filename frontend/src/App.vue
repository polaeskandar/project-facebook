<template>
  <TheNavbar />
  <RouterView />
</template>

<script>
import TheNavbar from "./components/Layout/Navbar/TheNavbar.vue";

export default {
  components: { TheNavbar },
};
</script>

<style>
a {
  text-decoration: none;
}

.auth-form {
  width: 500px;
  margin: 60px auto;
  border: 1px solid #ccc;
}

html.dark .auth-form {
  background-color: var(--body-background-color) !important;
  color: white;
}

@media screen and (max-width: 991px) {
  .auth-form {
    padding: 0 2rem;
    width: 100%;
  }
}
</style>

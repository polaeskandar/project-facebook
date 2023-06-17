<template>
  <ul class="navbar-nav gap-2 mb-2 mb-lg-0" v-if="user">
    <li class="nav-item dropdown me-1">
      <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
        <span class="material-symbols-outlined">account_circle</span>{{ user.name }}
      </a>
      <ul class="dropdown-menu">
        <li>
          <a class="dropdown-item d-flex align-items-center gap-2" href="#"><span class="material-symbols-outlined">account_box</span>My Profile</a>
        </li>
        <li><hr class="dropdown-divider" /></li>
        <li>
          <a @click.prevent="logout" class="dropdown-item d-flex align-items-center gap-2" href="#"><span class="material-symbols-outlined">logout</span>Logout</a>
        </li>
      </ul>
    </li>
  </ul>
</template>

<script>
export default {
  methods: {
    logout() {
      this.$store.dispatch("auth/logout");
    },
  },
  computed: {
    homeLink() {
      return { name: "home" };
    },
    user() {
      return this.$store.getters["auth/user"];
    },
  },
};
</script>

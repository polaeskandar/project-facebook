<template>
  <nav class="navbar navbar-expand-lg bg-white p-3">
    <div class="container-fluid">
      <router-link class="navbar-brand" :to="homeLink">FaceBook</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLinks">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse gap-2" id="navbarLinks">
        <NavbarLinks />
        <NavbarDropdown v-if="getIsAuthenticated" />

        <div class="form-check form-switch me-4 ms-auto">
          <input class="form-check-input" type="checkbox" role="switch" id="dark-mode-switch" />
          <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
        </div>

        <form class="d-flex search-form" role="search">
          <input class="form-control me-2 w-100" type="search" placeholder="Search something..." />
          <button class="btn btn-outline-success d-flex align-items-center gap-2" type="submit">Search<span class="material-symbols-outlined">search</span></button>
        </form>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";

import NavbarLinks from "./NavbarLinks.vue";
import NavbarDropdown from "./NavbarDropdown.vue";

export default {
  components: { NavbarLinks, NavbarDropdown },
  computed: {
    ...mapGetters("auth", ["getIsAuthenticated"]),
    homeLink() {
      return { name: "home" };
    },
  },
};
</script>

<template>
  <div class="posts-container">
    <NewPost v-if="canCreatePosts" />
    <PostsList />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import NewPost from "./NewPost/NewPost.vue";
import PostsList from "./PostsList/PostsList.vue";

export default {
  components: { NewPost, PostsList },
  computed: {
    // ...mapGetters("auth", ["getUser"]),
    canCreatePosts() {
      const user = this.$store.getters["auth/getUser"];
      return user && user.email_verified_at;
    },
  },
};
</script>

<style scoped>
.posts-container {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
</style>

<template>
  <div class="posts-list">
    <BaseSpinner v-if="isLoading" />
    <BasePost v-for="post in getPosts" :key="post" :post="post" />
    <NoPosts v-if="!isLoading && getPosts.length === 0" />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import BasePost from "./BasePost.vue";
import NoPosts from "./NoPosts.vue";

export default {
  components: { BasePost, NoPosts },
  computed: {
    ...mapGetters("posts", ["getPosts"]),
    isLoading() {
      return this.$store.getters["posts/getLoadingState"];
    },
  },
  methods: {
    ...mapActions("posts", ["fetchPosts"]),
  },
  created() {
    this.fetchPosts();
  },
};
</script>

<style scoped>
.posts-list {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
</style>

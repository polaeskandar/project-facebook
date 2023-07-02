<template>
  <div class="p-4">
    <BasePost :post="post" />
  </div>
</template>

<script>
import BasePost from "../../components/Posts/PostsList/BasePost.vue";

export default {
  components: { BasePost },
  computed: {
    post() {
      if (this.$store.getters["posts/getPosts"].length > 0) return this.$store.getters["posts/getPosts"].filter((post) => post.id === this.$route.params.id);
      else return { id: "none", body: "This post is not found! might be deleted or something..." };
    },
  },
};
</script>

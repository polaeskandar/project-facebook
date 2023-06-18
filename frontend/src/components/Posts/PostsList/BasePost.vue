<template>
  <div class="post card" :id="postId">
    <div class="card-body" v-html="post.body" />
  </div>
</template>

<script>
export default {
  props: ["post"],
  computed: {
    postId() {
      return `post-${this.post.id}`;
    },
  },
};
</script>

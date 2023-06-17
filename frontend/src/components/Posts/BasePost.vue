<template>
  <div class="post card" :id="postId">
    <div class="card-body">Hello</div>
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

<template>
  <div class="posts-container" id="posts-container">
    <BasePost v-for="post in posts" :key="post" :post="post" />
  </div>
</template>

<script>
import BasePost from "./BasePost.vue";

export default {
  components: { BasePost },
};
</script>

<style scoped>
.posts-container {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
</style>

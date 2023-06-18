<template>
  <main>
    <div class="bg-white">Shortcuts</div>
    <PostsContainer />
    <div class="bg-white">Friends</div>
  </main>
</template>

<script>
import PostsContainer from "../components/Posts/PostsContainer.vue";

export default {
  components: { PostsContainer },
};
</script>

<style scoped>
main {
  display: grid;
  grid-template-columns: 1fr 3fr 1fr;
  padding: 10px;
  gap: 10px;
}
</style>

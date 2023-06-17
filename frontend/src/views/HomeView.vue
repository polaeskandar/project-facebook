<template>
  <main>
    <div>Short cut</div>
    <PostsList />
    <div>Friends</div>
  </main>
</template>

<script>
import PostsList from "../components/Posts/PostsList.vue";

export default {
  components: { PostsList },
};
</script>

<style scoped>
main {
  display: grid;
  grid-template-columns: 1fr 3fr 1fr;
}
</style>

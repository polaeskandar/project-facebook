<template>
  <div class="post card" :id="post.id">
    <div class="card-body" v-html="post.body" />
  </div>
</template>

<script>
export default {
  props: ["post"],
};
</script>

<template>
  <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2 w-100" :type="type" :disabled="loading">
    <div class="spinner-border spinner-border-sm" role="status" v-if="loading">
      <span class="visually-hidden">Loading...</span>
    </div>
    <slot default></slot>
  </button>
</template>

<script>
export default {
  props: {
    type: { type: String, required: false, default: "button" },
    loading: { type: Boolean, required: false, default: false },
  },
};
</script>

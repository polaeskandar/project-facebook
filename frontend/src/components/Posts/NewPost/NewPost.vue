<template>
  <div class="card new-post">
    <div class="card-body">
      <h5 class="card-title mb-3">What's on your mind?</h5>
      <form @submit.prevent="createPost">
        <BaseSpinner v-if="editorLoading"></BaseSpinner>
        <Editor api-key="d9q5szmgrv1vpphsd2fvkcmy6h774duu5o7yh0j0yits6jhf" v-model="body" @vnode-before-mount="removeLoadingSpinner" :init="editorOptions" />

        <div class="d-flex align-items-center gap-2 mt-3">
          <!-- <button type="submit" id="create-post-form-submit" class="btn btn-primary mt-3 w-75 d-flex align-items-center justify-content-center gap-2">
            <span id="create-post-form-submit-spinner" class="spinner-border me-2 d-none"><span class="visually-hidden">Loading...</span></span>
            <span id="create-post-form-submit-icon" class="material-symbols-outlined">edit_square</span>Create Post
          </button> -->
          <BaseButton type="submit" :loading="loading"><span id="create-post-form-submit-icon" class="material-symbols-outlined">edit_square</span>Create Post</BaseButton>
          <BaseButton @click.prevent="showSchedule"><span id="create-post-form-submit-schedule-icon" class="material-symbols-outlined">schedule</span>Schedule Post</BaseButton>
          <!-- <button type="button" @click.prevent="showSchedule" class="btn btn-primary mt-3 w-25 d-flex align-items-center justify-content-center gap-2">
            <span id="create-post-form-submit-schedule-icon" class="material-symbols-outlined">schedule</span>Schedule Post
          </button> -->
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3 gap-2" v-if="visibleSchedule">
          <input class="form-control" type="datetime-local" v-model="selectedDate" :min="minDate" :max="maxDate" />
          <button type="button" class="btn-close" @click.prevent="hideSchedule"></button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Editor from "@tinymce/tinymce-vue";

export default {
  components: { Editor },
  data() {
    return {
      body: null,
      editorOptions: {
        selector: "#post-editor",
        plugins: ["link", "anchor", "wordcount", "code", "insertdatetime", "table", "image"],
        toolbar: "undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

        // file_picker_callback: filePickerHandler,
        // skin: localStorage.getItem('darkMode') === 'on' ? 'oxide-dark' : 'snow',
        // content_css: localStorage.getItem('darkMode') === 'on' ? 'dark' : 'default',
      },
      visibleSchedule: false,
      editorLoading: true,
      minDate: null,
      maxDate: null,
      selectedDate: null,
      loading: false,
    };
  },
  methods: {
    async createPost() {
      this.loading = true;
      await this.$store.dispatch("posts/createPost", {
        body: this.body,
        scheduleOn: this.selectedDate,
      });
      this.loading = false;
    },
    showSchedule() {
      this.visibleSchedule = true;
    },
    hideSchedule() {
      this.visibleSchedule = false;
      this.selectedDate = null;
    },
    removeLoadingSpinner() {
      this.editorLoading = false;
    },
  },
  mounted() {
    const today = new Date().toISOString().slice(0, 16);
    const nextYear = new Date();
    nextYear.setFullYear(nextYear.getFullYear() + 1);
    const nextYearDate = nextYear.toISOString().slice(0, 16);

    this.minDate = today;
    this.maxDate = nextYearDate;
  },
};
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
}
</style>

<template>
  <button
    type="button"
    class="btn btn-outline-secondary ms-2"
    @click="callback(item)"
  >
    <i class="bi bi-eye-fill" />
  </button>
</template>

<script>

export default {
  name: "ViewButton",
  props: {
      item: {
          type: Object,
          required: true
      },
      callback: {
          type: Function,
          required: true
      }
  },
}
</script>

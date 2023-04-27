<template>
  <button
    type="button"
    class="btn btn-outline-secondary ms-2"
    @click="goToView"
  >
    <i class="bi bi-eye-fill" />
  </button>
</template>

<script>
import ListMixin from "../../../mixin/ListMixin";

export default {
  name: "ViewButton",
  mixins: [ListMixin],
  props: {
      item: {
          type: Object,
          required: true
      },
      resourceType: {
          type: String,
          required: true
      }
  },
  methods: {
    goToView() {
      this.$router.push({name: this.getViewRoute, params: { id: this.item.id }})
    }
  }
}
</script>

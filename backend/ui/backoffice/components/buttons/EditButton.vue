<template>
  <button
    type="button"
    class="btn btn-outline-secondary"
    @click="goToEdit"
  >
    <i class="bi bi-pencil" />
  </button>
</template>

<script>
import ListMixin from "../../../mixin/ListMixin";

export default {
  name: "EditButton",
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
    goToEdit() {
      this.$router.push({name: this.getEditRoute, params: { id: this.item.id }})
    }
  }
}
</script>

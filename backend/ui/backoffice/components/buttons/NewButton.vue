<template>
  <button
    type="button"
    class="btn btn-primary"
    @click="goToNew"
  >
    New {{ resourceType }}
  </button>
</template>

<script>
import ListMixin from "../../../mixin/ListMixin";
import {useNavigationStore} from "../../../store/navigation";

const navigationStore = useNavigationStore()

export default {
  name: "NewButton",
  mixins: [ListMixin],
  computed: {
      resourceType() {
          return navigationStore.getResourceType
      }
  },
  methods: {
    goToNew() {
      this.$router.push({name: this.getNewRoute})
    }
  },
}
</script>

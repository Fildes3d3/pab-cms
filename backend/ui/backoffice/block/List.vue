<template>
  <List
    :resource-type="$options.RESOURCE_BLOCK"
  />
</template>

<script>
import List from "@bo/components/List/List.vue";
import {RESOURCE_BLOCK} from "../../constants";
import {useNavigationStore} from "../../store/navigation";

const navigationStore = useNavigationStore()

export default {
  name: "ListBlock",
  RESOURCE_BLOCK,
  components: {
    List
  },
  created() {
    navigationStore.setResourceType(RESOURCE_BLOCK)
  }
};
</script>

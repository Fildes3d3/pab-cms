<template>
  <List
    :resource-type="$options.RESOURCE_NAVIGATION_ITEMS"
  />
</template>

<script>
import List from "@bo/components/List/List.vue";
import {RESOURCE_NAVIGATION_ITEM} from "../../constants";
import {useNavigationStore} from "../../store/navigation";

const navigationStore = useNavigationStore()

export default {
  name: "ListNavigationItems",
  RESOURCE_NAVIGATION_ITEMS: RESOURCE_NAVIGATION_ITEM,
  components: {
    List
  },
  created() {
    navigationStore.setResourceType(RESOURCE_NAVIGATION_ITEM)
  }
};
</script>

<template>
  <List
    :resource-type="$options.RESOURCE_PAGE"
  />
</template>

<script>
import List from "@bo/components/List/List.vue";
import {RESOURCE_PAGE} from "../../constants";
import {useNavigationStore} from "../../store/navigation";

const navigationStore = useNavigationStore()

export default {
  name: "ListPage",
  RESOURCE_PAGE,
  components: {
    List
  },
  created() {
    navigationStore.setResourceType(RESOURCE_PAGE)
  }
};
</script>

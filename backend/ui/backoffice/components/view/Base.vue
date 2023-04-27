<template>
  <h1>view {{ resourceType }}</h1>
</template>

<script>
import {useNavigationStore} from "../../../store/navigation";

const navigationStore = useNavigationStore()
export default {
  name: "ViewPage",
  components: {
  },
  extends: '',
  mixins: [
  ],
  props: {
  },
  data() {
    return {
    };
  },
  computed: {
      resourceType() {
          return navigationStore.getResourceType
      }
  },
  watch: {
  },
  created() {
  },
  mounted() {
  },
  beforeUnmount() {
  },
  methods: {
  }
};
</script>

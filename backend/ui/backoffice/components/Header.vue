<template>
  <header class="mb-auto">
    <TopHeader />
    <Navigation />
  </header>
</template>

<script>
import TopHeader from "@bo/components/TopHeader.vue";
import Navigation from "@bo/components/Navigation.vue";

export default {
  name: "HeaderTemplate",
  components: {
    TopHeader,
    Navigation
  },
}
</script>

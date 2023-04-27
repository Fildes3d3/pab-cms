<template>
  <app-header />
  <app-main />
  <app-footer />
</template>

<script>
import appHeader from "./Header.vue";
import appMain from "./Main.vue";
import appFooter from "./Footer.vue";

export default {
  name: "App",
  components: {
    appHeader, appFooter, appMain
  },
}
</script>

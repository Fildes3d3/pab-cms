<template>
  <app-header />
  <app-main />
  <app-footer />
</template>

<script>
import appHeader from "@bo/components/Header.vue"
import appMain from "@bo/components/MainTemplate.vue";
import appFooter from "@bo/components/Footer.vue";

export default {
  name: "App",
  components: {
    appHeader, appFooter, appMain
  },
}
</script>

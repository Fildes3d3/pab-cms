<template>
    <body data-aos-easing="ease-in-out" data-aos-duration="1000" data-aos-delay="0">
        <div>
            <NavigationTemplate></NavigationTemplate>
            <slot />
        </div>
    </body>
</template>
<script setup lang="ts">
    import NavigationTemplate from "~/components/layout/NavbarTemplate.vue";
</script>

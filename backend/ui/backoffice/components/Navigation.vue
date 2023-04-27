<template>
  <div class="px-3 py-2 text-bg-light">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
          <li>
            <router-link
              :to="{ name: 'pageList' }"
              class="nav-link text-black"
            >
              Pages
            </router-link>
            <router-link
              :to="{ name: 'blockList' }"
              class="nav-link text-black"
            >
              Blocks
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NavigationTemplate",
}
</script>

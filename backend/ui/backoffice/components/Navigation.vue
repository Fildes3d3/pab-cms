<template>
  <div class="px-3 py-2 text-bg-light">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
          <li class="nav-item underline-nav-item">
            <router-link
              :to="{ name: 'pageList' }"
              class="nav-link underline-nav-link text-black"
            >
              Pages
            </router-link>
          </li>
          <li class="nav-item underline-nav-item">
            <router-link
              :to="{ name: 'blockList' }"
              class="nav-link underline-nav-link text-black"
            >
              Blocks
            </router-link>
          </li>
          <li class="nav-item underline-nav-item">
            <router-link
              :to="{ name: 'navigationItemList' }"
              class="nav-link underline-nav-link text-black"
            >
              Navigation Items
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

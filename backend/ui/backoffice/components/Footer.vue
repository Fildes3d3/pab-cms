<template>
  <footer class="mb-auto">
    <div class="px-3 py-2 text-bg-dark">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <router-link
            :to="{ name: 'home' }"
            class="router-link-active router-link-exact-active d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none"
          >
            Back to top
          </router-link>
          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <p class="mx-auto">
                &copy; 2023
              </p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "FooterTemplate",
}
</script>

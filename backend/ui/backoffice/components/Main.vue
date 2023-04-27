<template>
  <main class="mb-auto">
    <div class="px-3 py-2">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center">
          <router-view id="admin-content" />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: "MainTemplate"
}
</script>

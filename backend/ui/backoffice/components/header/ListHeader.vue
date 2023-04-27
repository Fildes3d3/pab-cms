<template>
  <div class="card-header">
    <div class="row">
      <label
        for="inputFilter"
        class="col-1 col-form-label"
      >Filter</label>
      <div class="col-3">
        <input
          id="inputFilter"
          type="text"
          class="form-control"
        >
      </div>
      <label
        for="inputSort"
        class="col-1 col-form-label"
      >SortBy</label>
      <div class="col-3">
        <select
          id="inputSort"
          class="form-select"
        >
          <option value="1">
            One
          </option>
          <option value="2">
            Two
          </option>
          <option value="3">
            Three
          </option>
        </select>
      </div>
      <label
        for="inputView"
        class="col-1 col-form-label"
      >View</label>
      <div class="col-3">
        <select
          id="inputView"
          class="form-select"
        >
          <option value="1">
            One
          </option>
          <option value="2">
            Two
          </option>
          <option value="3">
            Three
          </option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ListHeader",
}
</script>

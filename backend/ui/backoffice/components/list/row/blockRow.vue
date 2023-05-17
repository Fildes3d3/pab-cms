<template>
  <div class="row">
    <div class="col-4 text-center">
      <span>{{ item.type }}</span>
    </div>
    <div class="col-4 text-center">
      <span>{{ $filters.niceDate(item.createdAt) }}</span>
    </div>
    <div class="col-4 text-center">
      <EditButton
        :item="item"
        :resource-type="resourceType"
      />
      <ViewButton
        :item="item"
        :callback="preview"
      />
    </div>
    <div class="col-12 text-center">
      <hr>
    </div>
  </div>
</template>

<script>
import {defineAsyncComponent} from "vue";
import BlockService from "../../../../services/BlockService";

const EditButton = defineAsyncComponent(() => import('../../buttons/EditButton.vue'))
const ViewButton = defineAsyncComponent(() => import('../../buttons/ViewButton.vue'))
export default {
  name: "BlockRow",
  components: {ViewButton, EditButton},
  props: {
    item: {
      type: Object,
      required: true
    },
    resourceType: {
        type: String,
        required: true
    }
  },
  methods: {
      preview(item) {
          BlockService.preview(item).then( response => {
              if (response.status === 200) {
                  window.open(`preview/block/${item.id}`, "_blank")
              }
          })
      }
  }
}
</script>

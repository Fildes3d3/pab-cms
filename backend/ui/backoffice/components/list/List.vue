<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <component
          :is="listHeaderComponent"
          :resource-type="resourceType"
        />
        <div class="card-body">
          <div
            v-for="(item, index) in items"
            :key="index"
          >
            <component
              :is="rowComponent"
              :item="item"
              :resource-type="resourceType"
            />
          </div>

          <NewButton />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {getAllResources} from "../../../helper";
import {useListStore} from "../../../store/list";
import { defineAsyncComponent } from 'vue'

const ListHeader = defineAsyncComponent(() => import('../header/ListHeader.vue'))
const NewButton = defineAsyncComponent(() => import('../buttons/NewButton.vue'))

const allResources = getAllResources();

let components = {
    ListHeader,
    NewButton
}

for (const resource of allResources) {
    components[resource + "Row"] = defineAsyncComponent(() => import("./row/" + resource + "Row"))
}

const listStore = useListStore()

export default {
  name: "ListTemplate",
  components,
  props: {
    resourceType: {
      type: String,
      required: true
    }
  },
  computed: {
    listHeaderComponent() {
      switch (this.resourceType)  {
        default: { return "ListHeader"}
      }
    },
    rowComponent() {
      return this.resourceType + "Row"
    },
    items() {
        return listStore.getItems
    }
  },
  mounted() {
    listStore.setItems(this.resourceType)
  },
}
</script>

import { defineStore } from 'pinia'
import BlockService from "../services/BlockService";

export const useBlockStore = defineStore(
  'block',
  {
    state: () => ({
      item: []
    }),
    getters: {
      getItem: (state) => state.item
    },
    actions: {
      async setItem (id) {
          BlockService.getBlock(id).then(
          response => {
            this.item = response.data
          }
        ).catch(
          error => {
            console.log(error)
          }
        )
      }
    }
  })

import { defineStore } from 'pinia'
import DefaultRestService from '../services/DefaultRestService'

export const useListStore = defineStore(
  'list',
  {
    state: () => ({
      items: []
    }),
    getters: {
      getItems: (state) => state.items
    },
    actions: {
      async setItems (uri) {
        DefaultRestService.getItems(uri).then(
          response => {
            this.items = response.data
          }
        ).catch(
          error => {
            console.log(error)
          }
        )
      }
    }
  })

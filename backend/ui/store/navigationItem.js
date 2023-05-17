import { defineStore } from 'pinia'
import NavigationItemService from "../services/NavigationItemService";

export const useNavigationItemStore = defineStore(
  'navigationItem',
  {
    state: () => ({
      item: []
    }),
    getters: {
      getItem: (state) => state.item
    },
    actions: {
      async setItem (id) {
          NavigationItemService.getNavigationItem(id).then(
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

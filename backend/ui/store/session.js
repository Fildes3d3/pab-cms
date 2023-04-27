import { defineStore } from 'pinia'

export const useSessionStore = defineStore(
  'session',
  {
    state: () => ({
      authToken: null
    }),
    getters: {
      getAuthToken: (state) => state.authToken
    },
    actions: {
      setAuthToken (token) {
        this.authToken = token
      }
    }
  })

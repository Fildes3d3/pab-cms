import { defineStore } from 'pinia'
import AuthorizationService from '../services/AuthorizationService'

export const useUserStore = defineStore(
  'user',
  {
    state: () => ({
      user: null,
      loggedUserId: null
    }),
    getters: {
      getLoggedUser: (state) => state.user,
      getLoggedUserId: (state) => state.loggedUserId
    },
    actions: {
      setLoggedUser (user) {
        this.user = user
      },
      setLoggedUserId (loggedUserId) {
        this.loggedUserId = loggedUserId
      },
      async fetchLoggedUserData () {
        AuthorizationService.getMe(this.loggedUserId)
      }
    }
  })

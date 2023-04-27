import axios from 'axios'
import localStorageService from "./LocalStorageService";

export default {
  login(email, password) {
    return axios.post(
      'api/v1/sessions/',
      {
        email,
        password
      }
    )
  },

  logout() {
    localStorageService.clearAuthToken()

    return axios.delete(
      'api/v1/sessions/'
    )
  },

  getMe() {
    return axios.get('api/v1/sessions/me')
  }
}

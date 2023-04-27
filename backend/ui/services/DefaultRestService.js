import axios from 'axios'

export default {
  async getItems (uri) {
    return axios.get('api/v1/' + uri + '/')
  }
}

import axios from 'axios'

export default {
  preview (data) {
    return axios.post('api/v1/block/preview', data)
  }
}

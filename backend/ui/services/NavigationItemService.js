import axios from 'axios'

export default {
  getNavigationItem (id) {
    return axios.get('api/v1/navigation/item/' + id)
  },
  createNavigationItem (data) {
    return axios.post('api/v1/navigation/item/', data)
  },
  editNavigationItem (id, data) {
    return axios.put('api/v1/navigation/item/' + id, data)
  },
  deleteNavigationItem (id) {
    return axios.delete('api/v1/navigation/item/' + id)
  }
}

import DefaultRestService from './DefaultRestService'
import axios from 'axios'

export default {
  getItems () {
    return DefaultRestService.getItems('pages')
  },
  getPage (id) {
    return axios.get('api/v1/pages/' + id)
  },
  createPage (data) {
    return axios.post('api/v1/pages/', data)
  },
  editPage (id, data) {
    return axios.put('api/v1/pages/' + id, data)
  },
  deletePage (id) {
    return axios.delete('api/v1/pages/' + id)
  }
}

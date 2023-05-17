import listToNewRouteMapper from '../mapper/listToNewRouteMapper'
import listToEditRouteMapper from "../mapper/listToEditRouteMapper";

export default {
  computed: {
    getNewRoute () {
      if (!listToNewRouteMapper.has(this.resourceType)) {
        throw new ReferenceError('Unknown resource type:' + this.resourceType)
      }

      return listToNewRouteMapper.get(this.resourceType)
    },
    getEditRoute () {
      if (!listToEditRouteMapper.has(this.resourceType)) {
        throw new ReferenceError('Unknown resource type:' + this.resourceType)
      }

      return listToEditRouteMapper.get(this.resourceType)
    },
  }
}

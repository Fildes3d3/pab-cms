import { defineStore } from 'pinia'

export const useNavigationStore = defineStore(
  'navigation',
  {
    state: () => ({
      breadcrumbs: [],
      resourceType: null
    }),
    getters: {
      getBreadcrumbs: (state) => state.breadcrumbs,
      getResourceType: (state) => state.resourceType
    },
    actions: {
      setBreadcrumbs (path, routeName, params) {
        if (routeName === 'home') {
          this.breadcrumbs = []
        }

        let pathIndex = null
        const pathExists = this.breadcrumbs.find(breadcrumb => breadcrumb.path === path)

        if (pathExists) {
          pathIndex = this.breadcrumbs.indexOf(pathExists)
          this.breadcrumbs.splice(pathIndex + 1, this.breadcrumbs.length - 1)
        }

        if (!pathExists) {
          this.breadcrumbs.push(
            {
              routeName,
              path,
              params
            }
          )
        }
      },
      setResourceType (resourceType) {
        this.resourceType = resourceType
      }
    },
    persist: true
  })

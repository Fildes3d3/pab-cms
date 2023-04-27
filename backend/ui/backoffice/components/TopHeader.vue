<template>
  <div class="px-3 py-2 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <div class="d-flex align-items-center my-2 my-lg-0 me-lg-auto">
          <router-link
            :to="{ name: 'home' }"
            class="text-white text-decoration-none"
          >
            <img
              :src="$options.logoImage"
              class="header-logo-image"
              alt="logo_image"
            >
          </router-link>
          <ul class="nav col-12 col-lg-auto mx-2 my-2 justify-content-center my-md-0 text-small">
            <li
              v-for="(breadcrumb, index) in breadcrumbs"
              :key="index"
            >
              <router-link
                :to="{ name: breadcrumb.routeName, params: { id: breadcrumb.params.id} }"
                class="nav-link text-white breadcrumb-link"
              >
                <p
                  v-if="index > 0"
                  class="mx-1"
                >
                  /
                </p>
                <p
                  v-if="index > 0 && breadcrumbs.length > 1"
                  class="mx-1"
                  :class="{'breadcrumb-link-last': index === breadcrumbs.length - 1}"
                >
                  {{ resourceType }}
                </p>
                <p
                  :class="{'breadcrumb-link-last': index === breadcrumbs.length - 1}"
                >
                  {{ breadcrumb.path }}
                </p>
              </router-link>
            </li>
          </ul>
        </div>
        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
          <li class="nav-link text-white header-link">
            <i
              v-if="!logoutButtonVisible"
              class="bi bi-person mx-auto header-icon"
            />
            <p
              v-if="loggedUser"
              class="user-link"
              @click="showLogoutButton()"
            >
              Hi, {{ loggedUser.firstName }} {{ loggedUser.lastName }}
              <i class="bi bi-chevron-down" />
            </p>
            <button
              v-if="logoutButtonVisible"
              class="btn btn-light mt-2 mx-auto"
              @click="logout"
            >
              Log out
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import {HEADER_LOGO} from "../../constants";
import {useUserStore} from "../../store/user";
import {useNavigationStore} from "../../store/navigation";
import AuthorizationService from "../../services/AuthorizationService";

const userStore = useUserStore()
const navigationStore = useNavigationStore()

export default {
  name: "TopHeader",
  logoImage: HEADER_LOGO,
  data () {
    return {
      logoutButtonVisible: false,
    }
  },
  computed: {
    loggedUser() {
      return userStore.getLoggedUser
    },
    breadcrumbs() {
      return navigationStore.getBreadcrumbs
    },
    resourceType() {
      let resourceType = navigationStore.getResourceType

      if (resourceType) {
        return this.$filters.capitalize(resourceType)
      }

      return resourceType
    }
  },
  methods: {
    showLogoutButton() {
      this.logoutButtonVisible = !this.logoutButtonVisible
    },
    async logout() {
      AuthorizationService.logout()
      this.$router.push({name: 'login'})
    }
  }
}
</script>

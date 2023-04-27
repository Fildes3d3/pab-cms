<template>
  <Form
    class="login"
    @submit="onSubmit"
  >
    <div class="card text-center">
      <div class="card-header text-bg-dark">
        <img
          :src="$options.logoImage"
          class="header-logo-image"
          alt="pab logo image"
        >
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-10 offset-1">
            <label
              for="email"
              class="form-label"
            >Username</label>
            <Field
              id="email"
              v-model="email"
              name="email"
              type="email"
              class="form-control text-center"
              rules="required"
            />
            <ErrorMessage
              name="email"
              class="text-danger"
            />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-10 offset-1">
            <label
              for="password"
              class="form-label"
            >Password</label>
            <div class="input-group">
              <Field
                id="password"
                v-model="password"
                name="password"
                :type="passInputType"
                class="form-control text-center"
                aria-describedby="button-addon"
                rules="required"
              />
              <i
                id="button-addon"
                aria-hidden="true"
                class="form-control-addon"
                :class="{'bi bi-eye-slash': passVisible, 'bi bi-eye': !passVisible}"
                @click="togglePasVisibility()"
              />
            </div>
            <ErrorMessage
              name="password"
              class="text-danger"
            />
          </div>
        </div>
        <button
          class="btn btn-dark mt-3"
          type="submit"
          value="Submit"
        >
          Log in
        </button>
      </div>
    </div>
  </Form>
</template>

<script>
import {HEADER_LOGO} from "../../constants";
import AuthorizationService from "../../services/AuthorizationService";
import LocalStorageService from "../../services/LocalStorageService";
import NotificationMixin from "../../mixin/NotificationMixin";
import { useUserStore } from "../../store/user";

const userStore = useUserStore();

export default {
  name: "LogIn",
  logoImage: HEADER_LOGO,
  mixins: [NotificationMixin],
  data() {
    return {
      email: null,
      password: null,
      htmlEl: null,
      passInputType: "password",
      passVisible: false,
      formMeta: null
    };
  },
  mounted() {
    this.htmlEl = document.getElementsByTagName("html")[0];
    this.htmlEl.onkeydown = event => this.submitOnEnter(event);
  },
  methods: {
    submitOnEnter(event) {
      if (event.keyCode === 13) {
        this.onSubmit(event);
      }
    },
    togglePasVisibility() {
      if (this.passInputType === "password") {
        this.passInputType = "text";
        this.passVisible = true;
      } else {
        this.passInputType = "password";
        this.passVisible = false;
      }
    },
    async onSubmit() {
      AuthorizationService.login(this.email, this.password).then(
          response => {
            LocalStorageService.setAuthToken(response.data.session, 300000)
            userStore.setLoggedUserId(response.data.user)

            this.$router.push({name: 'home'})
          }
      ).catch(
          error => {
            this.simpleError(error.response.data.error)
          }
      )
    }
  }
}
</script>

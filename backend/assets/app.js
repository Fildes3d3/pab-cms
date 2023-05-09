import './styles/app.scss';
import './bootstrap';
import { createApp } from "vue";
import { createPinia } from 'pinia'
import piniaPluginPersistedState from "pinia-plugin-persistedstate"
import Layout from "../ui/backoffice/components/Layout.vue";
import router from "../ui/router";
import { Form, Field, ErrorMessage, defineRule, configure } from "vee-validate";
import Dialog from 'vue3-dialog';
import axios from "axios";
import LocalStorageService from "../ui/services/LocalStorageService";
import filters from "../ui/filters";

axios.interceptors.request.use( (config) => {
    const token = LocalStorageService.getAuthToken()

    if (token) {
        config.headers.set('X-Auth', token)
    }

    return config
})

const pinia = createPinia()
pinia.use(piniaPluginPersistedState)

configure({
    validateOnBlur: true, // controls if `blur` events should trigger validation with `handleChange` handler
    validateOnChange: true, // controls if `change` events should trigger validation with `handleChange` handler
    validateOnInput: false, // controls if `input` events should trigger validation with `handleChange` handler
    validateOnModelUpdate: true, // controls if `update:modelValue` events should trigger validation with `handleChange` handler
});

defineRule('required', value => {
    if (!value || !value.length) {
        return 'This field is required';
    }
    return true;
});

defineRule('email', value => {
    // Field is empty, should pass
    if (!value || !value.length) {
        return true;
    }
    // Check if email
    if (!/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/.test(value)) {
        return 'This field must be a valid email';
    }

    return true;
});

const app = createApp(
    {
        components: { Layout },
        template: "<Layout />"
    }
)
    .use(pinia)
    .use(router)
    .use(Dialog, {})
    .component('Form', Form)
    .component('Field', Field)
    .component('ErrorMessage', ErrorMessage)

app.config.globalProperties.$filters = filters

app.mount('#app')


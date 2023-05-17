export default defineNuxtConfig({
    runtimeConfig: {
        public: {
            apiBase: 'http://pab.local/api/v1'
        }
    },
    css: ["@/assets/styles/main.scss"],
    plugins: [{ src: "@/plugins/aos", ssr: false, mode: "client" }],
    vite: {
        css: {
            preprocessorOptions: {
                css: {
                    additionalData: '@import "@/assets/styles/main.scss"'
                }
            }
        }
    }
})

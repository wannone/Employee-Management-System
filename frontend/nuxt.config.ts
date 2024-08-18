import Aura from "@primevue/themes/aura";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  modules: ["@primevue/nuxt-module"],
  compatibilityDate: "2024-04-03",
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],
  app: {
    head: {
      charset: "utf-8",
      viewport: "width=device-width, initial-scale=1",
      title: "EMS",
    },
  },
  runtimeConfig: {
    public: {
      appBase: "http://127.0.0.1:8000",
      apiBase: "http://127.0.0.1:8000/api",
    },
  },
  primevue: {
    options: {
      ripple: true,
      inputVariant: "filled",
      theme: {
        preset: Aura,
        options: {
          prefix: "p",
          darkModeSelector: "light-theme",
          cssLayer: true,
        },
      },
    },
  },
});

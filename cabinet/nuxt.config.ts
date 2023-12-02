import eslintPlugin from "vite-plugin-eslint";
const PORT = Number(process.env.APP_PORT) || 3000;

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: false },
  srcDir: "src",
  devServer: {
    port: PORT
  },
  imports: {
    dirs: [
      // ... or scan modules nested one level deep with a specific name and file extension
      "composables/*/index.{ts,js,mjs,mts}"
    ]
  },
  typescript: {
    shim: false
  },
  // Add nitro plugins
  nitro: {
    plugins: ["~/nitro.html.ts"]
  },
  modules: [
    [
      "@pinia/nuxt",
      {
        autoImports: [
          // import { defineStore as definePiniaStore } from 'pinia'
          ["defineStore", "definePiniaStore"]
        ]
      }
    ],
    "@nuxtjs/device",
    "@vueuse/nuxt",
    "radix-vue/nuxt"
  ],

  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE,
      devToken: process.env.NUXT_PUBLIC_DEV_TOKEN
    }
  },

  // vueuse
  vueuse: {
    ssrHandlers: true
  },

  app: {
    head: {
      htmlAttrs: {
        lang: "ru"
      },

      title: "Кабинет Seenday",

      meta: [
        { charset: "utf-8" },
        { name: "viewport", content: "width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" },
        { hid: "description", name: "description", content: "" },
        { hid: "keywords", name: "keywords", content: "" },
        { name: "yandex-verification", content: "02181fad083eb12a" }
      ],

      link: [
        { rel: "icon", type: "image/x-icon", href: "/lk/favicon.ico" },
        { rel: "stylesheet", href: "/lk/fonts/open-sans-regular/stylesheet.css" },
        { rel: "stylesheet", href: "/lk/fonts/open-sans-semibold/stylesheet.css" },
        { rel: "stylesheet", href: "/lk/fonts/pt-sans-regular/stylesheet.css" },
        { rel: "stylesheet", href: "/lk/fonts/fontawesome/stylesheet.css" }
      ]
    },
    baseURL: "/lk/",
    cdnURL: "/lk/"
  },

  css: ["~/assets/styles/main.scss"],

  vite: {
    plugins: [eslintPlugin()],
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: '@use "~/assets/styles/global/main.scss" as *;'
        }
      }
    },
    server: {
      proxy: {
        "/lk/method": {
          target: process.env.NUXT_PUBLIC_API_BASE,
          changeOrigin: true,
          rewrite: path => path.replace(/^\/lk/, "")
        }
      }
    }
  },

  ssr: false,

  components: false
});

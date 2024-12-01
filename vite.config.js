// import { defineConfig } from "vite";
// import laravel from "laravel-vite-plugin";
// import vue from "@vitejs/plugin-vue";
// import axios from 'axios';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ["resources/css/app.css", "resources/js/app.js"],
//             refresh: false,
//         }),
//         vue({
//             template: {
//                 transformAssetUrls: {
//                     base: null,
//                     includeAbsolute: false,
//                 },
//             },
//         }),
//     ],
//     build: {
//         rollupOptions: {
//           input: 'resources/js/app.js',  // Giriş dosyanızın yolu
//         }
//       },
//     resolve: {
//         alias: {
//             vue: "vue/dist/vue.esm-bundler.js",
//         },
//     },
//     optimizeDeps: {
//         include: ['vue', 'axios'], // Gerekli bağımlılıkları ekleyin
//       },      
// });

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true, // Otomatik yenileme aktif
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
    server: {
        watch: {
            usePolling: true,
        },
        hmr: {
            host: 'localhost',
        },
    },
});

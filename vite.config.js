import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import {
    quasar,
    transformAssetUrls
} from '@quasar/vite-plugin'

const dotenv = require('dotenv');
dotenv.config();

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls,
            },
        }),
        quasar({
            sassVariables: 'resources/sass/quasar-variables.sass'
        })
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    server: {
        host: process.env.VITE_HOST,
        hmr: {
            host: process.env.IP_HOST,
        },
      }
});

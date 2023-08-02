import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import fs from 'fs';
import path from 'path';
import { visualizer } from "rollup-plugin-visualizer";

//#========== laravel-vue-i18n ==========
//Generate json for frontend from laravel php
//https://github.com/xiCO2k/laravel-vue-i18n
//import i18n from 'laravel-vue-i18n/vite';

export default defineConfig({
    define: {
        // Vue I18n feature flags. Adjust according to your needs
        '__VUE_I18N_FULL_INSTALL__': false,
        '__VUE_I18N_LEGACY_API__': true,
        '__INTLIFY_PROD_DEVTOOLS__': false,
    },
    server: {
        host: 'localhost', // replace with your domain
        cors: {
          origin: '*',
        },
        https: {
            key: fs.readFileSync(path.join(__dirname, 'data/certificates/localhost.key')),
            cert: fs.readFileSync(path.join(__dirname, 'data/certificates/localhost.crt')),
        },
        port: 8000,
        open: true
        // other options...
    },
    plugins: [
		vue(),
        //#========== laravel-vue-i18n ==========
        //i18n(),
        visualizer({
            filename: './report.html',
            //open: true,
            gzipSize: true,
            brotliSize: true,
            // Other options...
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
	resolve: {
		alias: {
			vue: "vue/dist/vue.esm-bundler.js",
            '@': path.resolve(__dirname, './resources/js'),
		}
	}
});

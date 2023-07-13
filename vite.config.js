import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import fs from 'fs';
import path from 'path';

export default defineConfig({
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
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
	resolve: {
		alias: {
			vue: "vue/dist/vue.esm-bundler.js",
		}
	}
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/css/styles.min.css'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            'simplebar': 'simplebar/dist/simplebar.css'
        }
    }
});

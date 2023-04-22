import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            https: true,
            host: 'biblioteca.test',
        }
    },
    plugins: [
        laravel({
            input: [
                // CSS
                'resources/sass/app.scss',
                // JS
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

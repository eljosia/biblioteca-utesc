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
                'resources/css/loader.css',
                // JS
                'resources/js/jquery.min.js',
                'resources/js/app.js',
                'resources/js/datatables/jquery.dataTables.min.js',
                'resources/js/datatables/dataTables.min.js',

                // PAGES
                'resources/js/pages/books/index.js',
            ],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        exclude: ['js-big-decimal']
    }
});
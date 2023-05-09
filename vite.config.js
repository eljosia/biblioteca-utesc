import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            https: true,
            host: 'biblioteca.local',
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
                'resources/js/home.js',
                'resources/js/search_book.js',

                'resources/js/pages/reports/index.js',

                'resources/js/pages/books/index.js',
                'resources/js/pages/books/new.js',
                'resources/js/pages/books/edit.js',

                'resources/js/pages/loans/index.js',
                'resources/js/pages/loans/new.js',
                'resources/js/pages/loans/show.js',

                'resources/js/pages/peoples/index.js',
                'resources/js/pages/peoples/new.js',


            ],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        exclude: ['js-big-decimal']
    }
});

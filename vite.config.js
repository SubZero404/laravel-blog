import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'vendor/jquery-3.6.0.js',
                'resources/sass/page.scss',
                'resources/js/page.js'
            ],
            refresh: true,
        }),
    ],
});

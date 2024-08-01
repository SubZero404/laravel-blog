import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'vendor/jquery-3.6.0.js',
                'vendor/summernote/summernote.min.css',
                'vendor/summernote/summernote-lite.min.css',
                'vendor/summernote/summernote-lite.js'
            ],
            refresh: true,
        }),
    ],
});

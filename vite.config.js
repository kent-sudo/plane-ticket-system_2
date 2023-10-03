import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'public/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        https: false,
        host: 'localhost',
    },
});

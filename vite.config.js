import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import tailwindcss from '@tailwindcss/vite';
import sveltePreprocess from 'svelte-preprocess';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        svelte({
            preprocess: sveltePreprocess(),
            compilerOptions: {
                hydratable: false,
            },
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            input: 'index.html',
        },
    },
    optimizeDeps: {
        exclude: ['@inertiajs/svelte'],
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});

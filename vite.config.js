import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import react from '@vitejs/plugin-react'
import { globSync } from 'glob';
import tailwindcss from "@tailwindcss/vite"
import path from 'path'
const componentFiles = globSync('resources/src/components/**/*');

export default defineConfig({
    plugins: [
        vue(),
        react(),
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/src/App.vue',
                'resources/src/Layout.vue',
                'resources/js/store/index.js',
                'resources/src/lib/utils.ts',
                ...componentFiles,
            ],

            refresh: true,
        }),

    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/src"),
        },
    }
});

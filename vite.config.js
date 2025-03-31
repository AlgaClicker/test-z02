import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import { globSync } from 'glob';
import tailwindcss from "@tailwindcss/vite"
import path from 'path'
const componentFiles = globSync('resources/js/**/*');

export default defineConfig({
    plugins: [
        vue(),
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/src/App.vue',
                'resources/src/Layout.vue',
                ...componentFiles,
            ],

            refresh: true,
        }),

    ],
    alias: {
        "@/": path.resolve(__dirname, "resources/src/*"),
        "@components": path.resolve(__dirname, "resources/js/components"),
        "@src": path.resolve(__dirname, "resources/src"),
    },
});

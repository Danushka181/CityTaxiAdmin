import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import nested from 'postcss-nested';
import postcss from "postcss";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/scss/style.scss'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        postcss({
            plugins: [
                nested()
            ]
        })
    ],
});

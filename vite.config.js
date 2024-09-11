import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy'
import Vue from '@vitejs/plugin-vue';
import path from "path";
// import vueDevTools from 'vite-plugin-vue-devtools'

export default defineConfig({
    resolve: {
        alias: {
            '@shadcn': path.resolve(__dirname, "./@"),
            '@/lib/utils': path.resolve(__dirname, "./@/lib/utils"),
            '@node_modules': path.resolve(__dirname, "./node_modules"),
        }
    },
    base: './',
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss', 'resources/js/app.js',
                'resources/css/config/dashboard.scss', 'resources/js/dashboard.js'
            ],
            refresh: true,
        }),
        Vue(),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/views/dashboard/authentication/[!.]*',
                    dest: 'resources/js/.views/authentication'
                },
                {
                    src: 'resources/images/[!.]*',
                    dest: 'resources/images'
                },
                {
                    src: 'resources/images/[!.]*',
                    dest: 'resources/images'
                }
            ]
        }),
        // vueDevTools(),
    ],
});

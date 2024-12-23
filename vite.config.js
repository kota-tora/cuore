import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/front/app.ts'],
            refresh: ['resources/js/**/src/**'],
            // buildDirectory: 'bundle/'
        }),
        vue(),
    ],
build: {
    manifest: true, // 本番用ビルドでmanifest.jsonを生成
    },
// build: {
//     outDir: 'public/bundle', // 同じパスを明示的に指定
//     },
});

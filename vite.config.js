import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/front/app.ts'],
            refresh: ['resources/js/**/src/**'],
            buildDirectory: 'build'
        }),
        vue(),
    ],
build: {
    manifest: true, // 本番用ビルドでmanifest.jsonを生成
    outDir: 'public/build',
    rollupOptions: {
        input: './resources/js/front/app.ts', // エントリーポイントを指定
    },
    },
});

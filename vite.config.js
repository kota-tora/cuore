import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
    laravel({
        input: ['resources/css/app.css', 'resources/js/front/app.ts'],
        refresh: ['resources/js/**/src/**'],
        buildDirectory: 'build', // この設定を活かすため、出力先も指定
    }),
    vue(),
  ],
build: {
    // manifest: true, // 本番用ビルドで .vite/にmanifest.json を生成する。エラーになる
    outDir: 'public/build/', // 出力先ディレクトリを明示的に指定
    rollupOptions: {
        input: './resources/js/front/app.ts', // エントリーポイントを指定
    },
    },
});

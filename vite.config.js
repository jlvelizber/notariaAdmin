import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.tsx',
            refresh: true,
        }),
        react()
    ],
    resolve: {
        alias: {
            "@asset": path.resolve(__dirname, "resources/img"),
            "@styles": path.resolve(__dirname, "resources/css"),
        }}
});

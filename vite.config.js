import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: '0.0.0.0'
        },
        watch: {
            // Exclude directories yang tidak perlu di-watch
            ignored: [
                '**/vendor/**',
                '**/node_modules/**',
                '**/storage/**',
                '**/public/build/**',
                '**/.git/**',
                '**/bootstrap/cache/**'
            ]
        }
    },
    // Tambahan konfigurasi watcher
    optimizeDeps: {
        exclude: ['laravel-vite-plugin']
    }
});
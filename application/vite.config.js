import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler' // or "modern"
            }
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: true, // Allow access from the network
        port: 5173, // Use the port exposed in Docker app service
        strictPort: true, // Fail if the port is already in use
        hmr: {
            host: 'localhost',
            protocol: 'ws',
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
            usePolling: true, // Enable polling for file changes
        },
    },
});

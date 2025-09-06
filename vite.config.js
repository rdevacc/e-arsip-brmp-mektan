import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    //  server: {
    //     host: '0.0.0.0',       // Bisa diakses semua IP
    //     port: 5173,            // Default port Vite
    //     strictPort: true,
    //     hmr: {
    //         host: '192.168.0.101', // Ganti dengan IP lokal kamu
    //     },
    // },
});

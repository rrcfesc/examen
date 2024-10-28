import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0', // Esto permite que el servidor de Vite esté accesible desde Docker
        port: 5173,
        hmr: {
            host: 'localhost', // O la IP pública que uses para Docker, por ejemplo, `127.0.0.1`
            port: 5173,
        },
        cors: true,
    },
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js', 'resources/js/to-do.js', 'resources/css/to-do.scss'],
            refresh: true,
        }),
    ],
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/admin.scss',  
                'resources/scss/client.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    // 👇 أضيفي هذا الجزء الصغير لضمان استقرار مسار التوليد على السيرفر
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
    }
});
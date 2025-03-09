import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        hmr: false, // Matikan hot reload di mode production
    },
    build: {
        manifest: true,
        outDir: "public/build",
        rollupOptions: {
            input: ["resources/css/app.css", "resources/js/app.js"],
        },
    },
});

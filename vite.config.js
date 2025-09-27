import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";
import { viteStaticCopy } from 'vite-plugin-static-copy';
import collectModuleAssetsPaths from './vite-module-loader.js';

async function getConfig() {
    const paths = [
        'resources/css/app.css',
        'resources/js/app.js',
        'vendor/resma/filament-awin-theme/resources/css/theme.css'
    ];
    const allPaths = await collectModuleAssetsPaths(paths, 'Modules');

    return defineConfig({
        plugins: [
            laravel({
                input: allPaths,
                refresh: true,
            }),
            tailwindcss(),
            viteStaticCopy({
                targets: [
                    {
                        src: 'resources/images/avatars/*',
                        dest: 'images/avatars',
                    },
                ],
            }),
        ],
        server: {
            cors: true,
        },
    });

}

export default getConfig();


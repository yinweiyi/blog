import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css','resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    // Vue 插件将重写资产 URLs，当被引用
                    // 在单文件组件中，指向 Laravel Web 服务
                    // 设置它为 `null` 允许 Laravel 插件
                    // 去替代重写资产 URLs 指向到 Vite 服务
                    base: null,

                    //  Vue 插件将解析绝对 URLs
                    // 并把它们看做磁盘上的绝对路径。
                    // 设置它为 `false` 将保留绝对 URLs
                    // 以便它们可以按照预期直接引用公共资产。
                    includeAbsolute: false,
                },
            },
        })
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});

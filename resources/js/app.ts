import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import axios from 'axios';
import AppLayout from '@/layouts/AppLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: async (name) => {
        const page = await resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue')
        );

        if (!page.default.layout) {
            page.default.layout = AppLayout;
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);

        axios.interceptors.response.use(
            (response) => {
                return response;
            },
            (error) => {
                if (error.response?.status === 500) {
                    alert(error.message);
                }
                if (error.response?.status === 422) {
                    const errors = error.response.data.errors;
                    const messages = Object.values(errors).flat().join('\n');
                    alert(messages);
                } else {
                    alert(error.messages);
                }
                return Promise.reject(error);
            }
        );
    },
    progress: {
        color: '#4B5563',
    },
});

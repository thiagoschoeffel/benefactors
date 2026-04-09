import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import VueTheMask from 'vue-the-mask';
import money from 'v-money';

const pages = import.meta.glob('./Pages/**/*.vue');

createInertiaApp({
    resolve: (name) => {
        const page = pages[`./Pages/${name}.vue`];
        if (!page) {
            throw new Error(`Page component '${name}' could not be resolved.`);
        }
        return page();
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueTheMask)
            .use(money, { precision: 4 })
            .mount(el);
    },
    progress: {
        color: '#f87171',
    },
});

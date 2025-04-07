import {createApp, h} from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import axios from "axios";
import { createPinia } from 'pinia'


axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

let token =  localStorage.getItem('auth_token')
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}


void createInertiaApp({
    resolve: name => {

        const pages = import.meta.glob('../src/Pages/**/*.vue', { eager: true })
        return pages[`../src/Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {

        const pinia = createPinia()
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)

            .mount(el)
    },
});


import {createApp, h} from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import axios from "axios";


axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

let token =  localStorage.getItem('auth_token')
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
    console.log("Layout",token);
}


void createInertiaApp({
    resolve: name => {

        const pages = import.meta.glob('../src/Pages/**/*.vue', { eager: true })
        return pages[`../src/Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
});


//createApp(App).mount("#app")

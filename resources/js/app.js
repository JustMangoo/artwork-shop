import "./bootstrap";
import "../css/app.css";
import axios from "axios"; // Import Axios if not already globally available

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

// Setup Axios interceptors
axios.interceptors.response.use(
    function (response) {
        // Handle successful responses
        if (response.data && response.data.message) {
            // Optionally handle flash messages here
            console.log("Success:", response.data.message);
        }
        return response;
    },
    function (error) {
        // Handle errors
        if (error.response && error.response.data.message) {
            // Optionally handle flash messages here
            console.log("Error:", error.response.data.message);
        }
        return Promise.reject(error);
    }
);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.config.globalProperties.$axios = axios;

        app.use(plugin).use(ZiggyVue).mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

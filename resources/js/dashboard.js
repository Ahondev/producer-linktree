import { createApp } from 'vue'
import Entrypoint from "./Entrypoint.vue";
import axios from 'axios';
// import Vue3ColorPicker from "vue3-colorpicker";
// import "vue3-colorpicker/style.css";

window.env = {
    APP_NAME: import.meta.env.VITE_APP_NAME,
    APP_DEBUG: import.meta.env.VITE_DEBUG === "true",
    APP_DOMAIN: import.meta.env.VITE_APP_DOMAIN,
    APP_URL: import.meta.env.VITE_APP_URL,
    is_dev: () => { return import.meta.env.VITE_APP_ENV !== 'production' },
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if(window.env.APP_DEBUG) { console.log("[axios] loaded!") }

class App {

    async boot() {

        this.modules = import.meta.glob('/resources/views/dashboard/**/*.vue');
        this.context = await this.resolveContext()

        let component = this.context.component
        let data = this.context.data
        let user = this.context.user

        window.user = user
        window.data = data

        const app = createApp(Entrypoint, {
            component: component,
            data: data,
            user: user
        })

        app.mount("#app")

        if(!window.env.is_dev()) { this.cleanContextFromDOM() }

    }

    async resolveContext () {
        const body = document.querySelector("body")
        let user = body.hasAttribute("v-user") ? body.getAttribute("v-user") : null
        if(user){ user = JSON.parse(user.replaceAll("'", '"')) }
        return {
            component: await this.resolveComponent(body.getAttribute("v-component")),
            data: JSON.parse(body.getAttribute("v-data")),
            user: user
        }
    }

    async resolveComponent(componentString) {
        let componentPath = componentString.replaceAll(".", "/");
        let key = `/resources/views/dashboard/${componentPath}.vue`;

        if (this.modules[key]) {
            try {
                const component = await this.modules[key]();
                return component.default;
            } catch (e) {
                console.log(`[vuejs] error loading ${componentPath}`, e);
            }
        } else {
            console.log(`[vuejs] component not found: ${componentPath}`);
        }
        return false;
    }

    cleanContextFromDOM() {
        const body = document.querySelector("body")
        if(body.hasAttribute('v-user')) { body.removeAttribute('v-user') }
        if(body.hasAttribute('v-data')) { body.removeAttribute('v-data') }
    }

}

window.onload = () => { (new App()).boot().then(r => {
    console.log("[vuejs] view loaded!")
}) }

window.env = {
    APP_NAME: import.meta.env.VITE_APP_NAME,
    APP_DEBUG: import.meta.env.VITE_DEBUG === "true"
}

/**
 * Initializing form manager
 */

import { FormManager } from "./classes/forms/FormManager.js";
import { forms } from "./config/forms.js";

FormManager.__INSTANCE__ = new FormManager(forms())

window.FormController = (form) => {
    const formElement = document.querySelector(`form#${form}`)
    const controller = new (FormManager.instance().controller(form))(formElement)
    FormManager.instance().registerInstance(form, controller)
    return controller.serializeForAlpine()
}
window.FormManager = FormManager.__INSTANCE__

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if(window.env.APP_DEBUG) { console.log("[axios] loaded!") }

/**
 * We'll load the Alpine JS Library
 */

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

if(window.env.APP_DEBUG) { console.log("[alpinejs] loaded!") }

/**
 * We'll load the AOS Library
 */

import AOS from 'aos'
window.AOS = AOS
AOS.init()
AOS.refresh()

if(window.env.APP_DEBUG) { console.log("[aos] loaded!") }

/**
 * We'll load the ScrollMagic Library
 */

import ScrollMagic from "scrollmagic";
import { ScrollMagicPluginIndicator} from "scrollmagic-plugins";

window.ScrollMagic = ScrollMagic
ScrollMagicPluginIndicator(ScrollMagic);

if(window.env.APP_DEBUG) { console.log("[scrollmagic] loaded!") }
if(window.env.APP_DEBUG) { console.log("[scrollmagic-plugins] scrollmagic-indicator loaded!") }

/**
 * We'll load the Lottie Player
 */

import "@lottiefiles/lottie-player";

/**
 * We'll load the Tilt Library
 */

import 'vanilla-tilt'

if(window.env.APP_DEBUG) { console.log("[vanilla-tilt] loaded!") }

/**
 * We'll load the Swiper Web Component
 */

import { register as registerSwiper } from 'swiper/element/bundle';

registerSwiper()

if(window.env.APP_DEBUG) { console.log("[swiperjs] loaded!") }

/**
 * We'll load the Swiper Web Component
 */

import NiceSelectImport from "@node_modules/nice-select2/src/js/nice-select2.js";
window.NiceSelect = NiceSelectImport

if(window.env.APP_DEBUG) { console.log("[nice-select] loaded!") }

/**
 * We'll load the Toastify library
 */

import ToastifyLibrary from 'toastify-js'
import "toastify-js/src/toastify.css"
window.Toastify = ToastifyLibrary


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

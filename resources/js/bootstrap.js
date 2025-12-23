import "bootstrap";

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Toastify from "toastify-js";

window.toast = (message, type = "success") => {
    const themes = {
        success: {
            bg: "linear-gradient(135deg, #22c55e, #16a34a)",
            icon: "✓",
        },
        error: {
            bg: "linear-gradient(135deg, #ef4444, #b91c1c)",
            icon: "✕",
        },
        warning: {
            bg: "linear-gradient(135deg, #f59e0b, #d97706)",
            icon: "!",
        },
        info: {
            bg: "linear-gradient(135deg, #3b82f6, #2563eb)",
            icon: "i",
        },
    };

    const theme = themes[type] || themes.info;

    Toastify({
        text: `
            <div style="display:flex;align-items:center;gap:10px">
                <div style="
                    width:28px;
                    height:28px;
                    border-radius:50%;
                    background:rgba(255,255,255,.25);
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-weight:700">
                    ${theme.icon}
                </div>
                <span>${message}</span>
            </div>
        `,
        duration: 3000,
        gravity: "top",
        position: "left",
        close: false,
        stopOnFocus: true,
        escapeMarkup: false,
        style: {
            background: theme.bg,
            borderRadius: "14px",
            padding: "14px 18px",
            fontSize: "14px",
            fontWeight: "500",
            boxShadow: "0 12px 30px rgba(0,0,0,.18)",
        },
    }).showToast();
};

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
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

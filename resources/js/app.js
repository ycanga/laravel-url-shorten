import { createApp } from "vue";
import "./bootstrap";
import "toastify-js/src/toastify.css";

axios.defaults.headers.common["Accept-Language"] =
    window.Laravel?.locale || "en";

const app = createApp({
    data() {
        return {
            //*GLOBAL
            appUrl: window.Laravel?.appUrl || "",
            locale: window.Laravel?.locale || "en",
            isLoading: false,
            responseMessage: "",

            //*HOME
            url: "",
            domain: "",
            faqs: [],

            //* LOGIN
            loginForm: {
                email: "",
                password: "",
                remember: false,
            },
            loginError: "",

            //* REGISTER
            registerForm: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            registerError: "",
        };
    },

    mounted() {
        if (this.appUrl) {
            this.domain = this.appUrl;
        }

        if (document.getElementById("faq")) {
            this.fetchFaqs();
        }
    },

    methods: {
        //* HOME – URL SHORTENE
        async sendRequest() {
            this.isLoading = true;
            this.responseMessage = "";

            try {
                const response = await axios.post("/free/shorten", {
                    url: this.url,
                    domain: this.domain,
                });

                this.responseMessage = response.data?.message || "";

                if (response.data?.data?.short_url) {
                    this.responseMessage += `
                        <br>
                        <a href="${response.data.data.short_url}" target="_blank">
                            ${response.data.data.short_url}
                        </a>
                    `;
                }
            } catch (error) {
                this.handleError(error);
            } finally {
                this.isLoading = false;
            }
        },

        async fetchFaqs() {
            try {
                const response = await axios.get("/api/faqs");

                this.faqs = Array.isArray(response.data)
                    ? response.data.map((faq) => ({
                          id: faq.id,
                          question:
                              JSON.parse(faq.question)?.[this.locale] || "",
                          answer: JSON.parse(faq.answer)?.[this.locale] || "",
                      }))
                    : [];
            } catch (error) {
                console.error("FAQ FETCH ERROR:", error);
            }
        },

        //* LOGIN
        async login() {
            this.isLoading = true;
            this.loginError = "";

            try {
                const response = await axios.post(
                    "/auth/login",
                    this.loginForm
                );

                window.location.href = "/";
            } catch (error) {
                console.error("LOGIN ERROR:", error);

                this.loginError =
                    error.response?.data?.message || "Unexpected error.";
            } finally {
                this.isLoading = false;
            }
        },

        /* ======================================================
         | REGISTER
         ====================================================== */
        async register() {
            this.isLoading = true;
            this.registerError = "";

            try {
                const response = await axios.post(
                    "/api/auth/register",
                    this.registerForm
                );
                toast(
                    response.data.message || "Register successful",
                    "success"
                );
                // console.log("REGISTER SUCCESS:", response.data);

                setTimeout(() => {
                    window.location.href = "/auth/login";
                }, 2500);
            } catch (error) {
                // Backend lang message
                this.registerError =
                    error.response?.data?.message || "Unexpected error.";

                toast(
                    error.response?.data?.message || "Register error",
                    "error"
                );
                let err = error.response.data.errors;

                if (err) {
                    let html = "</br><ul>";
                    for (const messages of Object.values(err)) {
                        messages.forEach((msg) => {
                            html += `<li>${msg}</li>`;
                        });
                    }
                    this.registerError += html + "</ul>";
                } else {
                    this.registerError = message;
                }
                console.error("REGISTER ERROR:", err);
            } finally {
                this.isLoading = false;
            }
        },

        /* ======================================================
         | GLOBAL ERROR HANDLER
         ====================================================== */
        handleError(error) {
            const message =
                error.response?.data?.message || "Unexpected error.";
            const errors = error.response?.data?.errors;

            let html = "";
            if (errors) {
                for (const messages of Object.values(errors)) {
                    messages.forEach((msg) => {
                        html += `<div>${msg}</div>`;
                    });
                }
                this.responseMessage = html;
            } else {
                this.responseMessage = message;
            }

            console.error("GLOBAL ERROR:", error);
        },
    },
});

const appEl = document.getElementById("app");
if (appEl) {
    app.mount("#app");
}

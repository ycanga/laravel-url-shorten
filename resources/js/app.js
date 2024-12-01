import "./bootstrap";

const app = Vue.createApp({
    data() {
        return {
            url: "",
            domain: "",
            appUrl: window.Laravel.appUrl,
            isLoading: false,
            responseMessage: "",
        };
    },
    created() {
        this.domain = this.appUrl;
    },
    methods: {
        async sendRequest() {
            if (!this.url || !this.url.trim()) {
                this.responseMessage = "Lütfen geçerli bir URL girin!";
                return;
            }

            if (!this.domain || !this.domain.trim()) {
                this.responseMessage = "Lütfen geçerli bir domain seçin!";
                return;
            }

            this.isLoading = true;

            try {
                const response = await axios.post("/api/shorten", {
                    url: this.url,
                    domain: this.domain,
                });
                this.responseMessage = response.data.message;
                if (response.data.data && response.data.data.short_url) {
                    this.responseMessage += `<br><a href="${response.data.data.short_url}" target="_blank">${response.data.data.short_url}</a>`;
                }
            } catch (error) {
                const message = error.response.data.message;
                const errors = error.response.data.errors;

                if (errors) {
                    let errorMessages = "";
                    for (const [field, messages] of Object.entries(errors)) {
                        errorMessages += `<strong>${field}:</strong><ul>`;
                        messages.forEach((msg) => {
                            errorMessages += `<li>${msg}</li>`;
                        });
                        errorMessages += `</ul>`;
                    }
                    this.responseMessage = `${message}<br>${errorMessages}`;
                } else {
                    this.responseMessage = message;
                }

                console.error(error);
            } finally {
                this.isLoading = false;
            }
        },
    },
});

app.mount("#app");

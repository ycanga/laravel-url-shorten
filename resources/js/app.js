import "./bootstrap";

const app = Vue.createApp({
    data() {
        return {
            url: "",
            domain: "",
            appUrl: window.Laravel.appUrl,
            isLoading: false,
            responseMessage: "",
            faqs: [],
            locale: window.Laravel.locale,
        };
    },
    created() {
        this.domain = this.appUrl;
        this.fetchFaqs();
    },
    methods: {
        async sendRequest() {
            // console.log(locale);
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
                this.handleError(error);
            } finally {
                this.isLoading = false;
            }
        },

        async fetchFaqs(faqs) {
            
            try {
                const response = await axios.get("/api/faqs");
                faqs = Array.isArray(response.data)
                    ? response.data.map((faq) => {
                          return {
                              id: faq.id,
                              question: JSON.parse(faq.question)[this.locale],
                              answer: JSON.parse(faq.answer)[this.locale],
                          };
                      })
                    : [];

                this.faqs = faqs;
            } catch (error) {
                console.error("Domain listesi alınamadı:", error);
            }
        },

        // Hata işleme fonksiyonu (kod tekrarı azaltmak için)
        handleError(error) {
            const message = error.response?.data?.message || "Bir hata oluştu!";
            const errors = error.response?.data?.errors;

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
        },
    },
});

app.mount("#app");

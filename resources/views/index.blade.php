@extends('layouts.app')

@section('seo-desc', 'Free URL shortener to create the perfect short URLs for your business.')
@section('seo-title', 'Free URL Shortener')
@section('seo-keywords',
    'url shortener, free url shortener, short url, short link, link shortener, shorten url, shorten
    link, free short url, free short link generator, free url')
@section('title', 'Home')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                            <div class="company-badge mb-4">
                                <i class="bi bi-gear-fill me-2"></i>
                                @lang('home/home.motto')
                            </div>

                            <h3 class="mb-4">
                                {!! __('home/home.short_desc') !!}
                            </h3>

                            <div class="card rounded">
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <label for="url" class="form-label"> <i class="fa fa-link"
                                                aria-hidden="true"></i> @lang('home/home.url_label')</label>
                                        <input v-model="url" type="text" class="form-control p-2"
                                            placeholder="Enter your URL here" aria-label="Enter your URL here"
                                            aria-describedby="button-addon2" @keyup.enter="sendRequest" id="url">
                                    </div>

                                    <div class="mb-3">
                                        <label for="domain" class="form-label"> <i
                                                class="fa-solid fa-wand-magic-sparkles"></i>
                                            @lang('home/home.domain_label')
                                        </label>
                                        <select v-model="domain" id="domain" class="form-control p-2">
                                            <option :value="appUrl" selected>@{{ appUrl }}</option>
                                        </select>

                                    </div>
                                    <div v-if="responseMessage" v-html="responseMessage"
                                        class="alert alert-info mt-3 text-start" role="alert">
                                    </div>

                                    <div class="hero-buttons">
                                        <button @click="sendRequest" class="btn btn-primary me-0 me-sm-2 mx-1"
                                            :disabled="isLoading">
                                            <span v-if="isLoading" class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            @lang('home/home.shorten_btn')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                            <img src="assets/img/illustration-1.webp" alt="Hero Image" class="img-fluid">

                            <div class="customers-badge">
                                <div class="customer-avatars">
                                    <img src="assets/img/avatar-1.webp" alt="Customer 1" class="avatar">
                                    <img src="assets/img/avatar-2.webp" alt="Customer 2" class="avatar">
                                    <img src="assets/img/avatar-3.webp" alt="Customer 3" class="avatar">
                                    <img src="assets/img/avatar-4.webp" alt="Customer 4" class="avatar">
                                    <img src="assets/img/avatar-5.webp" alt="Customer 5" class="avatar">
                                    <span class="avatar more">12+</span>
                                </div>
                                <p class="mb-0 mt-2">12,000+ @lang('home/home.url_count_desc')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fa-solid fa-infinity"></i>
                            </div>
                            <div class="stat-content">
                                <h4>@lang('home/home.stats.unlimited')</h4>
                                <p class="mb-0">@lang('home/home.stats.unlimited_shorten')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <div class="stat-content">
                                <h4>@lang('home/home.stats.fast')</h4>
                                <p class="mb-0">@lang('home/home.stats.fast_shorten')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </div>
                            <div class="stat-content">
                                <h4>@lang('home/home.stats.cheap')</h4>
                                <p class="mb-0">@lang('home/home.stats.cheap_shorten')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fa-solid fa-code"></i>
                            </div>
                            <div class="stat-content">
                                <h4>@lang('home/home.stats.code')</h4>
                                <p class="mb-0">@lang('home/home.stats.code_shorten')</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Hero Section -->

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>@lang('home/home.pricing')</h2>
                <p>@lang('home/home.pricing_desc')</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 justify-content-center">

                    <!-- Basic Plan -->
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-card">
                            <h3>@lang('home/home.plans.basic')</h3>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">9.9</span>
                                <span class="period">/ month</span>
                            </div>
                            <p class="description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium doloremque laudantium totam.</p>

                            <h4>Featured Included:</h4>
                            <ul class="features-list">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Duis aute irure dolor
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Excepteur sint occaecat
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Nemo enim ipsam voluptatem
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary">
                                @lang('home/home.buy_now')
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Standard Plan -->
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card popular">
                            <div class="popular-badge">Most Popular</div>
                            <h3>@lang('home/home.plans.standard')</h3>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">19.9</span>
                                <span class="period">/ month</span>
                            </div>
                            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                blanditiis praesentium voluptatum.</p>

                            <h4>Featured Included:</h4>
                            <ul class="features-list">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Lorem ipsum dolor sit amet
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Consectetur adipiscing elit
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Sed do eiusmod tempor
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Ut labore et dolore magna
                                </li>
                            </ul>

                            <a href="#" class="btn btn-light">
                                @lang('home/home.buy_now')
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Premium Plan -->
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="pricing-card">
                            <h3>@lang('home/home.plans.premium')</h3>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">39.9</span>
                                <span class="period">/ month</span>
                            </div>
                            <p class="description">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse
                                quam nihil molestiae.</p>

                            <h4>Featured Included:</h4>
                            <ul class="features-list">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Temporibus autem quibusdam
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Saepe eveniet ut et voluptates
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Nam libero tempore soluta
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Cumque nihil impedit quo
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Maxime placeat facere possimus
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary">
                                @lang('home/home.buy_now')
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Pricing Section -->

        <!-- Faq Section -->
        <section class="faq-9 faq section bg-light" id="faq">

            <div class="container">
                <div class="row">

                    <div class="col-lg-5" data-aos="fade-up">
                        <h2 class="faq-title">@lang('home/home.faq.title')</h2>
                        <p class="faq-description">@lang('home/home.faq.desc')</p>
                        <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
                            <svg class="faq-arrow" width="200" height="211" viewBox="0 0 200 211" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M198.804 194.488C189.279 189.596 179.529 185.52 169.407 182.07L169.384 182.049C169.227 181.994 169.07 181.939 168.912 181.884C166.669 181.139 165.906 184.546 167.669 185.615C174.053 189.473 182.761 191.837 189.146 195.695C156.603 195.912 119.781 196.591 91.266 179.049C62.5221 161.368 48.1094 130.695 56.934 98.891C84.5539 98.7247 112.556 84.0176 129.508 62.667C136.396 53.9724 146.193 35.1448 129.773 30.2717C114.292 25.6624 93.7109 41.8875 83.1971 51.3147C70.1109 63.039 59.63 78.433 54.2039 95.0087C52.1221 94.9842 50.0776 94.8683 48.0703 94.6608C30.1803 92.8027 11.2197 83.6338 5.44902 65.1074C-1.88449 41.5699 14.4994 19.0183 27.9202 1.56641C28.6411 0.625793 27.2862 -0.561638 26.5419 0.358501C13.4588 16.4098 -0.221091 34.5242 0.896608 56.5659C1.8218 74.6941 14.221 87.9401 30.4121 94.2058C37.7076 97.0203 45.3454 98.5003 53.0334 98.8449C47.8679 117.532 49.2961 137.487 60.7729 155.283C87.7615 197.081 139.616 201.147 184.786 201.155L174.332 206.827C172.119 208.033 174.345 211.287 176.537 210.105C182.06 207.125 187.582 204.122 193.084 201.144C193.346 201.147 195.161 199.887 195.423 199.868C197.08 198.548 193.084 201.144 195.528 199.81C196.688 199.192 197.846 198.552 199.006 197.935C200.397 197.167 200.007 195.087 198.804 194.488ZM60.8213 88.0427C67.6894 72.648 78.8538 59.1566 92.1207 49.0388C98.8475 43.9065 106.334 39.2953 114.188 36.1439C117.295 34.8947 120.798 33.6609 124.168 33.635C134.365 33.5511 136.354 42.9911 132.638 51.031C120.47 77.4222 86.8639 93.9837 58.0983 94.9666C58.8971 92.6666 59.783 90.3603 60.8213 88.0427Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
                        {{-- <div class="faq-container" v-for="(item, index) in faqs" :key="index">

                            <div class="faq-item faq-active">
                                <h3>Non consectetur a erat nam at lectus urna duis?</h3>
                                <div class="faq-content">
                                    <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet
                                        non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor
                                        purus non.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div>
                                <div class="faq-item">
                                    <h3>@{{ item.question }}</h3>
                                    <div class="faq-content">
                                        <p>@{{ item.answer }}</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->
                            </div>

                            <div class="faq-item faq-active">
                                        <h3>@{{ item.question }}</h3>
                                        <div class="faq-content">
                                            <p>@{{ item.answer }}</p>
                                        </div>
                                        <i class="faq-toggle bi bi-chevron-right"></i>
                                    </div>
                            


                            <div class="faq-item">
                                <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
                                <div class="faq-content">
                                    <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus
                                        pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit.
                                        Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis
                                        tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h3>
                                <div class="faq-content">
                                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                        velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend
                                        donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in
                                        cursus turpis massa tincidunt dui.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Tempus quam pellentesque nec nam aliquam sem et tortor?</h3>
                                <div class="faq-content">
                                    <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in
                                        est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl
                                        suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Perspiciatis quod quo quos nulla quo illum ullam?</h3>
                                <div class="faq-content">
                                    <p>Enim ea facilis quaerat voluptas quidem et dolorem. Quis et consequatur non sed in
                                        suscipit sequi. Distinctio ipsam dolore et.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div> --}}
                        <div class="accordion" id="accordionExample" v-for="(item, index) in faqs" :key="index">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls=@{{item.question}}>
                                  @{{ item.question }}
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @{{ item.answer }}
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>

                </div>
            </div>
        </section><!-- /Faq Section -->
        <!-- Contact Section -->
        <section id="contact" class="contact section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-5">
                        <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                            <h3>Contact Info</h3>
                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum
                                primis.</p>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="content">
                                    <h4>Our Location</h4>
                                    <p>A108 Adam Street</p>
                                    <p>New York, NY 535022</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="content">
                                    <h4>Phone Number</h4>
                                    <p>+1 5589 55488 55</p>
                                    <p>+1 6678 254445 41</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="content">
                                    <h4>Email Address</h4>
                                    <p>info@example.com</p>
                                    <p>contact@example.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                            <h3>Get In Touch</h3>
                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum
                                primis.</p>

                            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                                data-aos-delay="200">
                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Your Name" required="">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Your Email" required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject"
                                            required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>

                                        <button type="submit" class="btn">Send Message</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>
@endsection

@section('scripts')
    <script>
        window.Laravel = {
            appUrl: "{{ env('APP_URL') }}",
            locale: "{{ app()->getLocale() }}"
        };
    </script>
@endsection

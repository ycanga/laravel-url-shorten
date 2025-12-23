@extends('layouts.app')

@section('seo-desc', 'Free URL shortener to create the perfect short URLs for your business.')
@section('seo-title', 'Free URL Shortener')
@section('seo-keywords',
    'url shortener, free url shortener, short url, short link, link shortener, shorten url, shorten
    link, free short url, free short link generator, free url')
@section('title', 'Home')

@section('content')
    <main class="main">
        <section class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center justify-content-center text-center">

                    <div class="col-lg-8">

                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">

                            <!-- Badge -->
                            <div class="company-badge mb-4">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                @lang('errors.404.message')
                            </div>

                            <!-- Big 404 -->
                            <h1 class="display-1 fw-bold mb-3">
                                404
                            </h1>

                            <!-- Description -->
                            <h3 class="mb-4">
                                @lang('errors.404.description')
                            </h3>

                            <p class="text-muted mb-4">
                                @lang('errors.404.details')
                                @lang('errors.404.return_message')
                            </p>

                            <!-- Actions -->
                            <div class="hero-buttons justify-content-center">
                                <a href="{{ route('home') }}" class="btn btn-primary me-2">
                                    <i class="bi bi-house-door me-1"></i>
                                    @lang('errors.404.homepage_button')
                                </a>

                                <a href="javascript:history.back()" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    @lang('errors.404.go_back_button')
                                </a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>
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

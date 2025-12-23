@extends('layouts.app')

@section('seo-desc', 'Free URL shortener to create the perfect short URLs for your business.')
@section('seo-title', 'Free URL Shortener')
@section('seo-keywords',
    'url shortener, free url shortener, short url, short link, link shortener, shorten url, shorten
    link, free short url, free short link generator, free url')
@section('title', 'Login')

@section('content')
    <main class="main">
        <section class="hero light-background">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">

                        <div class="card shadow-sm rounded-4">
                            <div class="card-body p-4">

                                <div class="text-center mb-4">
                                    <i class="bi bi-person-circle fs-1 text-primary"></i>
                                    <h3 class="mt-2">
                                        @lang('auth.login.title')
                                    </h3>
                                    <p class="text-muted">
                                        @lang('auth.login.subtitle')
                                    </p>
                                </div>

                                <form @submit.prevent="login">
                                    <div v-if="loginError" class="alert alert-danger">
                                        @{{ loginError }}
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">@lang('auth.login.email')</label>
                                        <input type="email" class="form-control p-2" placeholder="you@example.com"
                                            v-model="loginForm.email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">@lang('auth.login.password')</label>
                                        <input type="password" class="form-control p-2" placeholder="••••••••"
                                            v-model="loginForm.password" required>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <a href="#" class="small text-decoration-none">@lang('auth.login.forgot_password')</a>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg" :disabled="isLoading">
                                            <span v-if="isLoading" class="spinner-border spinner-border-sm me-2"></span>

                                            <span v-if="!isLoading">
                                                @lang('auth.login.login')
                                            </span>
                                            <span v-else>
                                                @lang('auth.login.loading')
                                            </span>
                                        </button>
                                    </div>

                                </form>

                                <div class="text-center mt-4">
                                    <p class="mb-0">
                                        @lang('auth.login.no_account')
                                        <a href="{{ route('register') }}" class="text-primary fw-semibold">
                                            @lang('auth.login.register')
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
@endsection

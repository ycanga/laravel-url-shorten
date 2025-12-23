@extends('layouts.app')

@section('seo-desc', 'Create a free account to start shortening your URLs easily.')
@section('seo-title', 'Register')
@section('seo-keywords', 'register, sign up, create account, free account, url shortener register')
@section('title', 'Register')

@section('content')
    <main class="main">
        <section class="hero light-background">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">

                        <div class="card shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <i class="bi bi-person-plus-fill fs-1 text-primary"></i>
                                    <h3 class="mt-2">
                                        @lang('auth.register.title')
                                    </h3>
                                    <p class="text-muted">
                                        @lang('auth.register.subtitle')
                                    </p>
                                </div>
                                <form @submit.prevent="register">
                                    <div v-if="registerError" class="alert alert-danger" v-html="registerError"></div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            @lang('auth.register.name')
                                        </label>
                                        <input type="text" class="form-control p-2" placeholder="@lang('auth.register.name_placeholder')"
                                            v-model="registerForm.name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            @lang('auth.register.email')
                                        </label>
                                        <input type="email" class="form-control p-2" placeholder="you@example.com"
                                            v-model="registerForm.email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            @lang('auth.register.password')
                                        </label>
                                        <input type="password" class="form-control p-2" placeholder="••••••••"
                                            v-model="registerForm.password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            @lang('auth.register.password_confirm')
                                        </label>
                                        <input type="password" class="form-control p-2" placeholder="••••••••"
                                            v-model="registerForm.password_confirmation" required>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg" :disabled="isLoading">

                                            <span v-if="isLoading" class="spinner-border spinner-border-sm me-2"></span>

                                            <span v-if="!isLoading">
                                                @lang('auth.register.register')
                                            </span>
                                            <span v-else>
                                                @lang('auth.register.loading')
                                            </span>
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center mt-4">
                                    <p class="mb-0">
                                        @lang('auth.register.have_account')
                                        <a href="{{ route('login') }}" class="text-primary fw-semibold">
                                            @lang('auth.register.login')
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

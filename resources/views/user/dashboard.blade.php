@extends('user.layouts.app')

@section('seo-desc', 'Free URL shortener to create the perfect short URLs for your business.')
@section('seo-title', 'Free URL Shortener')
@section('seo-keywords',
    'url shortener, free url shortener, short url, short link, link shortener, shorten url, shorten
    link, free short url, free short link generator, free url')
@section('title', __('dashboard.dashboard'))

@section('content')
    <main class="main">
        <section class="hero light-background">
            <div class="container" data-aos="fade-up">

                <!-- PAGE HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                    <div>
                        <h2 class="mb-1">
                            {{ __('dashboard.dashboard') }}
                        </h2>
                        <p class="text-muted mb-0">
                            {{ __('dashboard.welcome_back', ['name' => ucfirst(Auth::user()->name)]) }}
                        </p>
                    </div>

                    <a href="#" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>
                        {{ __('dashboard.new_short_url') }}
                    </a>
                </div>

                <!-- STATS -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-item h-100">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="stat-icon">
                                    <i class="fa-solid fa-link"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">{{ $urls->total() }}</h4>
                                    <p class="mb-0 text-muted">{{ __('dashboard.total_urls') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-item h-100">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="stat-icon">
                                    <i class="fa-solid fa-mouse-pointer"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">
                                        @php
                                            $totalClicks = 0;
                                            foreach ($urls as $url) {
                                                $totalClicks += $url->clicks;
                                            }
                                        @endphp
                                        {{ $totalClicks }}
                                    </h4>
                                    <p class="mb-0 text-muted">{{ __('dashboard.total_clicks') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-item h-100">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="stat-icon">
                                    <i class="fa-solid fa-chart-line"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">
                                        @php
                                            $todayClicks = 0;
                                            $today = \Carbon\Carbon::today();
                                            foreach ($urls as $url) {
                                                $todayClicks += $url->logs->where('created_at', '>=', $today)->count();
                                            }
                                        @endphp
                                        {{ $todayClicks }}
                                    </h4>
                                    <p class="mb-0 text-muted">{{ __('dashboard.clicks_today') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-item h-100">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="stat-icon">
                                    <i class="fa-solid fa-globe"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">
                                        {{ $activeDomains->count() }}
                                    </h4>
                                    <p class="mb-0 text-muted">{{ __('dashboard.active_domains') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- URL LIST -->
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <h5 class="mb-0">{{ __('dashboard.your_shortened_urls') }}</h5>
                            <form method="GET" action="{{ route('dashboard') }}" class="d-flex">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control w-auto" placeholder="{{ __('dashboard.search_url') }}">
                            </form>
                        </div>
                        <div id="urlsTable">
                            @include('user.partials.urls-table', ['urls' => $urls])
                        </div>
                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-end mt-3">
                            <nav>
                                <ul class="pagination mb-0">
                                    <li class="page-item {{ $urls->onFirstPage() ? 'disabled' : '' }}">
                                        @if ($urls->onFirstPage())
                                            <span class="page-link">{{ __('dashboard.previous') }}</span>
                                        @else
                                            <a class="page-link" href="{{ $urls->previousPageUrl() }}">
                                                {{ __('dashboard.previous') }}
                                            </a>
                                        @endif
                                    </li>
                                    @foreach ($urls->getUrlRange(1, $urls->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $urls->currentPage() ? 'active' : '' }}">
                                            @if ($page == $urls->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                    <li class="page-item {{ $urls->hasMorePages() ? '' : 'disabled' }}">
                                        @if ($urls->hasMorePages())
                                            <a class="page-link" href="{{ $urls->nextPageUrl() }}">
                                                {{ __('dashboard.next') }}
                                            </a>
                                        @else
                                            <span class="page-link">{{ __('dashboard.next') }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        let timeout = null;

        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('keyup', function(e) {

            // 🔴 Enter submit olmasın
            if (e.key === 'Enter') {
                e.preventDefault();
                return;
            }

            clearTimeout(timeout);

            timeout = setTimeout(() => {
                fetch(`{{ route('dashboard') }}?search=${encodeURIComponent(this.value)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('urlsTable').innerHTML = html;
                    });
            }, 300);
        });
    </script>
@endsection

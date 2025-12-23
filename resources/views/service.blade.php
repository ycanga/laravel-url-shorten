<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: #fff;
        }

        .hero {
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 1rem;
        }

        .feature-icon {
            font-size: 2rem;
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">{{ env('APP_NAME') }}</a>
            @if (!auth()->check())
                <div class="ms-auto">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Giriş Yap</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-sm">Kayıt Ol</a>
                </div>
            @else
                <div class="ms-auto">
                    <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm me-2">
                        Çıkış Yap
                    </a>
                </div>
            @endif
        </div>
    </nav>

    <section class="hero d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3">
                        Güçlü & Hızlı<br>URL Kısaltma API
                    </h1>
                    <p class="lead mb-4">
                        SNKRN ile linklerinizi saniyeler içinde kısaltın, analiz edin ve yönetin.
                        Geliştiriciler için modern REST API.
                    </p>

                    <div class="d-flex gap-2">
                        <a href="/dashboard" class="btn btn-light btn-lg">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                        <a href="/docs" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-code-slash me-1"></i> API Dokümantasyonu
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-lg p-4 text-dark">
                        <h5 class="mb-3">Örnek API Kullanımı</h5>
                        <pre class="bg-light p-3 rounded small mb-0"><code>POST /api/shorten
Authorization: Bearer YOUR_API_KEY

{
  "url": "https://example.com"
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light text-dark py-5">
        <div class="container">
            <div class="row text-center mb-4">
                <h2 class="fw-bold">Öne Çıkan Özellikler</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm p-4 text-center">
                        <i class="bi bi-lightning-charge feature-icon mb-3"></i>
                        <h5>Yüksek Performans</h5>
                        <p class="text-muted mb-0">Milisaniyeler içinde URL oluşturma.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm p-4 text-center">
                        <i class="bi bi-bar-chart feature-icon mb-3"></i>
                        <h5>Detaylı İstatistik</h5>
                        <p class="text-muted mb-0">Tıklama, tarih ve trafik analizi.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm p-4 text-center">
                        <i class="bi bi-shield-lock feature-icon mb-3"></i>
                        <h5>Güvenli API</h5>
                        <p class="text-muted mb-0">Token tabanlı yetkilendirme.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-4">
        <small class="text-white-50">
            © {{ date('Y') }} {{ env('APP_NAME') }}. Tüm hakları saklıdır.
        </small>
    </footer>

</body>

</html>

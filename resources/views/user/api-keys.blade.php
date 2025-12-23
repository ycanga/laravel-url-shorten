@extends('user.layouts.app')

@section('title', 'API Keys')

@section('styles')
    <style>
        .api-key-blur {
            filter: blur(6px);
            user-select: none;
            transition: filter .2s ease;
        }

        .api-key-wrapper:hover .api-key-blur {
            filter: blur(4px);
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <section class="hero light-background">
            <div class="container" data-aos="fade-up">

                <!-- PAGE HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1">API Keys</h2>
                        <p class="text-muted mb-0">
                            API erişimi için anahtarlarınızı yönetin
                        </p>
                    </div>

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createApiKeyModal">
                        <i class="bi bi-key me-1"></i> Yeni API Key
                    </button>
                </div>

                <!-- API KEY INFO -->
                <div class="alert alert-info rounded-4">
                    <strong>Bilgi:</strong> API Key’inizi yalnızca oluştururken görebilirsiniz.
                    Güvenli bir yerde saklayın.
                </div>

                <!-- API KEYS LIST -->
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Ad</th>
                                        <th>Son Kullanım</th>
                                        <th>Durum</th>
                                        <th class="text-end">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($apiKeys as $key)
                                        <tr>
                                            <td class="fw-semibold">{{ $key->name }}</td>
                                            <td>
                                                {{ $key->last_used_at ? $key->last_used_at->diffForHumans() : '—' }}
                                            </td>
                                            <td>
                                                <span class="badge {{ $key->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $key->is_active ? 'Aktif' : 'Pasif' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmDelete({{ $key->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                Henüz API Key oluşturmadınız.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <!-- CREATE API KEY MODAL -->
    <div class="modal fade" id="createApiKeyModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-semibold">Yeni API Key Oluştur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- FORM STATE -->
                    <div id="apiKeyForm">

                        <div class="text-center mb-4">
                            <h5 class="fw-semibold mb-1">Yeni API Key Oluştur</h5>
                            <p class="text-muted small mb-0">
                                API üzerinden istek atabilmek için yeni bir anahtar oluşturun.
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">API Key Adı</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-tag"></i>
                                </span>
                                <input type="text" id="apiKeyName" class="form-control" placeholder="Örn: Mobil Uygulama"
                                    required>
                            </div>

                            <div class="form-text">
                                Bu isim sadece sizin için görünür.
                            </div>
                        </div>

                        <button
                            class="btn btn-primary w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2"
                            onclick="createApiKey()">
                            <i class="bi bi-plus-circle"></i>
                            API Key Oluştur
                        </button>

                    </div>


                    <!-- RESULT STATE -->
                    <div id="apiKeyResult" class="d-none text-center">

                        <div class="alert alert-success rounded-4 d-flex gap-3 align-items-start">
                            <i class="bi bi-shield-check fs-3"></i>
                            <div class="text-start">
                                <strong>API Key oluşturuldu</strong>
                                <p class="mb-0 small text-muted">
                                    Bu anahtar güvenlik sebebiyle yalnızca bir kez gösterilir.
                                </p>
                            </div>
                        </div>

                        <!-- API KEY DISPLAY -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                API Key
                            </label>

                            <div class="input-group input-group-lg api-key-wrapper">
                                <input type="text" id="generatedApiKey"
                                    class="form-control text-center fw-semibold api-key-blur" readonly>

                                <button class="btn btn-outline-secondary" onclick="toggleApiKeyVisibility(this)">
                                    <i class="bi bi-eye"></i>
                                </button>

                                <button class="btn btn-outline-primary" onclick="copyApiKey()">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>

                            <div class="form-text text-danger">
                                Bu anahtarı güvenli bir yerde saklayın.
                            </div>
                        </div>

                        <button class="btn btn-light w-100 py-2 fw-semibold" data-bs-dismiss="modal">
                            Kapat
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- DELETE CONFIRM MODAL -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-body text-center p-4">

                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center
                               bg-danger bg-opacity-10 text-danger rounded-circle"
                            style="width:72px;height:72px;">
                            <i class="bi bi-exclamation-triangle fs-2"></i>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-2">
                        API Key Silinsin mi?
                    </h5>

                    <p class="text-muted small mb-4">
                        Bu işlem <strong>geri alınamaz</strong>.<br>
                        API Key kalıcı olarak silinecek.
                    </p>

                    <div class="d-flex gap-2">
                        <button class="btn btn-light w-100" data-bs-dismiss="modal">
                            Vazgeç
                        </button>

                        <button class="btn btn-danger w-100 fw-semibold" id="confirmDeleteBtn">
                            Evet, Sil
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function createApiKey() {
            const name = document.getElementById('apiKeyName').value;

            if (!name) {
                alert('API Key adı giriniz');
                return;
            }

            fetch("{{ route('api.keys.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) return;

                    toast('API Key başarıyla oluşturuldu.', 'success');

                    document.getElementById('apiKeyForm').classList.add('d-none');
                    document.getElementById('apiKeyResult').classList.remove('d-none');
                    document.getElementById('generatedApiKey').value = data.api_key;
                });
        }

        function copyApiKey() {
            const input = document.getElementById('generatedApiKey');
            input.select();
            document.execCommand('copy');

            alert('API Key kopyalandı');
        }

        // Modal kapanınca resetle
        document.getElementById('createApiKeyModal')
            .addEventListener('hidden.bs.modal', () => {
                document.getElementById('apiKeyForm').classList.remove('d-none');
                document.getElementById('apiKeyResult').classList.add('d-none');
                document.getElementById('apiKeyName').value = '';
            });
    </script>

    <script>
        function toggleApiKeyVisibility(btn) {
            const input = document.getElementById('generatedApiKey');
            const icon = btn.querySelector('i');

            if (input.classList.contains('api-key-blur')) {
                input.classList.remove('api-key-blur');
                icon.classList.replace('bi-eye', 'bi-eye-slash');

                setTimeout(() => {
                    input.classList.add('api-key-blur');
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                }, 3000);
            }
        }

        function copyApiKey() {
            const input = document.getElementById('generatedApiKey');
            navigator.clipboard.writeText(input.value);

            const btn = event.currentTarget;
            btn.innerHTML = '<i class="bi bi-check2"></i>';
            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-clipboard"></i>';
            }, 1500);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalEl = document.getElementById('createApiKeyModal');

            modalEl.addEventListener('hidden.bs.modal', resetApiKeyModal);
        });

        function resetApiKeyModal() {
            document.getElementById('apiKeyForm').classList.remove('d-none');
            document.getElementById('apiKeyResult').classList.add('d-none');

            document.getElementById('apiKeyName').value = '';
            document.getElementById('generatedApiKey').value = '';

            // blur state geri gelsin
            document.getElementById('generatedApiKey')
                .classList.add('api-key-blur');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('createApiKeyModal');

            modal.addEventListener('hidden.bs.modal', () => {
                location.reload();
            });
        });
    </script>

    <script>
        let deleteId = null;

        function confirmDelete(id) {
            deleteId = id;

            const modal = new bootstrap.Modal(
                document.getElementById('deleteConfirmModal')
            );

            modal.show();
        }

        document.addEventListener('DOMContentLoaded', () => {
            const confirmBtn = document.getElementById('confirmDeleteBtn');

            confirmBtn.addEventListener('click', () => {
                if (!deleteId) return;

                fetch(`/api-keys/${deleteId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(() => {
                        toast('API Key başarıyla silindi', 'success');

                        const modalEl = document.getElementById('deleteConfirmModal');
                        bootstrap.Modal.getInstance(modalEl).hide();

                        setTimeout(() => location.reload(), 1800);
                    });
            });
        });
    </script>

@endsection

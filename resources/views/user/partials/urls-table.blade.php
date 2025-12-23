<div class="table-responsive">
    <table class="table align-middle">
        <thead class="table-light">
            <tr>
                <th>{{ __('dashboard.short_url') }}</th>
                <th>{{ __('dashboard.original_url') }}</th>
                <th>{{ __('dashboard.clicks') }}</th>
                <th>{{ __('dashboard.status') }}</th>
                <th class="text-end">{{ __('dashboard.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($urls as $url)
                <tr>
                    <td>
                        <a href="{{ $url->short_url }}" target="_blank">
                            {{ $url->short_url }}
                        </a>
                    </td>
                    <td class="text-truncate" style="max-width:250px">
                        {{ $url->url }}
                    </td>
                    <td>{{ $url->clicks }}</td>
                    <td>
                        <span class="badge {{ $url->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $url->status ? __('dashboard.active') : __('dashboard.inactive') }}
                        </span>
                    </td>
                    <td class="text-end">
                        ...
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Sonuç bulunamadı
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
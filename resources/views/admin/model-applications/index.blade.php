@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Model Registrations</h2>
    <div class="d-flex align-items-center gap-3">
        <form method="GET" action="{{ route('admin.model-applications.index') }}" class="d-flex gap-2 align-items-center" id="search-form">
            <div class="input-group input-group-sm">
                <span class="input-group-text">From</span>
                <input type="date" name="start_date" id="start-date-input" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">To</span>
                <input type="date" name="end_date" id="end-date-input" class="form-control" value="{{ request('end_date') }}">
            </div>
            <input type="text" name="search" id="search-input" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fas fa-search"></i></button>
            @if(request()->hasAny(['search', 'start_date', 'end_date']))
                <a href="{{ route('admin.model-applications.index') }}" class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></a>
            @endif
        </form>
        <div class="btn-group">
            <a href="{{ route('admin.export', ['resource' => 'model-applications', 'format' => 'excel'] + request()->query()) }}" id="export-excel" class="btn btn-outline-success" title="Export to Excel">
                <i class="fas fa-file-excel"></i>
            </a>
            <a href="{{ route('admin.export', ['resource' => 'model-applications', 'format' => 'pdf'] + request()->query()) }}" id="export-pdf" class="btn btn-outline-danger" title="Export to PDF">
                <i class="fas fa-file-pdf"></i>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" id="select-all-checkbox" class="form-check-input">
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Age</th>
                        <th>Referral</th>
                        <th>Status</th>
                        <th>Applied On</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @forelse($applications as $app)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input row-checkbox" value="{{ $app->id }}">
                        </td>
                        <td class="align-middle fw-bold">{{ $app->full_name }}</td>
                        <td class="align-middle">{{ $app->email }}</td>
                        <td class="align-middle">{{ ucfirst($app->country) }}</td>
                        <td class="align-middle">{{ $app->age }}</td>
                        <td class="align-middle">{{ $app->affiliate_code ?? 'None' }}</td>
                        <td class="align-middle">
                            <span class="badge bg-{{ $app->status === 'pending' ? 'warning' : ($app->status === 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>
                        <td class="align-middle">{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="align-middle text-end">
                            <a href="{{ route('admin.model-applications.show', $app) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.model-applications.destroy', $app) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this application?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No model registrations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $applications->appends(request()->query())->links() }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const tableBody = document.getElementById('table-body');
        const searchForm = document.getElementById('search-form');
        let timer;

        function fetchResults() {
            const url = new URL(searchForm.action);
            const params = new URLSearchParams();

            if (searchInput.value) params.set('search', searchInput.value);
            
            const startDate = document.getElementById('start-date-input').value;
            const endDate = document.getElementById('end-date-input').value;
            if (startDate) params.set('start_date', startDate);
            if (endDate) params.set('end_date', endDate);

            // Update main URL for table fetch
            params.forEach((value, key) => url.searchParams.set(key, value));

            // Update Export URLs
            const excelBtn = document.getElementById('export-excel');
            const pdfBtn = document.getElementById('export-pdf');
            
            if (excelBtn) {
                const excelUrl = new URL(excelBtn.href.split('?')[0]);
                excelUrl.searchParams.set('resource', 'model-applications');
                excelUrl.searchParams.set('format', 'excel');
                params.forEach((value, key) => excelUrl.searchParams.set(key, value));
                excelBtn.href = excelUrl.toString();
            }
            
            if (pdfBtn) {
                const pdfUrl = new URL(pdfBtn.href.split('?')[0]);
                pdfUrl.searchParams.set('resource', 'model-applications');
                pdfUrl.searchParams.set('format', 'pdf');
                params.forEach((value, key) => pdfUrl.searchParams.set(key, value));
                pdfBtn.href = pdfUrl.toString();
            }

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTableBody = doc.getElementById('table-body');
                    if (newTableBody) {
                        tableBody.innerHTML = newTableBody.innerHTML;
                    }
                })
                .catch(error => console.error('Error fetching search results:', error));
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(timer);
            timer = setTimeout(fetchResults, 300);
        });

        document.getElementById('start-date-input').addEventListener('change', fetchResults);
        document.getElementById('end-date-input').addEventListener('change', fetchResults);
    });
</script>
@endsection

@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Services</h2>
    <div class="d-flex align-items-center gap-3">
        <form method="GET" action="{{ route('admin.services.index') }}" class="d-flex gap-2 align-items-center" id="search-form">
            <div class="input-group input-group-sm">
                <span class="input-group-text">From</span>
                <input type="date" name="start_date" id="start-date-input" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">To</span>
                <input type="date" name="end_date" id="end-date-input" class="form-control" value="{{ request('end_date') }}">
            </div>
            <input type="text" name="search" id="search-input" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
            <select name="status" id="status-select" class="form-select form-select-sm">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fas fa-search"></i></button>
            @if(request()->hasAny(['search', 'status', 'start_date', 'end_date']))
                <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></a>
            @endif
        </form>
        <div class="btn-group">
            <a href="{{ route('admin.export', ['resource' => 'services', 'format' => 'excel'] + request()->query()) }}" id="export-excel" class="btn btn-outline-success" title="Export Excel">
                <i class="fas fa-file-excel"></i>
            </a>
            <a href="{{ route('admin.export', ['resource' => 'services', 'format' => 'pdf'] + request()->query()) }}" id="export-pdf" class="btn btn-outline-danger" title="Export PDF">
                <i class="fas fa-file-pdf"></i>
            </a>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-dark text-nowrap"><i class="fas fa-plus"></i> Add New</a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width: 40px;">
                        <input type="checkbox" id="select-all-checkbox" class="form-check-input">
                    </th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Summary</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @forelse($services as $service)
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input row-checkbox" value="{{ $service->id }}">
                    </td>
                    <td>
                        @if($service->image)
                            <img src="{{ Storage::url($service->image) }}" width="60" class="img-thumbnail" alt="{{ $service->title }}">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td class="align-middle fw-bold">{{ $service->title }}</td>
                    <td class="align-middle text-truncate" style="max-width: 300px;">{{ $service->summary }}</td>
                    <td class="align-middle">
                        <form action="{{ route('admin.services.toggle-status', $service) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $service->is_active ? 'btn-success' : 'btn-secondary' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No services found. Add one to get started!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const statusSelect = document.getElementById('status-select');
        const tableBody = document.getElementById('table-body');
        const searchForm = document.getElementById('search-form');
        let timer;

        function fetchResults() {
            const url = new URL(searchForm.action);
            const params = new URLSearchParams();

            if (searchInput.value) params.set('search', searchInput.value);
            if (statusSelect.value) params.set('status', statusSelect.value);
            
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
                excelUrl.searchParams.set('resource', 'services');
                excelUrl.searchParams.set('format', 'excel');
                params.forEach((value, key) => excelUrl.searchParams.set(key, value));
                excelBtn.href = excelUrl.toString();
            }
            
            if (pdfBtn) {
                const pdfUrl = new URL(pdfBtn.href.split('?')[0]);
                pdfUrl.searchParams.set('resource', 'services');
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
            timer = setTimeout(fetchResults, 300); // 300ms debounce
        });

        statusSelect.addEventListener('change', fetchResults);
        document.getElementById('start-date-input').addEventListener('change', fetchResults);
        document.getElementById('end-date-input').addEventListener('change', fetchResults);
    });
</script>
@endsection

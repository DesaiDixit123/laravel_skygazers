@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Contact Messages</h3>
    <div class="btn-group">
        <a href="{{ route('admin.export', ['resource' => 'contact-messages', 'format' => 'excel'] + request()->query()) }}" id="export-excel" class="btn btn-outline-success">
            <i class="fas fa-file-excel me-1"></i> Excel
        </a>
        <a href="{{ route('admin.export', ['resource' => 'contact-messages', 'format' => 'pdf'] + request()->query()) }}" id="export-pdf" class="btn btn-outline-danger">
            <i class="fas fa-file-pdf me-1"></i> PDF
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="p-3 border-bottom bg-light">
            <form action="{{ route('admin.messages.index') }}" method="GET" class="row g-2" id="search-form">
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" id="search-input" class="form-control border-start-0 ps-0" placeholder="Search..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">From</span>
                        <input type="date" name="start_date" id="start-date-input" class="form-control" value="{{ request('start_date') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">To</span>
                        <input type="date" name="end_date" id="end-date-input" class="form-control" value="{{ request('end_date') }}">
                    </div>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 40px;" class="ps-3">
                            <input type="checkbox" id="select-all-checkbox" class="form-check-input">
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message Preview</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody id="messages-table-body">
                    @forelse($messages as $msg)
                        <tr class="{{ $msg->is_read ? 'text-muted' : 'fw-bold' }}">
                            <td class="ps-3">
                                <input type="checkbox" class="form-check-input row-checkbox" value="{{ $msg->id }}">
                            </td>
                            <td>{{ $msg->first_name }} {{ $msg->last_name }}</td>
                            <td>{{ $msg->email }}</td>
                            <td>{{ $msg->phone ?? 'N/A' }}</td>
                            <td>{{ Str::limit($msg->message, 50) }}</td>
                            <td>
                                @if($msg->is_read)
                                    <span class="badge bg-light text-dark border">Read</span>
                                @else
                                    <span class="badge bg-primary">New</span>
                                @endif
                            </td>
                            <td>{{ $msg->created_at->format('M d, Y h:i A') }}</td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-outline-dark" title="View Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                No messages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($messages->hasPages())
            <div class="p-3 border-top">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const startDateInput = document.getElementById('start-date-input');
        const endDateInput = document.getElementById('end-date-input');
        const tableBody = document.getElementById('messages-table-body');
        const searchForm = document.getElementById('search-form');
        let timer;

        function fetchResults() {
            const url = new URL(searchForm.action);
            const params = new URLSearchParams();

            if (searchInput.value) params.set('search', searchInput.value);
            if (startDateInput.value) params.set('start_date', startDateInput.value);
            if (endDateInput.value) params.set('end_date', endDateInput.value);

            // Update main URL for table fetch
            params.forEach((value, key) => url.searchParams.set(key, value));

            // Update Export URLs
            const excelBtn = document.getElementById('export-excel');
            const pdfBtn = document.getElementById('export-pdf');
            
            if (excelBtn) {
                const excelUrl = new URL(excelBtn.href.split('?')[0]);
                excelUrl.searchParams.set('resource', 'contact-messages');
                excelUrl.searchParams.set('format', 'excel');
                params.forEach((value, key) => excelUrl.searchParams.set(key, value));
                excelBtn.href = excelUrl.toString();
            }
            
            if (pdfBtn) {
                const pdfUrl = new URL(pdfBtn.href.split('?')[0]);
                pdfUrl.searchParams.set('resource', 'contact-messages');
                pdfUrl.searchParams.set('format', 'pdf');
                params.forEach((value, key) => pdfUrl.searchParams.set(key, value));
                pdfBtn.href = pdfUrl.toString();
            }

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTableBody = doc.getElementById('messages-table-body');
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

        startDateInput.addEventListener('change', fetchResults);
        endDateInput.addEventListener('change', fetchResults);
    });
</script>
@endsection

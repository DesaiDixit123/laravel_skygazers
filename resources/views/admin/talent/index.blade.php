@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Talent</h2>
    <div class="d-flex align-items-center gap-3">
        <form method="GET" action="{{ route('admin.talent.index') }}" class="d-flex gap-2" id="search-form">
            <input type="text" name="search" id="search-input" class="form-control" placeholder="Search..." value="{{ request('search') }}">
            <select name="status" id="status-select" class="form-select">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
            @if(request()->has('search') || request()->has('status'))
                <a href="{{ route('admin.talent.index') }}" class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
            @endif
        </form>
        <a href="{{ route('admin.talent.create') }}" class="btn btn-dark text-nowrap"><i class="fas fa-plus"></i> Add New Talent</a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Label</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @forelse($talents as $talent)
                <tr>
                    <td>
                        @if($talent->image)
                            <img src="{{ Storage::url($talent->image) }}" width="60" class="img-thumbnail" alt="{{ $talent->name }}">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td class="align-middle fw-bold">{{ $talent->name }}</td>
                    <td class="align-middle"><span class="badge bg-secondary">{{ ucfirst($talent->category) }}</span></td>
                    <td class="align-middle">{{ $talent->label }}</td>
                    <td class="align-middle">
                        <form action="{{ route('admin.talent.toggle-status', $talent) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $talent->is_active ? 'btn-success' : 'btn-secondary' }}">
                                {{ $talent->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.talent.edit', $talent) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.talent.destroy', $talent) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this talent?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No talent found. Add one to get started!</td>
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
            if (searchInput.value) url.searchParams.set('search', searchInput.value);
            if (statusSelect.value) url.searchParams.set('status', statusSelect.value);

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

        statusSelect.addEventListener('change', function() {
            fetchResults();
        });
    });
</script>
@endsection

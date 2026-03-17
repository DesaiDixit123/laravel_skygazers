@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Talent Categories</h2>
    <div class="d-flex align-items-center gap-3">
        <form method="GET" action="{{ route('admin.talent-categories.index') }}" class="d-flex gap-2" id="search-form">
            <input type="text" name="search" id="search-input" class="form-control" placeholder="Search..." value="{{ request('search') }}">
            <select name="status" id="status-select" class="form-select">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
            @if(request()->has('search') || request()->has('status'))
                <a href="{{ route('admin.talent-categories.index') }}" class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
            @endif
        </form>
        <a href="{{ route('admin.talent-categories.create') }}" class="btn btn-dark text-nowrap"><i class="fas fa-plus"></i> Add New Category</a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @forelse($categories as $category)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle fw-bold">{{ $category->name }}</td>
                    <td class="align-middle"><span class="badge bg-secondary">{{ $category->slug }}</span></td>
                    <td class="align-middle">
                        <form action="{{ route('admin.talent-categories.toggle-status', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $category->is_active ? 'btn-success' : 'btn-secondary' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.talent-categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.talent-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No categories found. Add one to get started!</td>
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

@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Contact Messages</h3>
    <div class="btn-group">
        <a href="{{ route('admin.export', ['resource' => 'contact-messages', 'format' => 'excel'] + request()->query()) }}" class="btn btn-outline-success">
            <i class="fas fa-file-excel me-1"></i> Excel
        </a>
        <a href="{{ route('admin.export', ['resource' => 'contact-messages', 'format' => 'pdf'] + request()->query()) }}" class="btn btn-outline-danger">
            <i class="fas fa-file-pdf me-1"></i> PDF
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="p-3 border-bottom bg-light">
            <form action="{{ route('admin.messages.index') }}" method="GET" class="row g-2" id="search-form">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by name, email, phone..." value="{{ request('search') }}" onkeyup="debounceSearch()">
                    </div>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Name</th>
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
                            <td class="ps-3">{{ $msg->first_name }} {{ $msg->last_name }}</td>
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
                            <td colspan="7" class="text-center py-5 text-muted">
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
let searchTimer;
function debounceSearch() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        document.getElementById('search-form').submit();
    }, 500);
}
</script>
@endsection

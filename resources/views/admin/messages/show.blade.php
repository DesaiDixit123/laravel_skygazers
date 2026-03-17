@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Messages</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Message from {{ $message->first_name }} {{ $message->last_name }}</h5>
        <span class="small">{{ $message->created_at->format('M d, Y h:i A') }}</span>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-4">
                <label class="text-muted small text-uppercase fw-bold">Email</label>
                <div class="fs-5"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
            </div>
            <div class="col-md-4">
                <label class="text-muted small text-uppercase fw-bold">Phone</label>
                <div class="fs-5">{{ $message->phone ?? 'Not provided' }}</div>
            </div>
            <div class="col-md-4">
                <label class="text-muted small text-uppercase fw-bold">Status</label>
                <div>
                    @if($message->is_read)
                        <span class="badge bg-success">Opened/Read</span>
                    @else
                        <span class="badge bg-primary">Recently Received</span>
                    @endif
                </div>
            </div>
        </div>

        <hr>

        <div class="message-content p-4 bg-light rounded">
            <label class="text-muted small text-uppercase fw-bold d-block mb-3">Message Body</label>
            <div style="white-space: pre-wrap; line-height: 1.6;">{{ $message->message }}</div>
        </div>

        <div class="mt-4 text-end">
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-4">Delete Message</button>
            </form>
        </div>
    </div>
</div>
@endsection

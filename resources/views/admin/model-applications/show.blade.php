@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.model-applications.index') }}" class="btn btn-outline-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to List</a>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Application Details: {{ $application->full_name }}</h2>
        <form action="{{ route('admin.model-applications.destroy', $application) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete Application</button>
        </form>
    </div>
</div>

@if($application->photos && count($application->photos) > 0)
<div class="card mb-4">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <span>Application Photos</span>
        <span class="badge bg-secondary">{{ count($application->photos) }} Photos Uploaded</span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach($application->photos as $photo)
            <div class="col-md-3">
                <div class="border rounded overflow-hidden shadow-sm h-100">
                    <a href="{{ Storage::url($photo) }}" target="_blank">
                        <img src="{{ Storage::url($photo) }}" class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Application Photo">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">Basic Information</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Full Name</th>
                        <td>{{ $application->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><a href="mailto:{{ $application->email }}">{{ $application->email }}</a></td>
                    </tr>
                    <tr>
                        <th>Age / Gender</th>
                        <td>{{ $application->age }} / {{ ucfirst($application->gender) }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>{{ ucfirst($application->country) }}</td>
                    </tr>
                    <tr>
                        <th>Applied On</th>
                        <td>{{ $application->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">Measurements</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Height</th>
                        <td>{{ $application->height }}</td>
                    </tr>
                    <tr>
                        <th>Measurements</th>
                        <td>{{ $application->measurements }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">Contact & Social</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">WhatsApp Number</th>
                        <td><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $application->whatsapp_number) }}" target="_blank">{{ $application->whatsapp_number }}</a></td>
                    </tr>
                    <tr>
                        <th>Instagram</th>
                        <td><a href="{{ str_contains($application->instagram, 'http') ? $application->instagram : 'https://instagram.com/' . $application->instagram }}" target="_blank">{{ $application->instagram }}</a></td>
                    </tr>
                    <tr>
                        <th>Telegram</th>
                        <td><a href="{{ str_contains($application->telegram, 'http') ? $application->telegram : 'https://t.me/' . str_replace('@', '', $application->telegram) }}" target="_blank">{{ $application->telegram }}</a></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">Other Information</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Referral</th>
                        <td>{{ $application->affiliate_code ?? 'None' }}</td>
                    </tr>
                    <tr>
                        <th>Application Status</th>
                        <td>
                            <span class="badge bg-{{ $application->status === 'pending' ? 'warning' : ($application->status === 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

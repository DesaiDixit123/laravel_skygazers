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
        @php
            $photoUrls = collect($application->photos)->map(fn($photo) => Storage::url($photo))->toArray();
        @endphp
        <div class="row g-3">
            @foreach($application->photos as $index => $photo)
            <div class="col-md-3">
                <div class="border rounded overflow-hidden shadow-sm h-100 cursor-pointer" onclick="openImageModal({{ $index }})">
                    <img src="{{ Storage::url($photo) }}" class="img-fluid w-100" style="height: 250px; object-fit: cover; cursor: pointer;" alt="Application Photo">
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

@push('styles')
<style>
    .cursor-pointer { cursor: pointer; }
    .cursor-pointer:hover { opacity: 0.9; }
</style>
@endpush

@push('scripts')
<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 text-center position-relative">
                <button id="prevBtn" class="btn btn-link text-white position-absolute top-50 start-0 translate-middle-y fs-1" style="z-index: 1060; left: -50px !important;" onclick="prevImage()"><i class="fas fa-chevron-left"></i></button>
                <img src="" id="modalImage" class="img-fluid rounded shadow-lg" style="max-height: 90vh;">
                <button id="nextBtn" class="btn btn-link text-white position-absolute top-50 end-0 translate-middle-y fs-1" style="z-index: 1060; right: -50px !important;" onclick="nextImage()"><i class="fas fa-chevron-right"></i></button>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1060;"></button>
            </div>
        </div>
    </div>
</div>

<script>
    const photoUrls = @json($photoUrls);
    let currentImageIndex = 0;
    let imageModal;

    function openImageModal(index) {
        currentImageIndex = index;
        updateModalImage();
        if (!imageModal) {
            imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        }
        imageModal.show();
    }

    function updateModalImage() {
        document.getElementById('modalImage').src = photoUrls[currentImageIndex];
        
        // Toggle visibility of navigation buttons
        document.getElementById('prevBtn').style.visibility = currentImageIndex === 0 ? 'hidden' : 'visible';
        document.getElementById('nextBtn').style.visibility = currentImageIndex === photoUrls.length - 1 ? 'hidden' : 'visible';
    }

    function nextImage() {
        if (currentImageIndex < photoUrls.length - 1) {
            currentImageIndex++;
            updateModalImage();
        }
    }

    function prevImage() {
        if (currentImageIndex > 0) {
            currentImageIndex--;
            updateModalImage();
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(event) {
        const modal = document.getElementById('imageModal');
        if (modal.classList.contains('show')) {
            if (event.key === 'ArrowRight') {
                nextImage();
            } else if (event.key === 'ArrowLeft') {
                prevImage();
            }
        }
    });
</script>
@endpush

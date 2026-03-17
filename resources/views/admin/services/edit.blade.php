@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Services</a>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Edit Service: {{ $service->title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $service->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="summary" class="form-label">Summary</label>
                        <textarea class="form-control" id="summary" name="summary" rows="2">{{ old('summary', $service->summary) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control rich-editor" id="description" name="description" rows="4">{{ old('description', $service->description) }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="benefits" class="form-label">Benefits (one per line)</label>
                        <textarea class="form-control" id="benefits" name="benefits" rows="4">{{ old('benefits', implode("\n", $service->benefits ?? [])) }}</textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Service Image</label>
                        @if($service->image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($service->image) }}" class="img-fluid rounded" alt="Current Image">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">Leave blank to keep current image.</div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-dark px-4">Update Service</button>
            </div>
        </form>
    </div>
</div>
@endsection

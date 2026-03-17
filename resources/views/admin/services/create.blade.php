@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Services</a>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Add New Service</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="summary" class="form-label">Summary</label>
                        <textarea class="form-control" id="summary" name="summary" rows="2">{{ old('summary') }}</textarea>
                        <div class="form-text">A short sentence displayed on the service card.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control rich-editor" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        <div class="form-text">Detailed description for the service details page.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="benefits" class="form-label">Benefits (one per line)</label>
                        <textarea class="form-control" id="benefits" name="benefits" rows="4">{{ old('benefits') }}</textarea>
                        <div class="form-text">List of features/benefits, one per line.</div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Service Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">Recommended size: 800x600 pixels.</div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-dark px-4">Save Service</button>
            </div>
        </form>
    </div>
</div>
@endsection

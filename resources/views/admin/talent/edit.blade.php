@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.talent.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Talent</a>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Edit Talent: {{ $talent->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.talent.update', $talent) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $talent->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <select class="form-select" id="category" name="category" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ old('category', $talent->category) == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted"><a href="{{ route('admin.talent-categories.create') }}">Manage Categories</a></small>
                    </div>

                    <div class="mb-3">
                        <label for="label" class="form-label">Label (Optional)</label>
                        <input type="text" class="form-control" id="label" name="label" value="{{ old('label', $talent->label) }}">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" class="form-control" id="height" name="height" value="{{ old('height', $talent->height) }}" placeholder="e.g. 5'7\"">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="bust" class="form-label">Bust</label>
                            <input type="text" class="form-control" id="bust" name="bust" value="{{ old('bust', $talent->bust) }}" placeholder="e.g. 33\"">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="waist" class="form-label">Waist</label>
                            <input type="text" class="form-control" id="waist" name="waist" value="{{ old('waist', $talent->waist) }}" placeholder="e.g. 26\"">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="hips" class="form-label">Hips</label>
                            <input type="text" class="form-control" id="hips" name="hips" value="{{ old('hips', $talent->hips) }}" placeholder="e.g. 38\"">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="shoe_size" class="form-label">Shoe Size</label>
                            <input type="text" class="form-control" id="shoe_size" name="shoe_size" value="{{ old('shoe_size', $talent->shoe_size) }}" placeholder="e.g. 39">
                        </div>
                    </div>
                </div>
                
                    <div class="mb-3">
                        <label for="image" class="form-label">Main Profile Image</label>
                        <div id="new-main-image-preview" class="mb-2 d-none">
                            <div class="position-relative d-inline-block">
                                <img src="" class="img-fluid rounded shadow-sm" style="max-width: 200px; max-height: 250px; object-fit: cover; border: 2px solid #28a745;">
                                <div class="position-absolute top-0 start-0 bg-success text-white px-1 small rounded-bottom-end">NEW</div>
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-1 lh-1" onclick="clearNewMainImage()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @if($talent->image)
                            <div id="current-main-image" class="mb-3">
                                <img src="{{ Storage::url($talent->image) }}" class="img-fluid rounded shadow-sm" style="max-width: 200px; border: 1px solid #ddd;" alt="Current Image">
                                <div class="form-text">Current Profile Image</div>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewNewMainImage(this)">
                        <div class="form-text">Leave blank to keep current image.</div>
                    </div>

                    <div class="mb-3">
                        <label for="gallery" class="form-label">Add New Gallery Images</label>
                        <div id="new-gallery-preview" class="row g-2 mb-2"></div>
                        <input type="file" class="form-control" id="gallery" name="gallery[]" accept="image/*" multiple onchange="previewNewGalleryImages(this)">
                        <div class="form-text">Newly selected images will appear here first.</div>
                    </div>
            </div>

            <div class="mt-4">
                <h6>Current Gallery</h6>
                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3" id="talent-gallery">
                    @forelse($talent->images as $img)
                        <div class="col gallery-item-container" id="gallery-image-{{ $img->id }}">
                            <div class="card h-100 shadow-sm border-0 position-relative">
                                <img src="{{ Storage::url($img->image_path) }}" class="card-img-top rounded" style="height: 150px; object-fit: cover;" alt="Gallery Image">
                                <div class="card-img-overlay d-flex align-items-start justify-content-end p-1">
                                    <button type="button" class="btn btn-danger btn-sm rounded-circle p-1 lh-1 delete-gallery-img" data-id="{{ $img->id }}" onclick="deleteGalleryImage({{ $img->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-muted">No gallery images uploaded yet.</div>
                    @endforelse
                </div>
            </div>

            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-dark px-4">Update Talent</button>
            </div>
        </form>
    </div>
</div>

<script>
    let newGalleryFiles = new DataTransfer();

    function previewNewMainImage(input) {
        const preview = document.getElementById('new-main-image-preview');
        const current = document.getElementById('current-main-image');
        const img = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('d-none');
                if (current) current.classList.add('opacity-50');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearNewMainImage() {
        const input = document.getElementById('image');
        const preview = document.getElementById('new-main-image-preview');
        const current = document.getElementById('current-main-image');
        input.value = '';
        preview.classList.add('d-none');
        if (current) current.classList.remove('opacity-50');
    }

    function previewNewGalleryImages(input) {
        Array.from(input.files).forEach(file => {
            newGalleryFiles.items.add(file);
        });
        input.files = newGalleryFiles.files;
        renderNewGalleryPreviews();
    }

    function renderNewGalleryPreviews() {
        const container = document.getElementById('new-gallery-preview');
        container.innerHTML = '';

        Array.from(newGalleryFiles.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4 col-md-6';
                col.innerHTML = `
                    <div class="position-relative shadow-sm rounded overflow-hidden border border-success" style="height: 80px;">
                        <img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">
                        <div class="position-absolute top-0 start-0 bg-success text-white px-1 extra-small rounded-bottom-end" style="font-size: 10px;">NEW</div>
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-1 lh-1" style="font-size: 10px;" onclick="removeNewGalleryFile(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                container.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }

    function removeNewGalleryFile(index) {
        const input = document.getElementById('gallery');
        const newDataTransfer = new DataTransfer();
        const files = Array.from(newGalleryFiles.files);
        
        files.splice(index, 1);
        files.forEach(file => newDataTransfer.items.add(file));
        
        newGalleryFiles = newDataTransfer;
        input.files = newGalleryFiles.files;
        renderNewGalleryPreviews();
    }

    function deleteGalleryImage(id) {
        if (confirm('Are you sure you want to PERMANENTLY remove this image from the server gallery?')) {
            fetch(`/admin/talent/image/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const element = document.getElementById(`gallery-image-${id}`);
                    element.remove();
                    if (document.querySelectorAll('.gallery-item-container').length === 0) {
                        document.getElementById('talent-gallery').innerHTML = '<div class="col-12 text-muted">No gallery images uploaded yet.</div>';
                    }
                } else {
                    alert('Error deleting image.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong.');
            });
        }
    }
</script>
@endsection

@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.talent.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Talent</a>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Add New Talent</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.talent.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ old('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted"><a href="{{ route('admin.talent-categories.create') }}">Manage Categories</a></small>
                    </div>

                    <div class="mb-3">
                        <label for="label" class="form-label">Label (Optional)</label>
                        <input type="text" class="form-control" id="label" name="label" value="{{ old('label') }}">
                        <div class="form-text">Example: 'Fashion Creator' or 'Lifestyle'</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" class="form-control" id="height" name="height" value="{{ old('height') }}" placeholder="e.g. 5'7\"">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="bust" class="form-label">Bust</label>
                            <input type="text" class="form-control" id="bust" name="bust" value="{{ old('bust') }}" placeholder="e.g. 33\"">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="waist" class="form-label">Waist</label>
                            <input type="text" class="form-control" id="waist" name="waist" value="{{ old('waist') }}" placeholder="e.g. 26\"">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="hips" class="form-label">Hips</label>
                            <input type="text" class="form-control" id="hips" name="hips" value="{{ old('hips') }}" placeholder="e.g. 38\"">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="shoe_size" class="form-label">Shoe Size</label>
                            <input type="text" class="form-control" id="shoe_size" name="shoe_size" value="{{ old('shoe_size') }}" placeholder="e.g. 39">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Main Profile Image</label>
                        <div id="main-image-preview" class="mb-2 d-none">
                            <div class="position-relative d-inline-block">
                                <img src="" class="img-fluid rounded shadow-sm" style="max-width: 200px; max-height: 250px; object-fit: cover;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-1 lh-1" onclick="clearMainImage()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewMainImage(this)">
                        <div class="form-text">Recommended proportion: 4:5 portrait.</div>
                    </div>

                    <div class="mb-3">
                        <label for="gallery" class="form-label">Gallery Images</label>
                        <div id="gallery-preview" class="row g-2 mb-2"></div>
                        <input type="file" class="form-control" id="gallery" name="gallery[]" accept="image/*" multiple onchange="previewGalleryImages(this)">
                        <div class="form-text">You can select multiple images. Click 'X' to remove before saving.</div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-dark px-4">Save Talent</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    let galleryFiles = new DataTransfer();

    function previewMainImage(input) {
        const preview = document.getElementById('main-image-preview');
        const img = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearMainImage() {
        const input = document.getElementById('image');
        const preview = document.getElementById('main-image-preview');
        input.value = '';
        preview.classList.add('d-none');
    }

    function previewGalleryImages(input) {
        const previewContainer = document.getElementById('gallery-preview');
        
        // Add new files to our DataTransfer object
        Array.from(input.files).forEach(file => {
            galleryFiles.items.add(file);
        });

        // Update the input with the consolidated file list
        input.files = galleryFiles.files;

        renderGalleryPreviews();
    }

    function renderGalleryPreviews() {
        const previewContainer = document.getElementById('gallery-preview');
        previewContainer.innerHTML = '';

        Array.from(galleryFiles.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4 col-md-3';
                col.innerHTML = `
                    <div class="position-relative h-100 shadow-sm rounded overflow-hidden">
                        <img src="${e.target.result}" style="width:100%; height:100px; object-fit:cover;">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-1 lh-1" onclick="removeGalleryFile(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                previewContainer.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }

    function removeGalleryFile(index) {
        const input = document.getElementById('gallery');
        const newDataTransfer = new DataTransfer();
        const files = Array.from(galleryFiles.files);
        
        files.splice(index, 1);
        files.forEach(file => newDataTransfer.items.add(file));
        
        galleryFiles = newDataTransfer;
        input.files = galleryFiles.files;
        renderGalleryPreviews();
    }
</script>
@endsection

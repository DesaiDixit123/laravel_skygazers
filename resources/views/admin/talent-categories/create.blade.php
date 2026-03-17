@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Category</h2>
    <a href="{{ route('admin.talent-categories.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.talent-categories.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Category Name *</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                <small class="text-muted">Slug will be auto-generated from the name.</small>
            </div>

            <button type="submit" class="btn btn-primary">Save Category</button>
        </form>
    </div>
</div>
@endsection

@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Country</h2>
    <a href="{{ route('admin.talent-countries.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
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

        <form action="{{ route('admin.talent-countries.update', $talentCountry) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Country Name *</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $talentCountry->name) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Country</button>
        </form>
    </div>
</div>
@endsection

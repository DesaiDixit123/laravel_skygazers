@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Talent Network Settings</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.talent-settings.update') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="creators_count" class="form-label">How Much Creators</label>
                <input type="text" class="form-control" id="creators_count" name="creators_count" value="{{ $creatorsCount ?? '500+' }}" required>
                <small class="text-muted">Example: 500+</small>
            </div>
            
            <div class="mb-3">
                <label for="campaigns_count" class="form-label">How Much Brand Campaigns</label>
                <input type="text" class="form-control" id="campaigns_count" name="campaigns_count" value="{{ $campaignsCount ?? '250+' }}" required>
                <small class="text-muted">Example: 250+</small>
            </div>

            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>
@endsection

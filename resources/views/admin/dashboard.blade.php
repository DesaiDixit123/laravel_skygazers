@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold mb-0">Analytics Dashboard</h2>
        <p class="text-muted">Welcome back! Here's what's happening today.</p>
    </div>
    <div class="text-end text-muted small">
        <i class="fas fa-calendar-alt me-1"></i> {{ now()->format('M d, Y') }}
    </div>
</div>

<div class="row g-4 mb-5">
    <!-- Services Card -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="background: linear-gradient(45deg, #4158D0, #C850C0);">
            <div class="card-body p-4 position-relative">
                <i class="fas fa-concierge-bell position-absolute opacity-25" style="font-size: 80px; bottom: -10px; right: -10px;"></i>
                <div class="position-relative z-1">
                    <h6 class="text-white text-uppercase fw-bold opacity-75 small mb-1">Total Services</h6>
                    <h2 class="text-white display-5 mb-3">{{ $counts['services'] }}</h2>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-light bg-white border-0 text-primary fw-bold px-3">View Details</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Talent Card -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="background: linear-gradient(45deg, #00DBDE, #FC00FF);">
            <div class="card-body p-4 position-relative">
                <i class="fas fa-star position-absolute opacity-25" style="font-size: 80px; bottom: -10px; right: -10px;"></i>
                <div class="position-relative z-1">
                    <h6 class="text-white text-uppercase fw-bold opacity-75 small mb-1">Active Talent</h6>
                    <h2 class="text-white display-5 mb-3">{{ $counts['talent'] }}</h2>
                    <a href="{{ route('admin.talent.index') }}" class="btn btn-sm btn-light bg-white border-0 text-info fw-bold px-3">Manage Talent</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Card -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="background: linear-gradient(45deg, #FBAB7E, #F7CE68);">
            <div class="card-body p-4 position-relative">
                <i class="fas fa-envelope position-absolute opacity-25" style="font-size: 80px; bottom: -10px; right: -10px;"></i>
                <div class="position-relative z-1">
                    <h6 class="text-white text-uppercase fw-bold opacity-75 small mb-1">New Messages</h6>
                    <h2 class="text-white display-5 mb-3">{{ $counts['messages'] }}</h2>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-light bg-white border-0 text-warning fw-bold px-3">Check Inbox</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications Card -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="background: linear-gradient(45deg, #85FFBD, #FFFB7D);">
            <div class="card-body p-4 position-relative">
                <i class="fas fa-user-plus position-absolute opacity-25" style="font-size: 80px; bottom: -10px; right: -10px;"></i>
                <div class="position-relative z-1">
                    <h6 class="text-dark text-uppercase fw-bold opacity-75 small mb-1">Registrations</h6>
                    <h2 class="text-dark display-5 mb-3">{{ $counts['applications'] }}</h2>
                    <a href="{{ route('admin.model-applications.index') }}" class="btn btn-sm btn-dark border-0 text-white fw-bold px-3">Review Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold">Platform Growth Trends</h5>
            </div>
            <div class="card-body p-4">
                <canvas id="growthChart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold">Engagement Share</h5>
            </div>
            <div class="card-body p-4 d-flex align-items-center">
                <canvas id="engagementChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const labels = {!! json_encode($labels) !!};
        const registrationData = {!! json_encode($registrationStats) !!};
        const messageData = {!! json_encode($messageStats) !!};

        // Platform Growth Line Chart
        const growthCtx = document.getElementById('growthChart').getContext('2d');
        new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Model Applications',
                        data: registrationData,
                        borderColor: '#C850C0',
                        backgroundColor: 'rgba(200, 80, 192, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#C850C0',
                        pointRadius: 4
                    },
                    {
                        label: 'Contact Messages',
                        data: messageData,
                        borderColor: '#4158D0',
                        backgroundColor: 'rgba(65, 88, 208, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#4158D0',
                        pointRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Engagement Share Pie Chart
        const engagementCtx = document.getElementById('engagementChart').getContext('2d');
        new Chart(engagementCtx, {
            type: 'doughnut',
            data: {
                labels: ['Applications', 'Messages'],
                datasets: [{
                    data: [{{ $counts['applications'] }}, {{ $counts['messages'] }}],
                    backgroundColor: [
                        '#85FFBD',
                        '#FBAB7E'
                    ],
                    borderWidth: 0,
                    weight: 0.5
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
@endsection

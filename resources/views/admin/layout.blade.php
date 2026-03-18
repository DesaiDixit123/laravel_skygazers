<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_skygazers.png') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; margin: 0; }
        .sidebar { 
            min-height: 100vh; 
            background-color: #343a40; 
            color: white; 
            width: 260px;
            transition: all 0.3s ease;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 12px 20px; display: block; border-radius: 4px; margin-bottom: 5px; transition: all 0.3s; }
        .sidebar .submenu a { padding-left: 50px; font-size: 0.9em; margin-bottom: 2px; }
        .sidebar ul { padding: 0; list-style: none; margin: 0; }
        .dropdown-toggle::after { float: right; margin-top: 8px; }
        .sidebar a:hover, .sidebar a.active { background-color: #495057; color: white; }
        
        .main-wrapper {
            margin-left: 260px;
            transition: all 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content { padding: 25px; flex-grow: 1; }
        .navbar-top { 
            background-color: white; 
            border-bottom: 1px solid #e9ecef; 
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .admin-logo-wrapper {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 20px;
        }

        .admin-logo {
            width: 140px;
            height: auto;
            filter: brightness(0) invert(1);
        }

        #sidebar-toggle {
            display: none;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 4px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-wrapper {
                margin-left: 0;
            }
            #sidebar-toggle {
                display: block;
            }
            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <div class="d-flex w-100">
        <!-- Sidebar -->
        <div class="sidebar p-3" id="admin-sidebar">
            <div class="admin-logo-wrapper">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('images/logo_skygazers.png') }}" alt="Sky Gazers Studio" class="admin-logo">
                </a>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-home me-2"></i> Dashboard</a>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}"><i class="fas fa-concierge-bell me-2"></i> Services</a>
            
            @php 
                $talentActive = request()->routeIs('admin.talent.*') || request()->routeIs('admin.talent-settings.*') || request()->routeIs('admin.talent-countries.*') || request()->routeIs('admin.talent-categories.*'); 
            @endphp
            <a href="#talentSubmenu" data-bs-toggle="collapse" aria-expanded="{{ $talentActive ? 'true' : 'false' }}" class="dropdown-toggle {{ $talentActive ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i> Talent Network
            </a>
            <ul class="collapse submenu {{ $talentActive ? 'show' : '' }}" id="talentSubmenu">
                <li><a href="{{ route('admin.talent-settings.index') }}" class="{{ request()->routeIs('admin.talent-settings.*') ? 'active text-white' : '' }}">Settings</a></li>
                <li><a href="{{ route('admin.talent-countries.index') }}" class="{{ request()->routeIs('admin.talent-countries.*') ? 'active text-white' : '' }}">Countries</a></li>
                <li><a href="{{ route('admin.talent-categories.index') }}" class="{{ request()->routeIs('admin.talent-categories.*') ? 'active text-white' : '' }}">Categories</a></li>
                <li><a href="{{ route('admin.talent.index') }}" class="{{ request()->routeIs('admin.talent.*') ? 'active text-white' : '' }}">Talent List</a></li>
            </ul>
            <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}"><i class="fas fa-envelope me-2"></i> Messages</a>
            <a href="{{ route('admin.model-applications.index') }}" class="{{ request()->routeIs('admin.model-applications.*') ? 'active' : '' }}"><i class="fas fa-file-contract me-2"></i> Model Registrations</a>
            
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-danger w-100"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-wrapper flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light navbar-top px-4 py-3">
                <div class="d-flex align-items-center">
                    <button id="sidebar-toggle" class="me-3">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="navbar-brand mb-0 h1">Hello, {{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                </div>
                <div class="ms-auto">
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fas fa-external-link-alt"></i> View Site</a>
                </div>
            </nav>

            <div class="content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin-selection.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sidebar Toggle Logic
            const sidebar = document.getElementById('admin-sidebar');
            const toggle = document.getElementById('sidebar-toggle');
            const overlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            if(toggle) toggle.addEventListener('click', toggleSidebar);
            if(overlay) overlay.addEventListener('click', toggleSidebar);

            // Rich Editor Initialization
            var editors = document.querySelectorAll('.rich-editor');
            for (var i = 0; i < editors.length; i++) {
                ClassicEditor
                    .create(editors[i])
                    .catch(error => {
                        console.error(error);
                    });
            }

            // Auto-hide session alerts after 1 second
            function autoDismissAlerts() {
                let alerts = document.querySelectorAll('.alert:not(.permanent):not([data-dismissing="true"])');
                alerts.forEach(function(alert) {
                    alert.setAttribute('data-dismissing', 'true');
                    setTimeout(function() {
                        alert.classList.remove('show');
                        setTimeout(() => {
                            if (alert.parentNode) alert.remove();
                        }, 600);
                    }, 1000);
                });
            }

            autoDismissAlerts();

            const observer = new MutationObserver((mutations) => {
                let shouldCheck = false;
                mutations.forEach((mutation) => {
                    if (mutation.addedNodes.length) {
                        mutation.addedNodes.forEach(node => {
                            if (node.nodeType === 1 && (node.classList.contains('alert') || node.querySelector('.alert'))) {
                                shouldCheck = true;
                            }
                        });
                    }
                });
                if (shouldCheck) autoDismissAlerts();
            });
            observer.observe(document.body, { childList: true, subtree: true });
        });
    </script>
</body>
</html>

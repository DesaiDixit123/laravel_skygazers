<aside id="sidebar" class="sidebar">
    <div class="sidebar-background" style="background-image: url('{{ asset('images/sidebar_bg.png') }}');"></div>
    <div class="sidebar-overlay"></div>
    
    <div class="sidebar-content">
        <div class="logo-container">
            <img src="{{ asset('images/logo_skygazers.png') }}" alt="Sky Gazers Studio" class="sidebar-logo">
        </div>

        <nav class="sidebar-nav">
            <ul>
                <li><a href="{{ url('/') }}#home" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/') }}#about">About Us</a></li>
                <li><a href="{{ url('/') }}#services">Services</a></li>
                <li><a href="{{ url('/') }}#talent">Our Talent</a></li>
                <li><a href="{{ url('/become-a-model') }}" class="{{ Request::is('become-a-model') ? 'active' : '' }}">Become a Model</a></li>
                <li><a href="{{ url('/') }}#team">Our Team</a></li>
                <li><a href="{{ url('/') }}#contact">Contact Us</a></li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <div class="social-links">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <p class="copyright">&copy; 2026 Sky Gazers Studio</p>
        </div>
    </div>
</aside>

<!-- Mobile Header / Branding Bar -->
<div class="mobile-header">
    <div class="mobile-logo">
        <img src="{{ asset('images/logo_skygazers.png') }}" alt="Sky Gazers Studio">
    </div>
    <button id="mobile-toggle" class="mobile-toggle">
        <div class="dots-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>
</div>

<!-- Backdrop for mobile sidebar -->
<div id="sidebar-backdrop" class="sidebar-backdrop"></div>

<style>
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 2000;
        overflow: hidden;
        transition: transform 0.6s cubic-bezier(0.85, 0, 0.15, 1);
        border-right: 1px solid rgba(255,255,255,0.05);
    }

    .sidebar-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        filter: grayscale(100%) brightness(30%);
        z-index: -2;
        transform: scale(1.1);
        transition: transform 10s linear;
    }

    .sidebar.active .sidebar-background {
        transform: scale(1);
    }

    .sidebar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.9));
        z-index: -1;
    }

    .sidebar-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        padding: 60px 40px;
        position: relative;
        z-index: 1;
    }

    .logo-container {
        margin-bottom: 60px;
    }

    .sidebar-logo {
        width: 140px;
        height: auto;
        display: block;
        filter: brightness(0) invert(1);
    }

    .sidebar-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav li {
        margin-bottom: 25px;
    }

    .sidebar-nav a {
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        display: inline-block;
        position: relative;
    }

    .sidebar-nav a::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 1px;
        background-color: #ffffff;
        transition: width 0.3s ease;
    }

    .sidebar-nav a:hover, .sidebar-nav a.active {
        color: #ffffff;
    }

    .sidebar-nav a:hover::after, .sidebar-nav a.active::after {
        width: 100%;
    }

    .sidebar-footer {
        margin-top: auto;
    }

    .social-links {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .social-links a {
        color: rgba(255,255,255,0.4);
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .social-links a:hover {
        color: #ffffff;
    }

    .copyright {
        font-size: 9px;
        color: rgba(255,255,255,0.3);
        margin: 0;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* Mobile Header Styling */
    .mobile-header {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 70px;
        background-color: rgba(0,0,0,0.8);
        backdrop-filter: blur(10px);
        z-index: 1500;
        padding: 0 25px;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .mobile-logo img {
        height: 35px;
        filter: brightness(0) invert(1);
    }

    .mobile-toggle {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Vertical three dots icon */
    .dots-icon {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .dots-icon span {
        width: 4px;
        height: 4px;
        background-color: #ffffff;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    /* Animation for active state */
    .mobile-toggle.active .dots-icon span:nth-child(1) { transform: translateY(8px) scale(1.2); }
    .mobile-toggle.active .dots-icon span:nth-child(3) { transform: translateY(-8px) scale(1.2); }

    .sidebar-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.8);
        z-index: 1900;
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s ease;
        backdrop-filter: blur(5px);
    }

    .sidebar-backdrop.active {
        opacity: 1;
        visibility: visible;
    }

    @media (max-width: 1024px) {
        .mobile-header {
            display: flex;
        }

        .sidebar {
            transform: translateX(-100%);
            box-shadow: 20px 0 50px rgba(0,0,0,0.5);
            width: 300px;
        }

        .sidebar.active {
            transform: translateX(0);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('mobile-toggle');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            toggle.classList.toggle('active');
            backdrop.classList.toggle('active');
            
            if (sidebar.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        if (toggle && sidebar && backdrop) {
            toggle.addEventListener('click', toggleSidebar);
            backdrop.addEventListener('click', toggleSidebar);
        }
    });
</script>

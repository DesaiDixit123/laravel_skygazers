<footer class="main-footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo_skygazers.png') }}" alt="Sky Gazers Studio" class="footer-logo">
                </a>
                <nav class="footer-nav">
                    <ul>
                        <li><a href="{{ url('/') }}#home">Home</a></li>
                        <li><a href="{{ url('/') }}#about">About Us</a></li>
                        <li><a href="{{ url('/') }}#services">Services</a></li>
                        <li><a href="{{ url('/') }}#talent">Our Talent</a></li>
                        <li><a href="{{ url('/') }}#team">Our Team</a></li>
                        <li><a href="{{ url('/') }}#contact">Contact Us</a></li>
                    </ul>
                </nav>
            </div>

            <div class="footer-location">
                <h4 class="footer-heading">Location</h4>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120612.92135661664!2d72.8258!3d19.1667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b7194f7281c7%3A0xe5a3c6d48858a719!2sGoregaon%20West%2C%20Mumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1710540000000!5m2!1sen!2sin" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="footer-contact">
                <h4 class="footer-heading">Contact Us</h4>
                <ul class="footer-contact-list">
                    <li><i class="fas fa-phone"></i> +91 7579410617</li>
                    <li><i class="fas fa-envelope"></i> Admin@skygazers.in<br>Sana@skygazers.in</li>
                    <li><i class="fas fa-map-marker-alt"></i> India</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright-text">Copyright &copy; 2026 Sky Gazers Studio. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
    .main-footer {
        background-color: #111111;
        color: #ffffff;
        padding: 60px 0 30px;
        border-top: 1px solid rgba(255,255,255,0.05);
    }

    .footer-top {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1fr;
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-brand {
        display: flex;
        flex-direction: column;
    }

    .footer-logo {
        width: 100%;
        max-width: 150px;
        height: auto;
        margin-bottom: 25px;
        filter: brightness(0) invert(1);
    }

    .footer-nav ul {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .footer-nav a {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        font-size: 13px;
        transition: color 0.3s ease;
    }

    .footer-nav a:hover {
        color: #ffffff;
    }

    .footer-heading {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        margin-bottom: 25px;
    }

    .map-container {
        border-radius: 4px;
        overflow: hidden;
    }

    .footer-contact-list {
        list-style: none;
        padding: 0;
    }

    .footer-contact-list li {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 13px;
        color: rgba(255,255,255,0.7);
        margin-bottom: 15px;
    }

    .footer-contact-list i {
        width: 15px;
        color: rgba(255,255,255,0.5);
    }

    .footer-bottom {
        padding-top: 30px;
        border-top: 1px solid rgba(255,255,255,0.05);
        text-align: center;
    }

    .copyright-text {
        font-size: 11px;
        color: rgba(255,255,255,0.4);
        margin: 0;
    }

    @media (max-width: 1024px) {
        .footer-top {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .main-footer {
            padding: 40px 0 30px;
        }

        .footer-top {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 30px;
        }
        
        .footer-logo {
            margin: 0 auto 25px;
        }

        .footer-nav ul {
            justify-content: center;
            gap: 15px;
        }

        .footer-contact-list li {
            justify-content: center;
        }

        .map-container {
            max-width: 100%;
            margin: 0 auto;
        }
    }
</style>

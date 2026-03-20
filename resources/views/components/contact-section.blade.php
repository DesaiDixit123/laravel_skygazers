<section id="contact" class="contact-section">
    <div class="container">
        <div class="contact-flex">
            <div class="contact-info">
                <h2 class="contact-heading">Contact Us</h2>
                <div class="contact-details">
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <p>+91 7579410617</p>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <p>Admin@skygazers.in<br>Sana@skygazers.in</p>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>India</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-container">
                <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf
                    <div id="contact-status" class="mb-3 d-none"></div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group email-group">
                            <input type="email" name="email" placeholder="Your Email" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="4" placeholder="Message" required></textarea>
                    </div>
                    <button type="submit" class="btn-send">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .contact-section {
        background-color: #1a1a1a;
        color: #ffffff;
        padding: 100px 0;
    }

    .contact-flex {
        display: flex;
        gap: 80px;
        flex-wrap: wrap;
    }

    .contact-info {
        flex: 1;
        min-width: 300px;
    }

    .contact-heading {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 8vw, 36px);
        font-weight: 700;
        margin-bottom: 40px;
        text-align: center;
    }

    @media (min-width: 1025px) {
        .contact-heading {
            text-align: left;
        }
    }

    @media (max-width: 480px) {
        .contact-section {
            padding: 60px 15px;
        }
        .contact-heading {
            font-size: clamp(24px, 7vw, 28px);
            padding: 0 10px;
        }
    }

    @media (max-width: 768px) {
        .contact-heading {
            text-align: center;
        }
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .contact-item i {
        color: rgba(255,255,255,0.6);
        font-size: 18px;
        width: 20px;
    }

    .contact-item p {
        font-size: 14px;
        margin: 0;
        color: rgba(255,255,255,0.8);
    }

    .contact-form-container {
        flex: 2;
        background-color: #222222;
        padding: 40px;
        border-radius: 8px;
    }

    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
        position: relative;
    }

    .form-group input, .form-group textarea {
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding: 15px 0;
        color: #ffffff;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus, .form-group textarea:focus {
        border-bottom-color: #ffffff;
    }

    .email-group .input-icon {
        position: absolute;
        right: 0;
        top: 20px;
        color: rgba(255,255,255,0.4);
    }

    .btn-send {
        align-self: flex-start;
        background-color: #ffffff;
        color: #000000;
        border: none;
        padding: 12px 40px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        margin-top: 10px;
    }

    .btn-send:hover {
        background-color: #f0f0f0;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .contact-flex {
            flex-direction: column;
        }
        
        .contact-form-container {
            padding: 30px 20px;
        }

        .form-group {
            min-width: 100%;
        }

        .btn-send {
            width: 100%;
        }
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        font-size: 14px;
    }
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
</style>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const btn = form.querySelector('.btn-send');
    const status = document.getElementById('contact-status');
    const originalBtnText = btn.textContent;
    
    btn.disabled = true;
    btn.textContent = 'Sending...';
    
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Clear any previous dismissal timeout if it exists
        if (window.statusTimeout) clearTimeout(window.statusTimeout);
        if (window.hideTimeout) clearTimeout(window.hideTimeout);

        status.style.transition = "none";
        status.style.opacity = "1";
        status.classList.remove('d-none', 'alert-danger', 'alert-success');
        
        if (data.success) {
            status.classList.add('alert', 'alert-success');
            status.textContent = data.message;
            form.reset();
            
            // Auto-hide status after 1 second
            window.statusTimeout = setTimeout(() => {
                status.style.transition = "opacity 0.4s ease";
                status.style.opacity = "0";
                window.hideTimeout = setTimeout(() => {
                    status.classList.add('d-none');
                }, 400);
            }, 1000);
        } else {
            status.classList.add('alert', 'alert-danger');
            status.textContent = 'Something went wrong. Please try again.';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        status.classList.remove('d-none', 'alert-success');
        status.classList.add('alert', 'alert-danger');
        status.textContent = 'An error occurred. Please try again.';
    })
    .finally(() => {
        btn.disabled = false;
        btn.textContent = originalBtnText;
    });
});
</script>

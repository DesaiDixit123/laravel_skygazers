<x-layout>
    <div class="application-page">
        <div class="container container-narrow">
            <header class="form-header">
                <h1 class="form-title">Become a Model</h1>
                <p class="form-subtitle">Join Sky Gazers Studio. Models from all countries are welcome to apply.</p>
            </header>

            <form action="#" class="application-form">
                <!-- Core Application Info -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="full_name">Full Name <span class="required">*</span></label>
                        <input type="text" id="full_name" placeholder="Your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" placeholder="Your email address" required>
                    </div>

                    <div class="form-group">
                        <label for="country">Country <span class="required">*</span></label>
                        <select id="country" required>
                            <option value="" disabled selected>Select your country</option>
                            <option value="india">India</option>
                            <option value="usa">USA</option>
                            <option value="uk">UK</option>
                            <option value="uae">UAE</option>
                            <option value="australia">Australia</option>
                            <option value="canada">Canada</option>
                            <option value="brazil">Brazil</option>
                            <option value="france">France</option>
                            <option value="germany">Germany</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Personal Details -->
                <div class="form-section">
                    <div class="form-group span-2">
                        <div class="global-info-display">
                            <div class="info-badge">
                                <span class="badge-icon">🌍</span>
                                <span class="badge-text">Available Worldwide</span>
                            </div>
                            <div class="info-badge">
                                <span class="badge-icon">💬</span>
                                <span class="badge-text">Multi-Language Support</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="age">Age <span class="required">*</span></label>
                        <input type="number" id="age" placeholder="Your age" required>
                    </div>

                    <div class="form-group">
                        <label>Gender <span class="required">*</span></label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="gender" value="male" required>
                                <span class="radio-custom"></span> Male
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="gender" value="female">
                                <span class="radio-custom"></span> Female
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="gender" value="other">
                                <span class="radio-custom"></span> Other
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="height">Height (cm/inches) <span class="required">*</span></label>
                        <input type="text" id="height" placeholder="e.g. 175cm or 5'9\" required>
                    </div>

                    <div class="form-group">
                        <label for="measurements">Measurements <span class="required">*</span></label>
                        <input type="text" id="measurements" placeholder="Bust - Waist - Hip" required>
                    </div>

                    <div class="form-group">
                        <label for="affiliate">Referral / Affiliate Code</label>
                        <input type="text" id="affiliate" placeholder="Enter code if any">
                    </div>
                </div>

                <!-- Social Media -->
                <div class="form-section full-width">
                    <h2 class="section-title">SOCIAL LINKS</h2>
                    <div class="social-grid">
                        <div class="form-group">
                            <label for="instagram">Instagram Link / Username <span class="required">*</span></label>
                            <input type="text" id="instagram" placeholder="your_username or link" required>
                        </div>

                        <div class="form-group">
                            <label for="telegram">Telegram Link / Username <span class="required">*</span></label>
                            <input type="text" id="telegram" placeholder="@username or link" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">WhatsApp Number <span class="required">*</span></label>
                            <input type="tel" id="phone" placeholder="Include country code" required>
                        </div>
                    </div>
                </div>


                <div class="form-submit">
                    <button type="submit" class="btn-submit">Submit Application</button>
                    <p class="submit-note">By submitting, you agree to our privacy policy and global talent terms.</p>
                </div>
            </form>
        </div>
    </div>

    <style>
        .application-page {
            background-color: #000000;
            color: #ffffff;
            padding: 120px 0 100px;
            min-height: 100vh;
        }

        .container-narrow {
            max-width: 100%;
            padding: 0 80px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .form-subtitle {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.6);
            max-width: 600px;
            margin: 0 auto;
        }

        .application-form {
            background-color: #0a0a0a;
            padding: 60px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }

        .form-section {
            margin-bottom: 60px;
            padding-bottom: 60px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .social-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 60px;
            width: 100%;
        }

        .form-section.full-width {
            width: 100%;
            display: block;
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            grid-column: span 3;
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 40px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 1);
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .global-info-display {
            display: flex;
            gap: 20px;
            height: 100%;
            align-items: center;
        }

        .info-badge {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 12px 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .info-badge:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .badge-icon {
            font-size: 18px;
        }

        .badge-text {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.8);
        }

        .form-group {
            margin-bottom: 0;
            /* Handled by grid gap */
        }

        .form-group.span-2 {
            grid-column: span 2;
        }

        .form-group.span-3 {
            grid-column: span 3;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 15px;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .required {
            color: #ff4d4d;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        input[type="url"],
        select {
            width: 100%;
            background-color: transparent;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 10px 0;
            font-size: 15px;
            transition: border-color 0.3s ease;
            border-radius: 0;
        }

        input:focus,
        select:focus {
            outline: none;
            border-bottom-color: #ffffff;
        }

        select {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right center;
        }

        option {
            background-color: #111111;
            color: #ffffff;
        }

        /* Radio and Checkbox styling */
        .radio-group,
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .radio-label,
        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            position: relative;
            padding-left: 30px;
        }

        .radio-label input,
        .checkbox-label input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .radio-custom,
        .checkbox-custom {
            position: absolute;
            top: -2px;
            left: 0;
            height: 18px;
            width: 18px;
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .radio-custom {
            border-radius: 50%;
        }

        .checkbox-custom {
            border-radius: 4px;
        }

        .radio-label:hover input~.radio-custom,
        .checkbox-label:hover input~.checkbox-custom {
            border-color: #ffffff;
        }

        .radio-label input:checked~.radio-custom {
            border-color: #ffffff;
            background-color: #ffffff;
            box-shadow: inset 0 0 0 4px #111111;
        }

        .checkbox-label input:checked~.checkbox-custom {
            border-color: #ffffff;
            background-color: #ffffff;
        }

        .checkbox-label input:checked~.checkbox-custom::after {
            content: "";
            position: absolute;
            display: block;
            left: 5px;
            top: 1px;
            width: 5px;
            height: 10px;
            border: solid #000000;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }


        .form-submit {
            padding-top: 50px;
            text-align: center;
            max-width: 400px;
            margin: 0 auto;
        }

        .btn-submit {
            background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
            color: #000000;
            border: none;
            padding: 22px 60px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            width: 100%;
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.05);
        }

        .btn-submit:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 255, 255, 0.1);
        }

        .submit-note {
            margin-top: 20px;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: 0.5px;
        }

        @media (max-width: 1200px) {
            .form-section {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container-narrow {
                padding: 0 20px;
            }

            .application-form {
                padding: 40px 20px;
            }

            .form-section {
                grid-template-columns: 1fr;
                gap: 30px;
                margin-bottom: 40px;
                padding-bottom: 40px;
            }

            .social-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .form-title {
                font-size: 32px;
            }

            .polaroid-guide {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</x-layout>
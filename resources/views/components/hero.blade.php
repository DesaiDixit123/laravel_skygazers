<section id="home" class="hero-section">
    <div class="hero-background" style="background-image: url('{{ asset('images/skygazers_hero_bg.png') }}');"></div>
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <p class="hero-welcome">Welcome to</p>
        <h2 class="hero-title">Sky Gazers Studio</h2>
        <p class="hero-description">A global creative studio helping brands grow through powerful creator collaborations, high-quality content production, and authentic digital storytelling.</p>
        <a href="#contact" class="btn-hero">Start Your Global Campaign With Sky Gazers Studio</a>
    </div>
</section>

<style>
    .hero-section {
        position: relative;
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: -2;
        transform: scale(1.1); /* Subtle zoom for depth */
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6); /* Darker overlay for better text contrast */
        z-index: -1;
    }

    .hero-content {
        text-align: center;
        color: white;
        z-index: 1;
        padding: 40px 20px;
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
    }

    @media (max-width: 1024px) {
        .hero-content {
            padding-top: 100px; /* More offset for fixed mobile header */
        }
    }

    .hero-welcome {
        font-size: 18px;
        letter-spacing: 4px;
        margin-bottom: 20px;
        font-weight: 300;
        text-transform: uppercase;
        opacity: 0.8;
    }

    .hero-title {
        font-family: 'Inter', sans-serif;
        font-size: clamp(32px, 10vw, 72px);
        font-weight: 800;
        letter-spacing: -1px;
        margin: 0;
        line-height: 1.1;
        text-transform: capitalize;
    }

    .hero-description {
        margin: 25px auto;
        font-size: 18px;
        line-height: 1.6;
        opacity: 0.85;
    }

    .btn-hero {
        display: inline-block;
        margin-top: 35px;
        padding: 16px 45px;
        background: #ffffff;
        color: #000000;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.3s ease;
        max-width: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        background-color: #f0f0f0;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: clamp(32px, 8vw, 42px); /* Reduced middle value */
        }
        
        .hero-description {
            font-size: 16px;
            margin: 20px auto;
        }

        .btn-hero {
            padding: 14px 30px;
            font-size: 11px;
            letter-spacing: 1px;
        }
    }

    /* Target the 600px and below range specifically */
    @media (max-width: 600px) {
        .hero-content {
            padding-top: 80px;
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .hero-title {
            font-size: 32px !important;
            letter-spacing: 0;
            padding: 0;
            white-space: normal !important;
            overflow-wrap: break-word !important;
        }
        
        .hero-description {
            font-size: 15px;
            padding: 0;
            margin: 20px auto !important;
        }

        .btn-hero {
            margin-top: 25px;
            padding: 12px 25px;
            font-size: 11px;
            max-width: 100%;
        }
    }

    @media (max-width: 530px) {
        .hero-content {
            padding-top: 80px;
            width: 100%;
            position: relative;
            left: -55px;
        }
        
        .hero-welcome {
            font-size: 11px;
            letter-spacing: 3px;
            margin-bottom: 15px;
        }

        .hero-title {
            font-size: 32px !important; 
            line-height: 1.2;
            max-width: 460px;
            margin: 0 auto;
        }
        
        .hero-description {
            font-size: 14px !important;
            margin: 20px auto !important;
            max-width: 380px;
        }

        .btn-hero {
            padding: 12px 25px !important;
            font-size: 11px !important;
            margin-top: 25px !important;
            max-width: 300px;
        }
    }

    @media (max-width: 460px) {
        .hero-title {
            font-size: 28px !important;
        }
        .hero-description {
            font-size: 13px !important;
            max-width: 320px;
        }
        .btn-hero {
            font-size: 10px !important;
            max-width: 260px;
        }
    }

    @media (max-width: 390px) {
        .hero-content {
            padding-top: 60px;
            width: 100%;
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .hero-title {
            font-size: 24px !important;
            line-height: 1.1;
            word-wrap: break-word;
            overflow-wrap: break-word; /* Ensure it stays inside */
            max-width: 100%;
        }

        .hero-description {
            font-size: 12px !important;
            max-width: 280px;
        }

        .btn-hero {
            font-size: 9px !important;
            padding: 10px 15px !important;
            max-width: 240px;
        }
        
        .hero-welcome {
            font-size: 9px;
            letter-spacing: 2px;
            text-indent: 2px;
        }
    }
</style>

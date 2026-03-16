<section id="home" class="hero-section">
    <div class="hero-background" style="background-image: url('{{ asset('images/skygazers_hero_bg.png') }}');"></div>
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <p class="hero-welcome">Welcome to</p>
        <h2 class="hero-title">Sky Gazers Studio</h2>
        <p class="hero-description" style="max-width: 800px; margin: 20px auto; font-size: 18px; opacity: 0.9;">A global creative studio helping brands grow through powerful creator collaborations, high-quality content production, and authentic digital storytelling.</p>
        <a href="#contact" class="btn-hero" style="display: inline-block; margin-top: 30px; padding: 15px 40px; background: white; color: black; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;">Start Your Global Campaign With Sky Gazers Studio</a>
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
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: -1;
    }

    .hero-content {
        text-align: center;
        color: white;
        z-index: 1;
    }

    .hero-welcome {
        font-size: 18px;
        letter-spacing: 2px;
        margin-bottom: 5px;
        font-weight: 300;
        text-transform: lowercase;
        opacity: 0.9;
    }

    .hero-title {
        font-family: 'Inter', sans-serif; /* Re-analyzing screenshot: it looks like a bold sans-serif */
        font-size: 64px;
        font-weight: 800;
        letter-spacing: 2px;
        margin: 0;
        line-height: 1;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }
    }
</style>

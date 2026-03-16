<section id="about" class="about-section">
    <div class="container">
        <div class="about-flex">
            <div class="about-content">
                <h2 class="about-heading">About Sky Gazers Studio</h2>
                <div class="about-text">
                    <p>Sky Gazers Studio is a global creative and influencer collaboration studio founded in 2020. We specialize in content creation, brand collaborations, and influencer partnerships across multiple international markets.</p>
                    <p>Our studio connects brands with talented creators to produce authentic digital content that drives engagement and builds strong brand presence globally. We specialize in influencer collaborations, brand shoots, user-generated content (UGC), and creator partnerships across India, Brazil, UK, Australia, Germany, France, Portugal, and Slovenia.</p>
                </div>
                <a href="{{ url('/') }}#talent" class="btn-view-models">Our Talent Network</a>
            </div>
            
            <div class="about-image-container">
                <div class="dots-pattern-about"></div>
                <div class="image-wrapper">
                    <img src="{{ asset('images/skygazers_about_image.png') }}" alt="Sky Gazers Studio Founder" class="about-image">
                    <div class="image-shadow-box"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .about-section {
        background-color: #ffffff;
        color: #000000;
        padding: 100px 0;
        overflow: hidden;
    }

    .about-flex {
        display: flex;
        align-items: center;
        gap: 60px;
        flex-wrap: wrap;
    }

    .about-content {
        flex: 1;
        min-width: 300px;
    }

    .about-heading {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 30px;
        line-height: 1.2;
    }

    .about-text p {
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 20px;
        color: #444;
        text-align: justify;
    }

    .btn-view-models {
        display: inline-block;
        background-color: #1a1a1a;
        color: #ffffff;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        margin-top: 10px;
    }

    .btn-view-models:hover {
        background-color: #333;
        transform: translateY(-2px);
    }

    .about-image-container {
        flex: 1;
        position: relative;
        min-width: 300px;
        display: flex;
        justify-content: center;
    }

    .image-wrapper {
        position: relative;
        z-index: 2;
    }

    .about-image {
        width: 100%;
        max-width: 400px;
        height: auto;
        display: block;
        box-shadow: 20px 20px 0px rgba(0,0,0,0.05);
    }

    .image-shadow-box {
        position: absolute;
        bottom: -20px;
        right: -20px;
        width: 100%;
        height: 100%;
        background-color: #333;
        z-index: -1;
    }

    .dots-pattern-about {
        position: absolute;
        top: -40px;
        left: -40px;
        width: 150px;
        height: 150px;
        background-image: radial-gradient(#ccc 1px, transparent 1px);
        background-size: 15px 15px;
        z-index: 1;
    }

    @media (max-width: 1024px) {
        .about-flex {
            flex-direction: column;
            text-align: center;
        }
        
        .about-text p {
            text-align: center;
        }

        .about-image-container {
            margin-top: 50px;
        }
    }
</style>

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
        font-size: clamp(24px, 7vw, 32px);
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

    @media (max-width: 480px) {
        .about-text p {
            text-align: left;
            font-size: 14px;
        }
        .about-heading {
            font-size: 24px;
        }
        .about-section {
            padding: 60px 0;
        }
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
        width: 100%;
    }

    .image-wrapper {
        position: relative;
        z-index: 2;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .about-image {
        width: 100%;
        max-width: 400px;
        height: auto;
        display: block;
        box-shadow: 10px 10px 0px rgba(0,0,0,0.05); /* Reduced shadow depth */
    }

    .image-shadow-box {
        position: absolute;
        bottom: -15px;
        right: 15px; /* Stay inside container */
        width: 80%;
        height: 80%;
        background-color: #333;
        z-index: -1;
    }

    .dots-pattern-about {
        position: absolute;
        top: -20px;
        left: 20px; /* Stay inside container */
        width: 100px;
        height: 100px;
        background-image: radial-gradient(#ccc 1px, transparent 1px);
        background-size: 15px 15px;
        z-index: 1;
    }

    @media (max-width: 530px) {
        .about-section {
            padding: 60px 0;
        }
        .about-heading {
            font-size: clamp(22px, 6vw, 24px);
            margin-bottom: 25px;
        }
        .about-text p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: left;
        }
        .image-shadow-box, .dots-pattern-about {
            display: none;
        }
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
            padding: 0 20px; /* Buffer for decorations */
        }
        
        .dots-pattern-about {
            left: 10%; /* More centered approach for mobile */
        }
        
        .image-shadow-box {
            right: 10%;
        }
    }

    @media (max-width: 480px) {
        .about-image-container {
            min-width: unset;
        }
        
        .dots-pattern-about, .image-shadow-box {
            display: none; /* Remove problematic decorations on tiny screens */
        }
        
        .about-image {
            box-shadow: none;
            border: 10px solid #f9f9f9;
        }
    }
</style>

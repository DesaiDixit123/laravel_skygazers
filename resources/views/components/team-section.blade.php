<section id="team" class="team-section">
    <div class="container">
        <h2 class="section-title-light">Our Leadership</h2>
        <div class="team-flex">
            <div class="team-image-container">
                <div class="image-wrapper">
                    <img src="{{ asset('images/skygazers_about_image.png') }}" alt="Sana - Founder" class="team-image">
                    <div class="image-border"></div>
                </div>
            </div>
            <div class="team-info">
                <h3 class="member-name">Sana</h3>
                <p class="member-title">Founder & Director</p>
                <div class="member-description">
                    <p>Sana leads global creator collaborations, brand partnerships, and campaign strategy. Since founding Sky Gazers Studio in 2020, she has successfully built a strong network of creators and brands across international markets.</p>
                </div>
                <div class="member-values">
                    <div class="value-item">Transparency</div>
                    <div class="value-item">Professionalism</div>
                    <div class="value-item">Creativity</div>
                    <div class="value-item">Global Reach</div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .team-section {
        background-color: #f9f9f9;
        color: #000000;
        padding: 100px 0;
    }

    .section-title-light {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        text-align: center;
        margin-bottom: 60px;
        letter-spacing: 2px;
    }

    .team-flex {
        display: flex;
        align-items: center;
        gap: 80px;
        flex-wrap: wrap;
    }

    .team-image-container {
        flex: 1;
        min-width: 300px;
        display: flex;
        justify-content: center;
    }

    .image-wrapper {
        position: relative;
        z-index: 1;
    }

    .team-image {
        width: 100%;
        max-width: 350px;
        height: auto;
        display: block;
        border-radius: 4px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .image-border {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 100%;
        height: 100%;
        border: 2px solid #000000;
        z-index: -1;
    }

    .team-info {
        flex: 1.5;
        min-width: 300px;
    }

    .member-name {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .member-title {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #666;
        margin-bottom: 30px;
    }

    .member-description p {
        font-size: 16px;
        line-height: 1.8;
        color: #444;
        margin-bottom: 30px;
    }

    .member-values {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .value-item {
        background: #1a1a1a;
        color: #ffffff;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .team-flex {
            flex-direction: column;
            text-align: center;
        }
        
        .member-values {
            justify-content: center;
        }
        
        .image-border {
            display: none;
        }
    }
</style>

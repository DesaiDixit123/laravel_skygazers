@props(['talents' => [], 'showViewAll' => true, 'creatorsCount' => '500+', 'campaignsCount' => '250+', 'talentCategories' => [], 'talentCountries' => []])

<section id="talent" class="talent-section">
    <div class="container">
        <h2 class="section-title-dark">Our Talent Network</h2>
        <div class="talent-intro">
            <div class="talent-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $creatorsCount }}</span>
                    <span class="stat-label">Creators</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $campaignsCount }}</span>
                    <span class="stat-label">Brand Campaigns</span>
                </div>
            </div>
            <p class="talent-description">
                Our network spans across 
                @foreach($talentCountries as $key => $country)
                    <span class="country-tag" style="animation-delay: {{ 0.1 * ($key + 1) }}s">{{ $country->name }}</span>{{ $loop->last ? '' : ',' }} {{ $loop->remaining == 1 ? 'and ' : '' }}
                @endforeach
                featuring top-tier creators in 
                @foreach($talentCategories as $category)
                    {{ $category->name }}{{ $loop->last ? '.' : ', ' }}
                @endforeach
            </p>
        </div>

        <div class="model-filters">
            <button class="filter-btn active" data-filter="all">All</button>
            @foreach($talentCategories as $category)
                <button class="filter-btn" data-filter="{{ $category->slug }}">{{ $category->name }}</button>
            @endforeach
        </div>

        <div class="models-grid">

            @foreach($talents as $talent)
                <a href="{{ url('/talent/' . strtolower(str_replace(' ', '-', $talent->name))) }}" class="model-card-link" data-category="{{ $talent->category }}">
                    <div class="model-card">
                        <div class="model-image-wrapper">
                        @if($talent->image)
                            <img src="{{ Storage::url($talent->image) }}" alt="{{ $talent->name }}">
                        @else
                            <img src="{{ asset('images/creator_1.png') }}" alt="{{ $talent->name }}">
                        @endif
                            <div class="model-overlay">
                                <span class="model-gender">{{ $talent->label }}</span>
                                <h4 class="model-name">{{ $talent->name }}</h4>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($showViewAll ?? true)
        <div class="view-more-container">
            <a href="{{ url('/talent-network') }}" class="btn-view-more">View All Talent</a>
        </div>
        @endif
    </div>
</section>

<style>
    .talent-section {
        background-color: #1a1a1a;
        color: #ffffff;
        padding: 100px 0;
    }

    .talent-intro {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 50px;
    }

    .talent-stats {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-bottom: 30px;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-number {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        font-weight: 700;
        color: #ffffff;
    }

    .stat-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255,255,255,0.6);
        margin-top: 5px;
    }

    .talent-description {
        font-size: 16px;
        line-height: 2.2;
        color: rgba(255,255,255,0.8);
    }

    .country-tag {
        display: inline-block;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2px 12px;
        margin: 0 4px;
        border-radius: 20px;
        font-weight: 500;
        color: #ffffff;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        animation: pulse-glow 2s infinite alternate;
        cursor: default;
    }

    .country-tag:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 15px rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.6);
        animation: none; /* pause animation on hover */
    }

    @keyframes pulse-glow {
        0% { 
            border-color: rgba(255, 255, 255, 0.2); 
            box-shadow: 0 0 0px rgba(255, 255, 255, 0); 
        }
        100% { 
            border-color: rgba(255, 255, 255, 0.4); 
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.15); 
        }
    }

    .section-title-dark {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 8vw, 36px);
        text-align: center;
        margin-bottom: 40px;
        letter-spacing: 2px;
        padding: 0 15px;
    }

    .model-filters {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 50px;
        overflow-x: auto;
        padding: 0 20px 10px;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE/Edge */
    }

    .model-filters::-webkit-scrollbar {
        display: none; /* Safari and Chrome */
    }

    .filter-btn {
        background: none;
        border: none;
        color: rgba(255,255,255,0.6);
        font-size: 14px;
        cursor: pointer;
        padding: 5px 0;
        position: relative;
        transition: color 0.3s ease;
        white-space: nowrap;
    }

    .filter-btn.active, .filter-btn:hover {
        color: #ffffff;
    }

    .filter-btn.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #ffffff;
    }

    .models-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .model-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .model-card {
        position: relative;
        overflow: hidden;
        aspect-ratio: 4 / 5;
        transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .model-image-wrapper {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .model-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: transform 0.8s ease, filter 0.5s ease;
    }

    .model-card:hover .model-image-wrapper img {
        transform: scale(1.1);
        filter: grayscale(0%);
    }

    .model-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 30px 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        pointer-events: none;
    }

    .model-gender {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255,255,255,0.7);
        display: block;
        margin-bottom: 5px;
    }

    .model-name {
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0;
    }

    .view-more-container {
        text-align: center;
        margin-top: 60px;
    }

    .btn-view-more {
        display: inline-block;
        border: 1px solid #ffffff;
        color: #ffffff;
        padding: 12px 40px;
        border-radius: 25px;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-view-more:hover {
        background-color: #ffffff;
        color: #000000;
    }

    @media (max-width: 768px) {
        .talent-section {
            padding: 60px 0;
        }

        .talent-stats {
            gap: 30px;
        }
        
        .stat-number {
            font-size: 32px;
        }

        .talent-description {
            font-size: 14px;
            line-height: 1.8;
            padding: 0 10px;
        }

        .model-filters {
            justify-content: flex-start;
            margin-bottom: 30px;
        }

        .models-grid {
            grid-template-columns: 1fr; /* User requested single single images */
            gap: 20px;
            padding: 0 10px;
        }

        .model-card {
            aspect-ratio: 16/10; /* Better aspect ratio for single column on mobile */
        }

        .model-overlay {
            padding: 20px 15px;
        }

        .model-name {
            font-size: 18px;
        }
    }

    @media (max-width: 480px) {
        .stat-number {
            font-size: 28px;
        }
        .stat-label {
            font-size: 10px;
        }
        .talent-stats {
            gap: 20px;
        }
        .section-title-dark {
            font-size: 26px;
        }
    }
</style>
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const modelCards = document.querySelectorAll('.model-card-link');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active state
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');

                // Filter logic
                modelCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.style.display = 'block';
                        setTimeout(() => card.style.opacity = '1', 10);
                    } else {
                        card.style.opacity = '0';
                        setTimeout(() => card.style.display = 'none', 500);
                    }
                });
            });
        });
    });
</script>
